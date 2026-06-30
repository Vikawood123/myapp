@extends('layouts.app')

@section('title', 'Расписание')

@section('content')
<div class="card">
    <h1>📅 Расписание тренировок</h1>
    
    <table class="schedule-table">
        <thead>
            <tr>
                <th>Время</th>
                <th>Понедельник</th>
                <th>Вторник</th>
                <th>Среда</th>
                <th>Четверг</th>
                <th>Пятница</th>
                <th>Суббота</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>08:00 - 09:00</td>
                <td>Йога</td>
                <td>Силовая</td>
                <td>Пилатес</td>
                <td>Силовая</td>
                <td>Йога</td>
                <td>Функциональная</td>
            </tr>
            <tr>
                <td>10:00 - 11:00</td>
                <td>Функциональная</td>
                <td>Танцы</td>
                <td>Йога</td>
                <td>Танцы</td>
                <td>Силовая</td>
                <td>Зумба</td>
            </tr>
            <tr>
                <td>18:00 - 19:00</td>
                <td>Силовая</td>
                <td>Бокс</td>
                <td>Функциональная</td>
                <td>Бокс</td>
                <td>Пилатес</td>
                <td>Танцы</td>
            </tr>
            <tr>
                <td>19:00 - 20:00</td>
                <td>Бокс</td>
                <td>Йога</td>
                <td>Силовая</td>
                <td>Йога</td>
                <td>Бокс</td>
                <td>Силовая</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
