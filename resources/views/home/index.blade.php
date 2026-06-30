@extends('layouts.app')

@section('title', 'Главная')

@section('content')
<div class="card">
    <h1>Добро пожаловать в СпортКлуб!</h1>
    <p style="margin-top: 1rem; font-size: 1.2rem;">
        Достигайте своих целей с лучшими тренерами и современным оборудованием.
    </p>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
    <div class="card">
        <h3>💪 Профессиональные тренеры</h3>
        <p>Опытные тренеры помогут достичь ваших целей</p>
    </div>
    <div class="card">
        <h3>🏋️‍♂️ Современное оборудование</h3>
        <p>Новейшие тренажеры от лучших производителей</p>
    </div>
    <div class="card">
        <h3>📅 Гибкое расписание</h3>
        <p>Удобное время для тренировок</p>
    </div>
    <div class="card">
        <h3>💰 Доступные цены</h3>
        <p>Различные абонементы на любой бюджет</p>
    </div>
</div>

<div class="card" style="text-align: center;">
    <h2>Готовы начать?</h2>
    <a href="/booking" class="btn" style="margin-top: 1rem;">Записаться сейчас</a>
</div>

@auth
<div class="card" style="text-align: center; background: #e8f0fe;">
    <h3>👋 Привет, {{ auth()->user()->name }}!</h3>
    <p>Вы авторизованы. Перейдите в <a href="/admin/bookings">админ-панель</a> для управления записями.</p>
</div>
@endauth
@endsection
