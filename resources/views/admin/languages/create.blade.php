@extends('layouts.admin')

@section('title', 'Создать язык для анкеты')

@section('content')

  <h1>Создать язык для анкеты</h1>
  <hr>
  {!! Form::open(['url' => 'admin/languages']) !!}
    @include('admin.languages._form', ['submitButton' => 'Создать'])
  {!! Form::close() !!}

@stop
