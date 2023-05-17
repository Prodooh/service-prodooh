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
        Schema::create('company_country', function (Blueprint $table) {
            $table->foreignId('company_id')->constrained('companies');
            $table->foreignId('country_id')->constrained('countries');
            $table->double('discount', 8, 2)->default(0);
            $table->double('increase', 8, 2)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_country');
    }
};
