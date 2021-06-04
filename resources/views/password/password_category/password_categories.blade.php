@extends('layouts.layout')

@section('title')Категории
@endsection

@section('main_content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <h2 class="text-center">Категории</h2>

                @if( $errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div>
                    <table class="table text-white">
                        <thead class="">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Название</th>
                                <th scope="col">ID родителя</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <form action="/password/category/edit/{{ $category['id'] }}" method="get">
                                    <th scope="col">{{ $category['id'] }}</th>
                                    <th scope="col">{{ $category['name'] }}</th>
                                    <th scope="col">{{ $category['parent_id'] }}</th>
                                    <th scope="col">
                                        <input type="hidden" id="id" name="id" value="{{ $category['id'] }}">
                                        <button type="submit" class="btn btn-outline-info bg-dark text-white">Изменить</button>
                                    </th>
                                    </form>
                                    <th scope="col">
                                        <form action="/password/category/delete/{{ $category['id'] }}" method="get">
                                            <input type="hidden" value="{{ $category['id'] }}" id="id" name="id">
                                            <button type="submit" class="btn btn-outline-danger text-white">Удалить</button>
                                        </form>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
