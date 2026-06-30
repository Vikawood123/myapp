<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // Список всех записей на тренировки
    public function bookings()
    {
        $bookings = Booking::orderBy('created_at', 'desc')->get();
        return view('admin.bookings', compact('bookings'));
    }
    
    // Удаление записи
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();
        
        return redirect()->route('admin.bookings')->with('success', 'Запись удалена');
    }
    
    // Статистика продаж (из таблицы sales_stats для SQLite)
    public function stats()
    {
        $stats = DB::table('sales_stats')->get();
        return view('admin.stats', compact('stats'));
    }
}
