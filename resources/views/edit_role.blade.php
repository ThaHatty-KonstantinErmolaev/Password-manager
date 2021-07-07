@extends('layouts/layout')

@section('title')Изменить роль
@endsection

@section('main_content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <h2>Редактировать роль</h2>

                @if( $errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="/roles/update/{{ $role['id'] }}" method="post">
                    @csrf
                    <label for="role[name]" class="form-label">Название роли</label>
                    <input required type="text" class="form-control" name="role[name]" id="role[name]" value="{{ $role['name'] }}">
                    <br>
                    <label for="role[parent_id]" class="form-label">Идентификатор родителя</label>
                    @if($role['parent_id'] == 0)
                        <input required disabled type="text" class="form-control" name="role[parent_id]" id="role[parent_id]" value="{{ $role['parent_id'] }}">
                    @else
                        <input required type="text" class="form-control" name="role[parent_id]" id="role[parent_id]" value="{{ $role['parent_id'] }}">
                    @endif
                    <br>
                    <button type="submit" class="btn btn-success">Отправить</button>
                </form>
            </div>
        </div>
    </div>
@endsection
