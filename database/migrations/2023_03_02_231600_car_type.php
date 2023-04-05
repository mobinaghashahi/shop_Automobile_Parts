<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\CarType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cartype', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('companyName');
            $table->rememberToken();
            $table->timestamps();
        });

        CarType::firstOrCreate([
            'name' => 'نامعلوم',
            'companyName' => 'نامعلوم',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carType');
    }
};
