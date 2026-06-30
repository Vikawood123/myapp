@extends('layouts.app')

@section('title', 'Абонементы')

@section('content')
<div class="card">
    <h1>💰 Наши абонементы</h1>
    <p style="margin-top: 0.5rem;">Выберите подходящий вариант</p>

    <div class="membership-grid">
        @foreach($memberships as $membership)
        <div class="membership-card">
            <h3>{{ $membership->name }}</h3>
            <div class="price">{{ number_format($membership->price) }} ₽</div>
            <p>
                @if($membership->trainings_count == 0)
                    ♾️ Безлимит тренировок
                @else
                    🏋️ {{ $membership->trainings_count }} тренировки(а)
                @endif
            </p>
            <p>📅 {{ $membership->validity_days }} дней</p>
            <p style="color: #666; font-size: 0.9rem; margin-top: 1rem;">{{ $membership->description }}</p>
            <a href="{{ route('membership.buy', $membership->id) }}" class="btn" style="margin-top: 1rem;">Купить</a>
        </div>
        @endforeach
    </div>
</div>

@auth
<div class="card" style="text-align: center;">
    <h3>📋 Мои абонементы</h3>
    <a href="{{ route('membership.my') }}" class="btn">Посмотреть мои абонементы</a>
</div>
@endauth
@endsection
