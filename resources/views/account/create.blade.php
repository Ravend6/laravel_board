@extends('layouts.main')

@section('title', trans('account.create'))
@section('title_class', 'fa fa-plus')
@section('title_mark', '')

@section('single-styles')

@endsection

@section('breadcrumbs')
  <ol class="breadcrumb">
    <li class="active"><a href="/">{{ trans('navigation.main') }} </a></li> /
    <li class="active"><a href="{{ route('account.create', [App::getLocale()]) }}">{{ trans('navigation.create_profile') }}</a></li> {{--{{ trans('account.edit') }}--}}
  </ol>
@endsection

@section('content')
  <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
      <div class="well bs-component" style="background-color:inherit;">
        <div class="panel rounded shadow">
          @include('includes._panel-heading')
          @include('errors.validation')

          {!! Form::open(['url' => App::getLocale().'/account', 'class' => 'form-horizontal']) !!}

          @include('account._form', ['submitButton' => trans('account.create_profile')])

          {!! Form::close() !!}

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
