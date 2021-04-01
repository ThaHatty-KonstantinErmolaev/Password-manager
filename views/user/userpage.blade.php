@extends('layouts.layout')

@section('title')Личный кабинет
@endsection

@section('main_content')
    <div class="container">
        <h1 class="text-info">User's page</h1>
    </div>
    <div class="container">
        <div class="row justify-content-end">

        </div>
        <div class="row">
            @foreach($user_info as $user_item)
                <span>Ваш идентификатор: {{ $user_item['id'] }}</span>
                <span>Имя: {{ $user_item['firstname'] }}</span>
                <span>Фамилия: {{ $user_item['surname'] }}</span>
                <span>Логин: {{ $user_item['login'] }}</span>
                <span>Пароль: {{ $user_item['password'] }}</span>
                <span>Роль: {{ $user_item['role'] }}</span>
                <button class="col-2 btn btn-outline-info"><a href="/laravel/password.local/public/profile/edit?id={{ $user_item['id'] }}" class="text-decoration-none text-info">Редактировать</a></button>
            @endforeach
        </div>
    </div>
@endsection
