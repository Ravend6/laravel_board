@extends('layouts.main')

@section('title', trans('albums.button_create'))
@section('title_class', 'fa fa-plus')
@section('title_mark', '')

@section('single-styles')

@endsection

@section('content')
  <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
      <div class="well bs-component">
        <div class="panel rounded shadow">
          @include('includes._panel-heading')
          @include('errors.validation')
          <div class="panel-body no-padding border-bottom">

            {!! Form::open(['url' => App::getLocale().'/account/album', 'class' => 'form-horizontal']) !!}
              @include('albums._form', ['submitButton' => trans('albums.button_create')])
            {!! Form::close() !!}

          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('single-scripts')

@endsection
