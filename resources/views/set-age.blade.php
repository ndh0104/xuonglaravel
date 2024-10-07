@extends('master')
@section('content')
    <h1>Nhập Độ Tuổi</h1>

    @if (session('alert'))
        <div style="color: red;">{{ session('alert') }}</div>
    @endif

    <form action="/set-age" method="POST">
        @csrf
        <label for="age">Độ tuổi:</label>
        <input type="number" name="age" id="age" required>
        <button type="submit">Gửi</button>
    </form>
@endsection
