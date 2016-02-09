@extends('layouts.main')

@section('title', $task->title)
@section('title_class', 'icon-home icons')
@section('title_mark', '')

@section('breadcrumbs')
  <ol class="breadcrumb">
    <li class="active"><a href="/">{{ trans('navigation.main') }}</a></li> /
    {{-- <li class="active"><a href="{{ route('task.show', [App::getLocale(), $task->slug]) }}">{{ $task->title }}</a></li> --}}
  </ol>
@stop

@section('content')

@endsection
