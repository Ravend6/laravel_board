@extends('layouts.main')

@section('title', 'Задачи поставленные')
@section('title_class', 'icon-home icons')
@section('title_mark', '')

@section('breadcrumbs')
  <ol class="breadcrumb">
    <li class="active"><a href="/">{{ trans('navigation.main') }} </a></li> /
    <li class="active"><a href="{{ route('message.task.index',
      [App::getLocale()]) }}">Задачи поставленные</a></li>
  </ol>
@stop

@section('content')
  @foreach ($tasks as $task)
    <article>
      <h2>{{ $task->title }}</h2>
    </article>
  @endforeach
@endsection
