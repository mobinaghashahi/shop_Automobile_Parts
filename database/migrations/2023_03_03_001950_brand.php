<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Brand;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('brand', function (Blueprint $table) {
            $table->id();
            $table->string("name");

            $table->unsignedBigInteger('off_id');
            $table->foreign('off_id')->references('id')->on('off');

            $table->rememberToken();
            $table->timestamps();
        });
        Brand::firstOrCreate([
            'name' => 'نامعلوم'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brand');
    }
};
