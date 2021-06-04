@extends('layouts.layout')

@section('title')Редактировать категорию
@endsection

@section('main_content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <h2 class="text-center">Редактировать категорию</h2>

                @if( $errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="/password/category/edit/validate/{{ $data[0]['id'] }}" method="get">
                    @csrf

                    @foreach($data as $category)

                        <input type="hidden" id="id" name="id" value="{{ $category['id'] }}">

                        <br>
                        <label for="name" class="form-label">Название категории</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $category['name'] }}">
                        <br>

                        <label for="parent_id" class="form-label">ID родителя</label>
                        <input type="number" class="form-control" id="parent_id" name="parent_id" value="{{ $category['parent_id'] }}">
                        <br>

                        <button type="submit" class="btn btn-success">Отправить</button>
                        <br>

                    @endforeach
                </form>

            </div>
        </div>
    </div>
@endsection
