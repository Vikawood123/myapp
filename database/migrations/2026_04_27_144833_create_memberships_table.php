<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->string('name');           // Название абонемента
            $table->text('description');      // Описание
            $table->integer('price');         // Цена в рублях
            $table->integer('trainings_count'); // Количество тренировок (0 = безлимит)
            $table->integer('validity_days');   // Срок действия в днях
            $table->boolean('is_active')->default(true); // Активен ли
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('memberships');
    }
};
