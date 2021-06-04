@extends('layouts.layout')

@section('title')Новая категория пароля
@endsection

@section('main_content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <h2 class="text-center">Новая категория</h2>

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

                    <label for="name" class="form-label">Название категории</label>
                    <input type="text" id="name" name="name" class="form-control">
                    <br>

                    <br>

                    <button type="submit" class="btn btn-success">Отправить</button>

                </form>

            </div>
        </div>
    </div>
@endsection
