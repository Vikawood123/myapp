@extends('layouts.app')

@section('title', 'Оплата абонемента')

@section('content')
<div class="card">
    <h1>💳 Оформление абонемента</h1>
    
    <div style="background: #f5f5f5; padding: 1.5rem; border-radius: 15px; margin-bottom: 2rem;">
        <h3>{{ $membership->name }}</h3>
        <div class="price" style="font-size: 1.5rem;">{{ number_format($membership->price) }} ₽</div>
        <p>{{ $membership->description }}</p>
        <p>📅 Срок действия: {{ $membership->validity_days }} дней</p>
    </div>

    <form method="POST" action="{{ route('membership.purchase', $membership->id) }}">
        @csrf
        
        <div class="form-group">
            <label for="payment_method">Способ оплаты</label>
            <select name="payment_method" id="payment_method" required>
                <option value="card">💳 Банковская карта (онлайн)</option>
                <option value="cash">💰 Наличные в клубе</option>
                <option value="terminal">📱 Терминал в клубе</option>
            </select>
        </div>

        <button type="submit" class="btn">Оплатить {{ number_format($membership->price) }} ₽</button>
        <a href="{{ route('membership') }}" class="btn" style="background: #666;">Назад</a>
    </form>
</div>
@endsection
