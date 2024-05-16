<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Off;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("off", function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('percent');

            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id')->references('id')->on('brand');

            $table->rememberToken();
            $table->timestamps();
        });
        Off::firstOrCreate([
            'name' => 'ندارد',
            'percent'=>'0'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('off');
    }
};
