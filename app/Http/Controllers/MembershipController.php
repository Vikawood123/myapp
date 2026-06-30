<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membership;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MembershipController extends Controller
{
    // Страница со списком абонементов
    public function index()
    {
        $memberships = Membership::where('is_active', true)->get();
        return view('membership.index', compact('memberships'));
    }

    // Страница покупки абонемента
    public function buy($id)
    {
        $membership = Membership::findOrFail($id);
        return view('membership.buy', compact('membership'));
    }

    // Обработка покупки (СОЗДАЁТ ПРАВИЛЬНЫЕ ДАТЫ!)
    public function purchase(Request $request, $id)
    {
        $membership = Membership::findOrFail($id);
        
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Войдите или зарегистрируйтесь');
        }

        // ПРАВИЛЬНЫЕ ДАТЫ (сразу при покупке)
        $purchased_at = now();
        $expires_at = now()->addDays($membership->validity_days);
        
        Purchase::create([
            'user_id' => Auth::id(),
            'membership_id' => $membership->id,
            'price' => $membership->price,
            'status' => 'paid',
            'payment_method' => $request->payment_method,
            'purchased_at' => $purchased_at,
            'expires_at' => $expires_at,
        ]);

        return redirect()->route('membership.my')->with('success', 'Абонемент успешно приобретён!');
    }

    // Мои абонементы (просмотр покупок пользователя)
    public function myMemberships()
    {
        // Для SQLite используем кэш-таблицу
        $purchases = DB::table('user_purchases_cache')
            ->where('user_id', auth()->id())
            ->get();
        
        // Если кэш пустой, пробуем получить напрямую из purchases
        if ($purchases->isEmpty()) {
            $purchases = Purchase::where('user_id', auth()->id())
                ->with('membership')
                ->orderBy('created_at', 'desc')
                ->get();
        }
        
        return view('membership.my', compact('purchases'));
    }
}
