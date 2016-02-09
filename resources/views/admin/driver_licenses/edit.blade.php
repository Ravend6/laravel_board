@extends('layouts.admin')

@section('title', 'Редактировать '.$driver_license->title)

@section('content')
  <div class="container">
    <h1>{{ 'Редактировать '.$driver_license->title }}</h1>
    <hr>
    {!! Form::model($driver_license, [
      'method' => 'PATCH',
      'action' => ['Admin\DriverLicensesController@update', $driver_license->id]
    ]) !!}
      @include('admin.languages._form', ['submitButton' => 'Обновить'])
    {!! Form::close() !!}
  </div>
@stop