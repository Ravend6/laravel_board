@extends('layouts.admin')

@section('title', 'Создать Категорию')

@section('content')
  <div class="container">
    <h1>Создать Категорию</h1>
    <hr>
    {!! Form::open(['url' => 'admin/categories']) !!}
      @include('admin.categories._form', ['submitButton' => 'Создать'])
    {!! Form::close() !!}
  </div>
@stop
