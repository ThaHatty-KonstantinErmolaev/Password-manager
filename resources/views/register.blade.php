@extends('layouts.layout')

@section('title')Регистрация
@endsection

@section('main_content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-6">
                <h2 class="text-center">Зарегистрироваться</h2>

                @if( $errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            <form action="/validate" method="post">
                @csrf
                <br>
                <label for="role_id">Выберите подходящую роль</label>
                <select name="role_id" id="role_id" class="form-control">
                    @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>

                <br>
                <label for="firstname" class="form-label">Ваше Имя</label>
                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Введите ваше имя">
                <br>
                <label for="surname" class="form-label">Ваша Фамилия</label>
                <input type="text" class="form-control" name="surname" id="surname" placeholder="ВВедите вашу фамилию">
                <br>
                <label for="login" class="form-label">Ваш Логин</label>
                <input type="text" class="form-control" name="login" id="login" placeholder="Введите логин">
                <br>
                <label for="email" class="form-label">Ваш Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Введите email">
                <br>
                <label for="password" class="form-label">Ваш Пароль</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Введите пароль">
                <br>
                <div class="row justify-content-around">
                    <button class="btn btn-success col-4" type="submit">Зарегистрироваться</button>
                    <a href="login" class="text-white btn btn-success col-4">Войти</a>
                </div>
            </form>
        </div>
        </div>
    </div>
@endsection
