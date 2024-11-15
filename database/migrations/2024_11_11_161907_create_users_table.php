<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\GenderType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->mediumIncrements('id');
            $table->uuid('uid')->nullable(true);
            $table->string('first_name', length: 255)->nullable(true);
            $table->string('last_name', length: 255)->nullable(true);
            $table->string('email', length: 255)->nullable(false)->default('');
            $table->string('password', length: 100)->nullable(true)->default('');
            $table->string('address', length: 255)->nullable(true);
            $table->string('phone', length: 255)->nullable(true);
            $table->string('phone_2', length: 255)->nullable(true);
            $table->string('postal_code', length: 255)->nullable(true);
            $table->date('birth_date')->nullable(true);
            $table->enum("gender", array_column(GenderType::cases(), 'value'))->default(GenderType::Male->value);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

