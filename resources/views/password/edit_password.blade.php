@extends('layouts/layout')

@section('title')Изменить пароль
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

                <form action="" method="get">
                    @csrf
                    <label for="name" class="form-label">Название пароля</label>
                    <input class="form-control" name="name" id="name" type="text" value="{{ $password['name'] }}">
                    <br>

                    <label for="value" class="form-label">Пароль</label>
                    <input class="form-control" name="value" id="value" type="password" value="{{ $password['value'] }}">
                    <br>

                    <label for="login" class="form-label">Логин</label>
                    <input class="form-control" name="login" id="login" type="text" value="{{ $password['login'] }}">
                    <br>

                    <label for="description" class="form-label">Описание</label>
                    <textarea class="form-control" name="description" id="description">
                        {{ $password['description'] }}
                    </textarea>
                    <br>

                    <input type="hidden" name="password_id" id="password_id" value="{{ $password['id'] }}">
                    <label for="category_id">Категории</label>
                    <select class="form-control" name="category_id[]" id="category_id" multiple aria-multiselectable="true">
                        @foreach($password->categories as $category)
                            <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                        @endforeach
                    </select>
                    <br>
                    <label for="password" class="form-label">Текущий пароль: </label>
                    <input class="form-control" name="password" id="password" type="password" value="">
                    <br>

                    <button type="submit" class="btn btn-success">Отправить</button>
                </form>


            </div>


        </div>
    </div>
@endsection
