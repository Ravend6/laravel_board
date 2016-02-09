@extends('layouts.admin')

@section('title', 'Языки для анкеты')

@section('content')
  <h1 class="page-header">Языки для анкеты</h1>
  {!! link_to_action('Admin\LanguagesController@create', 'Создать язык') !!}
  <table class="table table-striped table-hover ">
    <thead>
      <tr>
        <th>#</th>
        <th>Заглавие</th>
        <th>Код страны 2</th>
        <th>Редактировать</th>
        <th>Удалить</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($languages as $language)
        <tr>
          <td>{{ $language->id }}</td>
          <td>{{ $language->title }}</td>
          <td>{{ $language->country_code_2 }}</td>
          <td>
            {!! link_to_route('admin.languages.edit', 'Редактировать', [$language->id], [
            'class' => 'btn btn-info btn-sm']) !!}
          </td>
          <td>{!! delete_to_route(['admin.languages.destroy', $language->id]) !!}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@stop
