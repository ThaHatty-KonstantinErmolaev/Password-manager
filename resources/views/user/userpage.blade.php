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
                <span>Ваш идентификатор: {{ $user_info['id'] }}</span>
                <br>
                <span>Имя: {{ $user_info['firstname'] }}</span>
                <br>
                <span>Фамилия: {{ $user_info['surname'] }}</span>
                <br>
                <span>Логин: {{ $user_info['login'] }}</span>
                <br>
                <span>Пароль: {{ $user_info['password'] }}</span>
                <br>
                <span>Роль: {{ $user_info['role']['name'] }}</span>
                <br>
                <button class="col-2 btn btn-outline-info"><a href="/profile/edit?id={{ $user_info['id'] }}" class="text-decoration-none text-info">Редактировать</a></button>
                <div>
                    <button class="col-2 btn btn-outline-danger"><a href="/profile/delete?id={{ $user_info['id'] }}" class="text-decoration-none text-danger">Удалить</a></button>
                </div>
                <br>
                <br>
                <div>
                    <button class="col-2 btn btn-outline-success"><a href="/passwords" class="text-decoration-none text-white">Мои пароли</a></button>
                </div>
        </div>
        <br>
        <hr>


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
                        <p class=""></p>
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
