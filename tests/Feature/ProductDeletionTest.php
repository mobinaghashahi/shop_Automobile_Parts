<?php

namespace Tests\Feature;

use App\Http\Middleware\authMiddleware;
use App\Http\Middleware\VisitCounter;
use App\Models\Product;
use App\Models\User;
use DOMDocument;
use DOMXPath;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ProductDeletionTest extends TestCase
{
    use RefreshDatabase;

    private string $testPublicPath;
    private Product $product;

    public function createApplication(): Application
    {
        $app = parent::createApplication();
        // Never run these destructive-operation tests against the configured shop database.
        $app['config']->set([
            'database.default' => 'sqlite',
            'database.connections.sqlite.database' => ':memory:',
            'cache.default' => 'array',
            'session.driver' => 'array',
        ]);

        return $app;
    }

    protected function setUp(): void
    {
        parent::setUp();

        // Keep the route's login, role, and CSRF middleware; omit unrelated global redirects and analytics.
        $this->withoutMiddleware([authMiddleware::class, VisitCounter::class]);
        $this->testPublicPath = sys_get_temp_dir().'/shop-product-deletion-tests/'.Str::uuid();
        File::ensureDirectoryExists($this->testPublicPath);
        $this->app->usePublicPath($this->testPublicPath);

        $this->product = Product::forceCreate([
            'name' => 'محصول آزمایشی',
            'count' => 10,
            'price' => 100000,
            'imageName' => 'test.png',
            'brand_id' => 1,
            'category_id' => 1,
            'carType_id' => 1,
            'off_id' => 1,
        ]);
    }

    protected function tearDown(): void
    {
        if (isset($this->testPublicPath)) {
            File::deleteDirectory($this->testPublicPath);
        }

        parent::tearDown();
    }

    public function test_guests_cannot_delete_a_product(): void
    {
        $this->delete($this->deleteUrl())->assertRedirect('/');
        $this->assertDatabaseHas('products', ['id' => $this->product->id]);
    }

    public function test_regular_users_and_designers_cannot_delete_even_with_an_admin_user_type(): void
    {
        foreach (['user', 'designer'] as $role) {
            $user = $this->userWithRole($role);
            $user->forceFill(['userType' => 'admin'])->save();

            $this->actingAs($user)->delete($this->deleteUrl())->assertForbidden();
            $this->assertDatabaseHas('products', ['id' => $this->product->id]);
        }
    }

    public function test_admin_form_submission_deletes_the_product_and_its_images(): void
    {
        $imageDirectory = public_path('products/'.$this->product->id);
        File::ensureDirectoryExists($imageDirectory);
        File::put($imageDirectory.'/test.png', 'test image');
        $otherProductDirectory = public_path('products/other-product');
        File::ensureDirectoryExists($otherProductDirectory);
        File::put($otherProductDirectory.'/keep.png', 'keep this image');

        // Enable real CSRF checks and exercise the browser's POST + DELETE method override.
        $this->app['env'] = 'local';
        $token = Str::random(40);
        $this->actingAs($this->userWithRole('admin'))
            ->withSession(['_token' => $token, 'url.intended' => '/productDetails/'.$this->product->id])
            ->post($this->deleteUrl(), ['_method' => 'DELETE', '_token' => $token])
            ->assertRedirect('/admin/editProductPanel')
            ->assertSessionHas('msg', 'محصول با موفقیت حذف شد.');

        $this->assertDatabaseMissing('products', ['id' => $this->product->id]);
        $this->assertDirectoryDoesNotExist($imageDirectory);
        $this->assertFileExists($otherProductDirectory.'/keep.png');
    }

    public function test_get_requests_cannot_delete_a_product(): void
    {
        $this->actingAs($this->userWithRole('admin'))
            ->get($this->deleteUrl())->assertStatus(405);
        $this->assertDatabaseHas('products', ['id' => $this->product->id]);
    }

    public function test_deletion_requires_a_csrf_token(): void
    {
        $this->app['env'] = 'local';
        $this->actingAs($this->userWithRole('admin'))
            ->delete($this->deleteUrl())->assertStatus(419);
        $this->assertDatabaseHas('products', ['id' => $this->product->id]);
    }

    public function test_deleting_a_missing_product_returns_not_found(): void
    {
        $this->actingAs($this->userWithRole('admin'))
            ->delete('/admin/deleteProduct/999999')->assertNotFound();
        $this->assertDatabaseHas('products', ['id' => $this->product->id]);
    }

    public function test_only_admins_see_the_confirmation_form_and_delete_button(): void
    {
        $url = '/productDetails/'.$this->product->id;
        $this->get($url)->assertOk()->assertDontSee('delete-product-form');

        foreach (['user', 'designer'] as $role) {
            $this->actingAs($this->userWithRole($role))->get($url)
                ->assertOk()->assertDontSee('delete-product-form');
        }

        $response = $this->actingAs($this->userWithRole('admin'))->get($url)->assertOk();
        $document = new DOMDocument();
        $previous = libxml_use_internal_errors(true);
        $document->loadHTML('<?xml encoding="UTF-8">'.$response->getContent());
        libxml_clear_errors();
        libxml_use_internal_errors($previous);
        $xpath = new DOMXPath($document);

        $this->assertSame(1, $xpath->query('//form[@id="delete-product-form"]')->length);
        $this->assertSame(0, $xpath->query('//form[@id="delete-product-form"]/ancestor::form')->length);
        $this->assertSame(1, $xpath->query('//button[@form="delete-product-form" and @type="button" and @data-product-delete-trigger]')->length);
        $this->assertSame(1, $xpath->query('//form[@id="delete-product-form"]//input[@name="_method" and @value="DELETE"]')->length);
        $this->assertSame(1, $xpath->query('//form[@id="delete-product-form"]//input[@name="_token"]')->length);
        $form = $xpath->query('//form[@id="delete-product-form"]')->item(0);
        $this->assertFalse($form->hasAttribute('onsubmit'));
        $this->assertTrue($form->hasAttribute('data-product-delete'));
        $this->assertSame($this->product->name, $form->getAttribute('data-product-name'));
        $this->assertSame((string) $this->product->id, $form->getAttribute('data-product-id'));
        $this->assertSame(1, $xpath->query('//dialog[@id="product-delete-dialog" and @aria-labelledby="product-delete-title"]')->length);
        $this->assertSame(0, $xpath->query('//dialog[@id="product-delete-dialog"]/ancestor::form')->length);
        $this->assertSame(1, $xpath->query('//dialog//button[@data-product-delete-confirm and @type="button"]')->length);
        $this->assertSame(1, $xpath->query('//dialog//button[@data-product-delete-cancel and @autofocus]')->length);
        $this->assertStringEndsWith($this->deleteUrl(), $form->getAttribute('action'));
    }

    private function userWithRole(string $role): User
    {
        $user = User::forceCreate([
            'nameAndFamily' => 'Test '.$role,
            'phoneNumber' => '09120000000',
            'password' => bcrypt('test-password'),
            'userType' => $role,
        ]);
        $user->assignRole(Role::findOrCreate($role, 'web'));

        return $user;
    }

    private function deleteUrl(): string
    {
        return '/admin/deleteProduct/'.$this->product->id;
    }
}
