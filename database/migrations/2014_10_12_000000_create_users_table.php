<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nameAndFamily');
            $table->string('phoneNumber');
            $table->string('address', 500)->nullable();
            $table->string('postCode')->nullable();
            $table->string('password');
            $table->string('userType')->default("user");

            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id')->references('id')->on('city');

            $table->rememberToken();
            $table->timestamps();
        });

// ایجاد کاربر پیش‌فرض
        DB::table('users')->insert([
            'nameAndFamily' => 'مدیر سیستم',
            'phoneNumber' => '09139638917',
            'password' => Hash::make('00981920'),
            'userType' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
