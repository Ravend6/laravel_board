@extends('layouts.main')

@section('title', 'Доска')
@section('title_class', 'icon-home icons')
@section('title_mark', '')

@section('single-styles')

@stop

@section('breadcrumbs')
  <ol class="breadcrumb">
    <li class="active"><a href="/">{{ trans('navigation.main') }}</a></li>
    <li class="active"><a href="/{{ App::getLocale() }}/board">{{ trans('navigation.board') }}</a></li>
  </ol>
@stop

@section('content')
  <div class="body-content animated fadeIn">
    <div id="blog-list">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-9">

          @foreach ($tasks as $task)
            <div class="blog-item rounded shadow">
              <a href="{{ route('task.show', [App::getLocale(), $task->slug]) }}" class="blog-img">
                @if ($task->image)
                  <img src="/uploads/users/tasks/{{ $task->id }}/{{ $task->image }}" alt="{{ $task->title }}" width="300" height="200"/>
                @else
                  <img src="http://img.djavaui.com/?create=300x200,81B71A?f=ffffff" class="img-responsive full-width" alt="{{ $task->title }}">
                @endif
              </a>
              <div class="blog-details">
                <div class="ribbon-wrapper">
                  <div class="ribbon ribbon-danger">{{ trans('default.hot') }}</div>
                </div>
                <h4 class="blog-title">
                  <a href="{{ route('task.show', [App::getLocale(), $task->slug]) }}">
                    {{ $task->title }}</a>
                </h4>
                <ul class="blog-meta">
                  <li>Автор: <a href="{{ route('profile.show', [App::getLocale(), $task->customer->id]) }}" target="_blank">
                      {{ $task->customer->name }}</a></li>
                  <li>{{ $task->created_at->diffForHumans() }}</li>
                  <li><a href="{{ route('task.show', [App::getLocale(), $task->slug]) }}">
                      {{ $task->propositions->count() }} {{ trans('default.propositions') }}</a></li>
                </ul>
                <div class="blog-summary">
                  <p>{{ $task->description }}</p>
                  <a href="{{ route('task.show', [App::getLocale(), $task->slug]) }}" class="btn btn-sm btn-success">{{ trans('default.details') }}</a>
                </div>
              </div>
            </div>

          @endforeach

          {!! $tasks->render() !!}
        </div>
        <div id="filters" class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
          <!-- Start icon left panel -->
          <div class="panel">
            <div class="panel-heading">
              <div class="pull-left">
                <h3 class="panel-title"><i class="fa fa-check"></i> {{trans('navigation.filters')}}</h3>
              </div>
              <div class="pull-right">
                <button class="btn btn-sm" data-action="collapse" data-toggle="tooltip" data-placement="top" data-title="Collapse" data-original-title="" title=""><i class="fa fa-angle-up"></i></button>
              </div>
              <div class="clearfix"></div>
            </div><!-- /.panel-heading -->
            <div class="panel-body">
              <a href="{{ route('task.create', [App::getLocale()]) }}" class="btn btn-default">{{trans('default.create_task')}}</a>
            </div><!-- /.panel-body -->
          </div><!-- /.panel -->
          <!--/ End icon left panel -->
        </div>

      </div>
    </div>
    <div class="pagination">

    </div>
  </div>

@stop

@section('single-scripts')
  <script src="/assets/admin/js/pages/blankon.dashboard.js"></script>
@stop
