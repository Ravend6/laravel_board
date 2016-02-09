@extends('layouts.main')

@section('title', $profile->name)
@section('title_class', 'icon-home icons')
@section('title_mark', '')

@section('breadcrumbs')
  <ol class="breadcrumb">
    <li class="active"><a href="/">{{ trans('navigation.main') }} </a></li> /
    <li class="active"><a href="{{ route('profile.show', [App::getLocale(), $profile->id]) }}">{{ $profile->name }}</a></li>
  </ol>
@stop

@section('content')
  <ul>
    <li>{{ $profile->name }}</li>
    <li>{{ $profile->surname }}</li>
    <li>{{ $profile->email }}</li>
    <li>{{ $profile->birthday }}</li>
    <li>{{ $profile->phone }}</li>
    <li>{{ $profile->gender }}</li>
    <li>{{ $profile->lang }}</li>
    <li>{{ $profile->invoice }}</li>
    <li>{{ $profile->avatar }}</li>
  </ul>
@endsection
