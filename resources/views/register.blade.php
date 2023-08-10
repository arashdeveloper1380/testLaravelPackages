@extends('layouts.master')

@section('content')
    <h4>Register</h4>
    <form action="/register-store" method="post">
        <input type="text" name="name" placeholder="Enter Name ..."><br><br>
        <input type="text" name="email" placeholder="Enter Email ..."><br><br>
        <input type="text" name="password" placeholder="Enter Password ..."><br><br>
        <input type="submit">
    </form>
@endsection