@extends('layouts.admin')

@section('title', 'Редактировать '.$category->title)

@section('content')
  <div class="container">
    <h1>{{ 'Редактировать '.$category->title }}</h1>
    <hr>
    {!! Form::model($category, [
      'method' => 'PATCH',
      'action' => ['Admin\CategoriesController@update', $category->id]
    ]) !!}
      @include('admin.categories._form', ['submitButton' => 'Обновить'])
    {!! Form::close() !!}
  </div>
@stop