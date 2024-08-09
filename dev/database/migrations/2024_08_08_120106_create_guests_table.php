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
        Schema::create('guests', function (Blueprint $table) {
            $table->uuid("id")->primary();
            $table->string('first_name')->comment('Имя');
            $table->string('last_name')->comment('Фамилия');
            $table->string('email')->comment('Почта')->unique();
            $table->string('phone')->comment('Телефон')->unique();
            $table->string('country')->comment('Страна')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};
