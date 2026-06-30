@extends('layouts.app')

@section('title', 'Статистика продаж')

@section('content')
<div class="card">
    <h1>📊 Статистика продаж абонементов</h1>

    @if(count($stats) > 0)
    <table class="schedule-table">
        <thead>
            <tr>
                <th>Абонемент</th>
                <th>Продано (шт)</th>
                <th>Выручка (₽)</th>
                <th>Средняя цена (₽)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stats as $stat)
            <tr>
                <td>{{ $stat->membership_name }}</td>
                <td>{{ $stat->total_sold ?? 0 }}</td>
                <td>{{ number_format($stat->total_revenue ?? 0) }}</td>
                <td>{{ number_format($stat->average_price ?? 0) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
        <p>Нет данных о продажах</p>
    @endif
</div>

<div class="card">
    <a href="/admin/bookings" class="btn">← Назад к записям</a>
</div>
@endsection
