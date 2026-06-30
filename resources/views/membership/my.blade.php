@extends('layouts.app')

@section('title', 'Мои абонементы')

@section('content')
<div class="card">
    <h1>📋 Мои абонементы</h1>

    @if($purchases->count() > 0)
        @foreach($purchases as $purchase)
        <div style="background: #f5f5f5; padding: 1.5rem; border-radius: 15px; margin-bottom: 1rem;">
            <h3>{{ $purchase->membership_name ?? $purchase->membership->name ?? 'Абонемент' }}</h3>
            <div class="price" style="font-size: 1.2rem;">{{ number_format($purchase->price) }} ₽</div>
            <p>📅 Дата покупки: {{ \Carbon\Carbon::parse($purchase->purchased_at)->format('d.m.Y') }}</p>
            <p>⏰ Действителен до: {{ \Carbon\Carbon::parse($purchase->expires_at)->format('d.m.Y') }}</p>
            <p>✅ Статус: <span style="color: green;">Активен</span></p>
        </div>
        @endforeach
    @else
        <p style="text-align: center; padding: 2rem;">У вас пока нет абонементов</p>
        <div style="text-align: center;">
            <a href="{{ route('membership') }}" class="btn">Купить абонемент</a>
        </div>
    @endif
</div>
@endsection
