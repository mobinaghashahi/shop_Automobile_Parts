<?php

namespace Tests\Feature;

use App\Models\Brand;
use App\Models\CarType;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class pagesLoadTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    public function test_getRequest(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        //-----------------

        $response = $this->get('/aboutUs');
        $response->assertStatus(200);
        //-----------------

        $response = $this->get('/contact');
        $response->assertStatus(200);
        //-----------------

        $response = $this->get('/contact');
        $response->assertStatus(200);
        //-----------------

        $response = $this->get('/sitemap.xml');
        $response->assertStatus(200);
        //-----------------

        $response = $this->get('/resultSearch');
        $response->assertStatus(200);
        //-----------------

        $brandIDs = Brand::select("brand.id")->get();
        foreach ($brandIDs as $brandID) {
            $response = $this->get('/brands/' . $brandID['id']);
            $response->assertStatus(200);
        }
        //-----------------

        //آی دی های صحیح
        $carTypes = CarType::select("id")->get();
        foreach ($carTypes as $carType) {
            $response = $this->get('/carTypeCategorys/' . $carType['id']);
            $response->assertStatus(200);
        }
        //آی دی های خارج از محدوده
        $response = $this->get('/carTypeCategorys/201500021');
        $response->assertStatus(500);
        $response = $this->get('/carTypeCategorys/654654654654');
        $response->assertStatus(500);
        $response = $this->get('/carTypeCategorys/s');
        $response->assertStatus(500);
        //-----------------

        //آی دی های صحیح
        $categorys = Category::select("id")->get();
        foreach ($carTypes as $carType) {
            foreach ($categorys as $category) {
                $response = $this->get('/carTypeProducts/' . $carType['id'] . '/' . $category['id']);
                $response->assertStatus(200);
            }
        }
        //آی دی های خارج از محدوده
        $response = $this->get('/carTypeProducts/215/2138544554');
        $response->assertStatus(200);
        $response = $this->get('/carTypeProducts/2546546515/156546');
        $response->assertStatus(200);
        $response = $this->get('/carTypeProducts/or "1"="1";/saa');
        $response->assertStatus(200);
        //-----------------

        $response = $this->get('/login');
        $response->assertStatus(200);
        //-----------------

        $response = $this->get('/register');
        $response->assertStatus(200);
        //-----------------

        $response = $this->get('/logout');
        $response->assertRedirect("/login");
        $response->assertStatus(302);
        //-----------------

        $response = $this->get('/forgetPassword');
        $response->assertStatus(200);
        //-----------------

        $response = $this->get('/enterForgetPasswordCode/5465465465465');
        $response->assertStatus(200);
        //-----------------

        $response = $this->get('/changeForgetPassword');
        $response->assertStatus(200);
        //-----------------

        $productsID = Product::select("id")->get();
        foreach ($productsID as $productID){
            $response = $this->get('/productDetails/'.$productID['id']);
            $response->assertStatus(200);
        }
        //-----------------

        $response = $this->get('/admin');
        $response->assertRedirect("/");
        $response->assertStatus(302);
        //-----------------

        $response = $this->get('/user/dashboard');
        $response->assertRedirect("/login");
        $response->assertStatus(302);

        $response = $this->get('/user/profile');
        $response->assertRedirect("/login");
        $response->assertStatus(302);

        $response = $this->get('/user/orders');
        $response->assertRedirect("/login");
        $response->assertStatus(302);

        $response = $this->get('/user/orderDetails/5');
        $response->assertRedirect("/login");
        $response->assertStatus(302);
        //-----------------

        $response = $this->get('/cart/showCart');
        $response->assertRedirect("/");
        $response->assertStatus(302);

        $response = $this->get('/cart/deleteOfCart/5');
        $response->assertRedirect("/");
        $response->assertStatus(302);

        $response = $this->get('/cart/addUserInformation');
        $response->assertRedirect("/login");
        $response->assertStatus(302);
        //-----------------

        $response = $this->get('/payment/verify');
        $response->assertRedirect("/login");
        $response->assertStatus(302);

    }
    public function test_postRequest(): void
    {

    }
}
