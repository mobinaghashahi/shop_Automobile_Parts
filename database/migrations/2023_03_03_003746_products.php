<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("description",300)->nullable();
            $table->integer("count");
            $table->integer("price");
            $table->integer("old_price")->default(0);
            $table->string("imageName");
            $table->string("availability")->default("instock");

            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id')->references('id')->on('brand');

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('category');

            $table->unsignedBigInteger('carType_id');
            $table->foreign('carType_id')->references('id')->on('carType');

            $table->unsignedBigInteger('off_id');
            $table->foreign('off_id')->references('id')->on('off');

            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
