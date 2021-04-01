@extends('layouts.layout')

@section('title')Войти
@endsection

@section('main_content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <h2 class="text-center">Войти</h2>

                @if( $errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <h2>{{ $err }}</h2>

                <form action="/laravel/password.local/public/validate/login" method="post">
                    @csrf
                    <br>
                    <label for="login">Введите логин</label>
                    <input name="login" id="login" type="text" class="form-control">
                    <br>
                    <label for="password">Введите пароль</label>
                    <input name="password" id="password" type="password" class="form-control">
                    <br>
                    <button type="submit" class="btn btn-success col-4">Войти</button>
                </form>
            </div>
        </div>
    </div>
@endsection
