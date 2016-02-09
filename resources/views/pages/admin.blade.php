@extends('layouts.admin')

@section('title', 'Главная')

@section('content')
  <h1 class="page-header">Админ Панель</h1>
  <nav>
    <ul>
      <li><a href="{{ action('Admin\LogController@index') }}">Логи</a></li>
      <li><a href="{{ action('Admin\CategoriesController@index') }}">Категории</a></li>
      <li><a href="{{ action('Admin\LanguagesController@index') }}">Языки для анкеты</a></li>
      <li><a href="{{ action('Admin\DriverLicensesController@index') }}">Водительские права для анкеты</a></li>
    </ul>
  </nav>
@stop
