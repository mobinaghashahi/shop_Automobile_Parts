<?php

namespace Tests\Feature;

use App\Http\Middleware\authMiddleware;
use App\Http\Middleware\VisitCounter;
use App\Models\Product;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartQuantityTest extends TestCase
{
    use RefreshDatabase;

    private Product $firstProduct;
    private Product $secondProduct;

    public function createApplication(): Application
    {
        $app = parent::createApplication();
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
        $this->withoutMiddleware([authMiddleware::class, VisitCounter::class]);
        $this->firstProduct = $this->product('محصول اول', 10000);
        $this->secondProduct = $this->product('محصول دوم', 25000);
        $this->withSession(['products' => [
            $this->firstProduct->id => 2,
            $this->secondProduct->id => 3,
        ]]);
    }

    public function test_increase_updates_the_session_and_both_totals_without_redirecting(): void
    {
        $this->postJson('/cart/increaseCount', ['id' => $this->firstProduct->id, 'count' => 3])
            ->assertOk()
            ->assertJson([
                'productId' => $this->firstProduct->id,
                'quantity' => 3,
                'maxQuantity' => 10,
                'lineTotal' => 30000,
                'lineTotalFormatted' => '30,000',
                'totalPrice' => 105000,
                'totalPriceFormatted' => '105,000',
            ])
            ->assertSessionHas('products.'.$this->firstProduct->id, 3)
            ->assertSessionHas('products.'.$this->secondProduct->id, 3);
    }

    public function test_decrease_updates_the_session_and_totals(): void
    {
        $this->postJson('/cart/decreaseCount', ['id' => $this->firstProduct->id, 'count' => 1])
            ->assertOk()
            ->assertJson(['quantity' => 1, 'lineTotal' => 10000, 'totalPrice' => 85000])
            ->assertSessionHas('products.'.$this->firstProduct->id, 1);
    }

    public function test_quantity_cannot_drop_below_one(): void
    {
        $this->postJson('/cart/decreaseCount', ['id' => $this->firstProduct->id, 'count' => 0])
            ->assertUnprocessable()->assertJsonValidationErrors('count')
            ->assertSessionHas('products.'.$this->firstProduct->id, 2);
    }

    public function test_quantity_cannot_exceed_available_stock(): void
    {
        $this->postJson('/cart/increaseCount', ['id' => $this->firstProduct->id, 'count' => 11])
            ->assertUnprocessable()->assertJsonValidationErrors('count')
            ->assertSessionHas('products.'.$this->firstProduct->id, 2);
    }

    public function test_invalid_or_missing_product_ids_return_validation_errors(): void
    {
        foreach ([null, 'invalid', 999999] as $id) {
            $this->postJson('/cart/increaseCount', ['id' => $id, 'count' => 3])
                ->assertUnprocessable()->assertJsonValidationErrors('id')
                ->assertSessionHas('products.'.$this->firstProduct->id, 2);
        }
    }

    public function test_quantity_updates_cannot_add_an_item_that_is_not_in_the_cart(): void
    {
        $thirdProduct = $this->product('محصول خارج سبد', 5000);
        $this->postJson('/cart/increaseCount', ['id' => $thirdProduct->id, 'count' => 2])
            ->assertUnprocessable()->assertJsonValidationErrors('id')
            ->assertSessionMissing('products.'.$thirdProduct->id);
    }

    public function test_unavailable_products_cannot_be_increased(): void
    {
        $this->firstProduct->forceFill(['availability' => 'outofstock'])->save();
        $this->postJson('/cart/increaseCount', ['id' => $this->firstProduct->id, 'count' => 3])
            ->assertUnprocessable()->assertJsonValidationErrors('count')
            ->assertSessionHas('products.'.$this->firstProduct->id, 2);
    }

    public function test_existing_non_json_requests_still_update_and_redirect(): void
    {
        $this->post('/cart/increaseCount', ['id' => $this->firstProduct->id, 'count' => 3])
            ->assertRedirect('/cart/showCart')
            ->assertSessionHas('products.'.$this->firstProduct->id, 3);
    }

    public function test_quantity_updates_require_a_csrf_token(): void
    {
        $this->app['env'] = 'local';
        $this->postJson('/cart/increaseCount', ['id' => $this->firstProduct->id, 'count' => 3])
            ->assertStatus(419)
            ->assertSessionHas('products.'.$this->firstProduct->id, 2);
    }

    public function test_cart_renders_with_the_new_quantity_controls(): void
    {
        $this->get('/cart/showCart')->assertOk()
            ->assertSee('data-cart-step="-1"', false)
            ->assertSee('data-cart-step="1"', false)
            ->assertSee('data-cart-total', false);
    }

    private function product(string $name, int $price): Product
    {
        return Product::forceCreate([
            'name' => $name,
            'count' => 10,
            'price' => $price,
            'imageName' => 'test.png',
            'brand_id' => 1,
            'category_id' => 1,
            'carType_id' => 1,
            'off_id' => 1,
        ]);
    }
}
