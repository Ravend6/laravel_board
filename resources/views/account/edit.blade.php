@extends('layouts.main')

@section('title', trans('navigation.edit_profile'))
@section('title_class', 'icon-note icons')
@section('title_mark', '')

@section('single-styles')
  <link href="/assets/global/plugins/bower_components/dropzone/downloads/css/dropzone.css" rel="stylesheet">
@endsection

@section('breadcrumbs')
  <ol class="breadcrumb">
    <li class="active"><a href="/">{{ trans('navigation.main') }} </a></li> /
    <li class="active"><a href="{{ route('account.edit', [App::getLocale()]) }}">{{ trans('navigation.edit_profile') }}</a></li> {{--{{ trans('account.edit') }}--}}
  </ol>
@endsection

@section('content')
  <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
      <div class="well bs-component" style="background-color:inherit;">
        <div class="panel rounded shadow">
          @include('includes._panel-heading')
          @include('errors.validation')
          <div class="panel-body no-padding border-bottom">

            {!! Form::model(Auth::user()->executant,
            ['method' => 'PATCH','action' => ['AccountController@update', App::getLocale()], 'class' => 'form-horizontal']) !!}
              @include('account._form', ['submitButton' => trans('account.refresh_profile')])
            {!! Form::close() !!}

          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('single-scripts')
  <script>
    (function () {
      'use strict';

      // $('#language_list').multiselect();
      // $('#driver_license_list').multiselect();
    }());
  </script>
@endsection
