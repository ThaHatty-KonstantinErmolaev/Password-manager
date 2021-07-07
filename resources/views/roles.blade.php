@extends('layouts/layout')

@section('title')Роли
@endsection

@section('main_content')
    <div class="container">

        <div class="row justify-content-center">
            <div class="col-6">
                <h2 class="text-center">Роли</h2>

                <table class="table table-dark table-hover table-stripped text-white">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">name</th>
                            <th scope="col">parent_id</th>
                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($roles as $item)
                        @php /** @var \App\Models\Role $item */ @endphp
                            <tr>
                                <td>{{ $item['id'] }}</td>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['parent_id'] }}</td>
                                <td>
                                    <a class="btn btn-outline-info" href="roles/edit/{{ $item['id'] }}">Edit</a>
                                </td>
                                <td>
                                    <a class="btn btn-outline-danger" href="/delete/{{ $item['id'] }}">Delete</a>
                                </td>
                            </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
