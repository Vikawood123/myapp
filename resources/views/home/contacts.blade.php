@extends('layouts.app')

@section('title', 'Контакты')

@section('content')
<div class="card">
    <h1>📞 Контакты</h1>
    
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-top: 2rem;">
        <div>
            <h3>Адрес</h3>
            <p>г. Москва, ул. Спортивная, 15</p>
            
            <h3>Телефон</h3>
            <p>+7 (999) 123-45-67</p>
            
            <h3>Email</h3>
            <p>info@sportclub.ru</p>
            
            <h3>Режим работы</h3>
            <p>Пн-Пт: 08:00 - 22:00</p>
            <p>Сб-Вс: 09:00 - 21:00</p>
        </div>
        
        <div>
            <h3>Как добраться</h3>
            <p>🚇 Метро "Спортивная" - 5 минут пешком</p>
            <p>🚌 Автобусы: 12, 34, 56 до остановки "Спорткомплекс"</p>
            
            <h3>Свяжитесь с нами</h3>
            <p>📧 Email: <strong>info@sportclub.ru</strong></p>
            <p>📞 Телефон: <strong>+7 (999) 123-45-67</strong></p>
        </div>
    </div>
</div>
@endsection
