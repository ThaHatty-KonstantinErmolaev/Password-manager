@extends('layouts.layout')

@section('title')Личный кабинет
@endsection

@section('main_content')
    <div class="container">
        <h1 class="text-white text-center">Личный кабинет</h1>
    </div>
    <div class="container">
        <div class="row justify-content-center">


        </div>



        <!--Информация пользователя-->
        <div class="row justify-content-center">
            @foreach($user_info as $user_item)
                <span>Ваш идентификатор: {{ $user_item['id'] }}</span>
                <br>
                <span>Имя: {{ $user_item['firstname'] }}</span>
                <br>
                <span>Фамилия: {{ $user_item['surname'] }}</span>
                <br>
                <span>Логин: {{ $user_item['login'] }}</span>
                <br>
                <span>Пароль: {{ $user_item['password'] }}</span>
                <br>
                <span>Роль: {{ $user_item['role'] }}</span>
                <br>
                <button class="col-2 btn btn-outline-info"><a href="/laravel/password.local/public/profile/edit?id={{ $user_item['id'] }}" class="text-decoration-none text-info">Редактировать</a></button>
                <div>
                    <button class="col-2 btn btn-outline-danger"><a href="/laravel/password.local/public/profile/delete?id={{ $user_item['id'] }}" class="text-decoration-none text-danger">Удалить</a></button>
                </div>
            @endforeach
        </div>
        <br>
        <hr>
        <!--Пароли пользователя-->
        <div class="container">
            <div class="row justify-content-between">
        @if($user_passwords == true)
                    @foreach($user_passwords as $user_password)

                        <div class="card bg-dark border-white" style="width: 20rem;">
                            <div class="card-body">
                                <form action="/laravel/password.local/public/password/delete" method="get">
                                    <h5 class="card-title">{{ $user_password['name'] }}</h5><span class="text-info">{{ $user_password['category'] }}</span>
                                    <h5 class="text-secondary"># {{ $user_password['tags'] }}</h5>
                                    <p class="card-text">{{ $user_password['description'] }}</p>
                                    <p class="card-text">Пароль: <span class="text-warning">{{ $user_password['value'] }}</span></p>
                                    <input type="hidden" value="{{ $user_password['id'] }}" id="id" name="id">
                                    <div>
                                        <a href="#" class="btn btn-primary">Подробнее</a>
                                        <!-- Button trigger modal -->
                                        <button type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            Удалить
                                        </button>
                                    </div>
                                </form>
                                <!-- End button trigger -->
                            </div>
                        </div>

                    @endforeach
        @endif
            </div>
        </div>
        <!---->


        <!-- Modal
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content bg-dark">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Удаление пароля</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="">Вы точно хотите удалить этот пароль?</p>
                        <p class="">{{}}</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </div>
                </div>
            </div>
        </div>
         End modal -->



    </div>
@endsection
