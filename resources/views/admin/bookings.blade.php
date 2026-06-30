@extends('layouts.app')

@section('title', 'Админ-панель')

@section('content')
<div class="card">
    <h1>👑 Админ-панель - Записи на тренировки</h1>
    
    @if(session('success'))
        <div style="background: #d4edda; color: #155724; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
            {{ session('success') }}
        </div>
    @endif

    @if($bookings->count() > 0)
        <table class="schedule-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Телефон</th>
                    <th>Email</th>
                    <th>День</th>
                    <th>Время</th>
                    <th>Тренировка</th>
                    <th>Дата записи</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                <tr>
                    <td>{{ $booking->id }}</td>
                    <td>{{ $booking->name }}</td>
                    <td>{{ $booking->phone }}</td>
                    <td>{{ $booking->email }}</td>
                    <td>{{ $booking->day }}</td>
                    <td>{{ $booking->time }}</td>
                    <td>{{ $booking->training_type }}</td>
                    <td>{{ $booking->created_at->format('d.m.Y H:i') }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.booking.delete', $booking->id) }}" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn" style="background: #dc3545; padding: 5px 15px;" onclick="return confirm('Удалить запись?')">Удалить</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p style="text-align: center; padding: 2rem;">Пока нет ни одной записи</p>
    @endif
</div>

<div class="card" style="text-align: center; margin-top: 1rem;">
    <a href="/" class="btn">На главную</a>
</div>
@endsection
