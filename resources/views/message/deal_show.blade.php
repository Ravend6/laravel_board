@extends('layouts.main')

@section('title', '')
@section('title_class', 'icon-home icons')
@section('title_mark', '')

@section('breadcrumbs')
  <ol class="breadcrumb">
    <li class="active"><a href="/">{{ trans('navigation.main') }} </a></li> /
    <li class="active"><a href="{{ route('message.deal.show',
      [App::getLocale(), $deal->id]) }}"></a></li>
  </ol>
@stop

@@section('content')
  <h1>Deal show {{ $deal->title }}</h1>
@endsection
