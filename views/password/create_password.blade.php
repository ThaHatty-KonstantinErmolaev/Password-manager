@extends('layouts.layout')

@section('title')Новый пароль
@endsection

@section('main_content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-6">
                <h2 class="text-center">Новый пароль</h2>

                @if( $errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="validate" method="get">
                    @csrf

                    <label for="category_id">Категория</label>
                    <select class="form-control" name="category_id" id="category_id">
                        @foreach($categories as $category)
                            <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                        @endforeach
                    </select>
                    <br>

                    <label for="name">Название пароля</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Пароль от">
                    <br>

                    <label for="value">Пароль</label>
                    <input type="password" class="form-control" name="value" id="value">
                    <br>

                    <label for="login">Логин</label>
                    <input type="text" class="form-control" name="login" id="login" placeholder="Логин от которого пароль">
                    <br>

                    @if( session()->get('is_authorised') == true && session()->get('user_id') == 1 )

                        <label for="role">Роль для которой пароль будет отображаться</label>
                        <select name="password_role_id" id="password_role_id" class="form-control">
                            @foreach($all_roles as $role)

                                <option value="{{ $role['id'] }}">{{ $role['name'] }}</option>

                            @endforeach
                        </select>
                        <br>

                    @else
                        <input type="hidden" class="form-control" name="password_role_id" id="password_role_id" value="{{ $user_role['id'] }}">
                    @endif

                    <label for="description">Описание</label>
                    <textarea class="form-control" name="description" id="description" maxlength="100"></textarea>
                    <br>

                    <label for="tags">Тег (Опционально)</label>
                    <textarea class="form-control" name="tags" id="tags" maxlength="30"></textarea>
                    <br>

                    <input type="hidden" class="form-control" name="user_id" id="user_id" value="{{ $user_id }}">

                    <button type="submit" class="btn btn-success text-white">Отправить</button>
                </form>

            </div>
        </div>

    </div>
@endsection
