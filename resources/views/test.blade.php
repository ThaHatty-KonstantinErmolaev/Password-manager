@extends('layouts.layout')

@section('title') Testing's good
@endsection

@section('main_content')
    <h1 class="text-danger">The red text blablalbalba</h1>
    {{ dd($request) }}
@endsection
