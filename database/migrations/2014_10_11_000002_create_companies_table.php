<?php

use App\Enums\CompanyRoleEnum;
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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignId('country_id')->constrained();
            $table->string('name');
            $table->double('multiplier')->default(0)->nullable();
            $table->string('cell_phone')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('fiscal_key')->nullable();
            $table->string('fiscal_address')->nullable();
            $table->string('business_name')->nullable();
            $table->string('billing_email')->nullable();
            $table->string('role')->default(CompanyRoleEnum::Client->value);
            $table->string('contact_name')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();
            $table->string('contact_position')->nullable();
            $table->boolean('has_active_link')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company');
    }
};
