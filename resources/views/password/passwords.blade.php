@extends('layouts/layout')

@section('title')
@endsection

@section('main_content')

    <div class="container">
        <div class="row justify-content-between">

            @foreach($paginator as $item)
                @php /** @var \App\Models\Password $item */ @endphp

                <div class="card bg-dark border-white" style="width: 20rem;">
                    <div class="card-body">
                        <form action="/password/delete{{ $item['id'] }}" method="post">
                            @csrf
                            <h5 class="card-title">{{ $item['name'] }}</h5>
                            @foreach($item['categories'] as $category)
                                <span class="text-info">{{ $category['name'] }}</span>
                                <br>
                            @endforeach
                            <p class="card-text">{{ $item['description'] }}</p>
                            <p class="card-text">
                                Пароль: <span class="text-warning">{{ Crypt::decryptString($item['value']) }}</span>
                            </p>
                            <input type="hidden" value="{{ $item['id'] }}" id="id" name="id">
                            <div>
                                <a href="/password/edit/{{ $item['id']}}" class="btn btn-primary">Подробнее</a>
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

            @if($paginator->total() > $paginator->count())
                <br>
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                {{ $paginator->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>

@endsection
