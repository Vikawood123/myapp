<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // ==========================================
        // ТРИГГЕР 1: автоматическая дата покупки
        // ==========================================
        DB::statement("DROP TRIGGER IF EXISTS set_purchase_dates;");
        DB::statement("
            CREATE TRIGGER set_purchase_dates
            AFTER INSERT ON purchases
            FOR EACH ROW
            WHEN NEW.purchased_at IS NULL
            BEGIN
                UPDATE purchases 
                SET 
                    purchased_at = DATE('now'),
                    expires_at = DATE('now', '+30 days')
                WHERE id = NEW.id;
            END;
        ");

        // ==========================================
        // ТАБЛИЦА И ТРИГГЕР ДЛЯ СТАТИСТИКИ ПРОДАЖ
        // (заменяет процедуру getSalesStats)
        // ==========================================
        
        // Таблица для хранения статистики
        DB::statement("
            CREATE TABLE IF NOT EXISTS sales_stats (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                membership_name TEXT,
                total_sold INTEGER,
                total_revenue INTEGER,
                average_price REAL,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            );
        ");
        
        // Триггер для обновления статистики
        DB::statement("DROP TRIGGER IF EXISTS update_sales_stats;");
        DB::statement("
            CREATE TRIGGER update_sales_stats
            AFTER INSERT ON purchases
            FOR EACH ROW
            BEGIN
                -- Удаляем старую статистику по этому абонементу
                DELETE FROM sales_stats WHERE membership_name = (
                    SELECT name FROM memberships WHERE id = NEW.membership_id
                );
                
                -- Вставляем обновлённую статистику
                INSERT INTO sales_stats (membership_name, total_sold, total_revenue, average_price)
                SELECT 
                    m.name,
                    COUNT(p.id) as total_sold,
                    COALESCE(SUM(p.price), 0) as total_revenue,
                    COALESCE(AVG(p.price), 0) as average_price
                FROM memberships m
                LEFT JOIN purchases p ON m.id = p.membership_id AND p.status = 'paid'
                WHERE m.id = NEW.membership_id
                GROUP BY m.id;
            END;
        ");

        // ==========================================
        // ТАБЛИЦА И ТРИГГЕР ДЛЯ ПОКУПОК ПОЛЬЗОВАТЕЛЯ
        // (заменяет процедуру getUserPurchases)
        // ==========================================
        
        // Таблица для кэша покупок пользователя
        DB::statement("
            CREATE TABLE IF NOT EXISTS user_purchases_cache (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                user_id INTEGER,
                user_name TEXT,
                membership_name TEXT,
                trainings_count INTEGER,
                price INTEGER,
                status TEXT,
                payment_method TEXT,
                purchased_at DATE,
                expires_at DATE,
                created_at TIMESTAMP,
                updated_at TIMESTAMP
            );
        ");
        
        // Триггер для обновления кэша покупок
        DB::statement("DROP TRIGGER IF EXISTS update_user_purchases_cache;");
        DB::statement("
            CREATE TRIGGER update_user_purchases_cache
            AFTER INSERT ON purchases
            FOR EACH ROW
            BEGIN
                -- Удаляем старый кэш для этого пользователя
                DELETE FROM user_purchases_cache WHERE user_id = NEW.user_id;
                
                -- Вставляем актуальные покупки пользователя
                INSERT INTO user_purchases_cache 
                    (user_id, user_name, membership_name, trainings_count, price, status, payment_method, purchased_at, expires_at, created_at, updated_at)
                SELECT 
                    u.id,
                    u.name,
                    m.name,
                    m.trainings_count,
                    p.price,
                    p.status,
                    p.payment_method,
                    p.purchased_at,
                    p.expires_at,
                    p.created_at,
                    p.updated_at
                FROM purchases p
                JOIN users u ON p.user_id = u.id
                JOIN memberships m ON p.membership_id = m.id
                WHERE p.user_id = NEW.user_id
                ORDER BY p.created_at DESC;
            END;
        ");
    }

    public function down(): void
    {
        // Удаляем триггеры
        DB::statement("DROP TRIGGER IF EXISTS set_purchase_dates;");
        DB::statement("DROP TRIGGER IF EXISTS update_sales_stats;");
        DB::statement("DROP TRIGGER IF EXISTS update_user_purchases_cache;");
        
        // Удаляем таблицы
        DB::statement("DROP TABLE IF EXISTS sales_stats;");
        DB::statement("DROP TABLE IF EXISTS user_purchases_cache;");
    }
};
