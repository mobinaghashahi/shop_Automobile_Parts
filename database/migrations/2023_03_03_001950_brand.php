<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Brand;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('brand', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            $table->unsignedBigInteger('off_id');
            $table->foreign('off_id')
                ->references('id')
                ->on('off');

            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('brand')->insert([
            'name' => 'نامعلوم',
            'off_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('brand');
    }
};
