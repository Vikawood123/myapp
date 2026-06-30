<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class BookingController extends Controller
{
    public function index()
    {
        return view('booking.index');
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'day' => 'required',
            'time' => 'required',
            'training_type' => 'required'
        ]);

        Booking::create($validated);

        return redirect()->route('booking')->with('success', '✅ Вы успешно записаны на тренировку! Мы свяжемся с вами.');
    }
}
