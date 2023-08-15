@extends('layouts.master')

@section('content')

    {{ getData('users') }} <br><br>
    {{ findData('users', 1)['name'] }} <br><br>
    {{ $name }}

    <form action="{{ route('login') }}" method="POST">
        <input type="text" name="email" placeholder="Enter Email ..."><br><br>
        <input type="text" name="password" placeholder="Enter Password ..."><br><br>
        <input type="submit">
    </form>
    
@endsection