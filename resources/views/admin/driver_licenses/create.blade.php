@extends('layouts.admin')

@section('title', 'Создать водительские права для анкеты')

@section('content')

  <h1>Создать водительские права для анкеты</h1>
  <hr>
  {!! Form::open(['url' => 'admin/driver_licenses']) !!}
    @include('admin.driver_licenses._form', ['submitButton' => 'Создать'])
  {!! Form::close() !!}

@stop
