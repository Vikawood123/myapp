// В файле database/migrations/2026_05_16_000000_add_sqlite_triggers_and_tables.php

public function up()
{
    // Создаём таблицы всегда
    Schema::create('sales_stats', function (Blueprint $table) {
        $table->id();
        $table->integer('total_sales')->default(0);
        $table->timestamps();
    });

    Schema::create('user_purchases_cache', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->integer('purchases_count')->default(0);
        $table->timestamps();
    });

    // А ТРИГГЕРЫ ТОЛЬКО ДЛЯ ПРОДАКШЕНА
    if (app()->environment('production')) {
        DB::statement('
            CREATE TRIGGER update_sales_stats
            AFTER INSERT ON purchases
            BEGIN
                UPDATE sales_stats SET total_sales = total_sales + 1;
            END;
        ');
    }
}
