@extends('layouts.main')

@section('title', trans('auth.login'))
@section('title_class', 'icon-login icons')
@section('title_mark', '')

@section('single-styles')

@endsection

@section('breadcrumbs')
  <ol class="breadcrumb">
    <li class="active"><a href="/">Главная </a></li> /
    <li class="active"><a href="/{{ App::getLocale() }}/auth/login">Вход </a></li>
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

          <form class="form-horizontal" role="form" method="POST" action="/{{ App::getLocale() }}/auth/login">
            <div class="form-body">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">

              <div class="form-group">
                <label class="control-label col-lg-2 col-md-3 col-sm-3 col-xs-12" for="email">E-Mail</label>
                <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                  <input type="email" class="form-control" name="email" value="{{ old('email') }}" id="email">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-lg-2 col-md-3 col-sm-3 col-xs-12" for="password">{{ trans('auth.password') }}</label>
                <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                  <input type="password" class="form-control" name="password" id="password">
                </div>
              </div>

              <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2 col-md-9 col-md-offset-32 col-sm-9 col-sm-offset-3 col-xs-12">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" name="remember"> {{ trans('auth.remember') }}
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-footer">
              <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                  <div class="pull-right">
                    <a href="/{{ App::getLocale() }}/password/email">{{ trans('auth.forgot_password') }}</a>
                    <button type="submit" class="btn btn-success mr-5">{{ trans('auth.login') }}</button>
                  </div>
                </div>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('single-scripts')

@endsection
