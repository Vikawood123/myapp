@extends('layouts.app')

@section('title', 'Онлайн-запись')

@section('content')
<div class="card">
    <h1>📝 Онлайн-запись на тренировку</h1>
    <p style="margin-top: 0.5rem;">Заполните форму для записи</p>

    <form method="POST" action="/booking/submit" style="margin-top: 2rem;">
        @csrf
        
        <div class="form-group">
            <label for="name">Ваше имя *</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="phone">Телефон *</label>
            <input type="tel" id="phone" name="phone" required>
        </div>

        <div class="form-group">
            <label for="email">Email *</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="day">День недели *</label>
            <select id="day" name="day" required>
                <option value="">Выберите день</option>
                <option value="monday">Понедельник</option>
                <option value="tuesday">Вторник</option>
                <option value="wednesday">Среда</option>
                <option value="thursday">Четверг</option>
                <option value="friday">Пятница</option>
                <option value="saturday">Суббота</option>
            </select>
        </div>

        <div class="form-group">
            <label for="time">Время *</label>
            <select id="time" name="time" required>
                <option value="">Выберите время</option>
                <option value="08:00">08:00 - 09:00</option>
                <option value="10:00">10:00 - 11:00</option>
                <option value="18:00">18:00 - 19:00</option>
                <option value="19:00">19:00 - 20:00</option>
            </select>
        </div>

        <div class="form-group">
            <label for="training_type">Тип тренировки *</label>
            <select id="training_type" name="training_type" required>
                <option value="">Выберите тип</option>
                <option value="yoga">Йога</option>
                <option value="strength">Силовая</option>
                <option value="functional">Функциональная</option>
                <option value="boxing">Бокс</option>
                <option value="dance">Танцы</option>
                <option value="pilates">Пилатес</option>
            </select>
        </div>

        <button type="submit" class="btn">Записаться</button>
    </form>
</div>

@if(session('success'))
<div class="card" style="background: #d4edda; color: #155724;">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="card" style="background: #f8d7da; color: #721c24;">
    {{ session('error') }}
</div>
@endif
@endsection
