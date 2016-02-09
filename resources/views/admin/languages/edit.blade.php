@extends('layouts.admin')

@section('title', 'Редактировать '.$language->title)

@section('content')
  <div class="container">
    <h1>{{ 'Редактировать '.$language->title }}</h1>
    <hr>
    {!! Form::model($language, [
      'method' => 'PATCH',
      'action' => ['Admin\LanguagesController@update', $language->id]
    ]) !!}
      @include('admin.languages._form', ['submitButton' => 'Обновить'])
    {!! Form::close() !!}
  </div>
@stop