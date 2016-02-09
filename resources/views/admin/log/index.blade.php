@extends('layouts.admin')

@section('title', 'Логи')

@section('content')
  <h1 class="page-header">Логи</h1>
  {{-- {!! link_to_action('Admin\LanguagesController@create', 'Создать язык') !!} --}}
  <table class="table table-striped table-hover ">
    <thead>
      <tr>
        <th>#</th>
        <th>Имя события</th>
        <th>Имя пользователя</th>
        <th>Удалить</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($models as $model)
        <tr>
          <td>{{ $model->id }}</td>
          <td>{{ $model->event->name }}</td>
          <td><a href="{{ route('profile.show', ['ru', $model->user->id]) }}">{{ $model->user->name }}</a></td>
          <td>{!! delete_to_route(['admin.log.destroy', $model->id]) !!}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
  {!! $models->render() !!}
@stop
