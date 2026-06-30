<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Пользователь
            $table->foreignId('membership_id')->constrained()->onDelete('cascade'); // Абонемент
            $table->integer('price');           // Цена покупки
            $table->string('status')->default('pending'); // pending, paid, cancelled
            $table->string('payment_method')->nullable(); // cash, card, online
            $table->date('purchased_at')->nullable();     // Дата покупки
            $table->date('expires_at')->nullable();       // Дата истечения
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
