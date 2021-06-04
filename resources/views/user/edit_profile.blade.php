@extends('layouts.layout')

@section('title')Редактировать профиль
@endsection

@section('main_content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-6">

                <h2>Редактировать профиль</h2>

                @if( $errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="/profile/validate?id={{ $id = $user_info[0]['id'] }}" method="post">
                    @csrf
                        <label for="firstname" class="form-label">Имя</label>
                        <input class="form-control" name="firstname" id="firstname" type="text" value="{{ $user_info['firstname'] }}">
                        <br>

                        <label for="surname" class="form-label">Фамилия</label>
                        <input class="form-control" name="surname" id="surname" type="text" value="{{ $user_info['surname'] }}">
                        <br>

                        <label for="login" class="form-label">Логин</label>
                        <input class="form-control" name="login" id="login" type="text" value="{{ $user_info['login'] }}">
                        <br>

                        <label for="email" class="form-label">Email</label>
                        <input class="form-control" name="email" id="email" type="email" value="{{ $user_info['email'] }}">
                        <br>

                        <input type="hidden" name="role_id" id="role_id" value="{{ $user_info['role_id'] }}">

                        <label for="password" class="form-label">Пароль</label>
                        <br>
                        <label for="password" class="form-label">Текущий пароль: {{ $user_info['password'] }}</label>
                        <input class="form-control" name="password" id="password" type="password" value="{{ $user_info['password'] }}">
                        <br>

                        <button type="submit" class="btn btn-success">Отправить</button>
                </form>

            </div>
        </div>

    </div>
@endsection
