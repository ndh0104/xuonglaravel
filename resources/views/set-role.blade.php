@extends('master')
@section('content')
    <h1>Nhập Vai Trò</h1>

    <form action="/set-role" method="POST">
        @csrf
        <label for="role">Vai trò:</label>
        <input type="text" name="role" id="role" required>
        <button type="submit">Gửi</button>
    </form>

    @if (session('alert'))
        <div style="color: red;">{{ session('alert') }}</div>
    @endif
@endsection
