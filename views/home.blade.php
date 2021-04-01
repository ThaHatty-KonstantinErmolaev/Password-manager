@extends('layouts.layout')

@section('title')Главная страница
@endsection

@section('main_content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="row">
                <h2>Lorem, Ipsum</h2>
            </div>
            @if(session()->get('is_authorised') == true)
                <h1 class="text-danger">You're awesome!</h1>
            @endif
        </div>
    </div>
@endsection
