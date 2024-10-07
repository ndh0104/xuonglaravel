@extends('master')
@section('content')
    @if (session('alert'))
        <div class="alert alert-danger">
            {{ session('alert') }}
        </div>
    @endif
    <h1>Welcome to my Website</h1>
@endsection
