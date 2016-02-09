@extends('layouts.main')

@section('title', trans('auth.login'))

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">{{ trans('auth.login') }}</div>
        <div class="panel-body">
          @include('errors.validation')

          <form class="form-horizontal" role="form" method="POST" action="/{{ App::getLocale() }}/auth/login">
          {{-- <form class="form-horizontal" role="form" method="POST" action="/auth/login"> --}}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
              <label class="col-md-4 control-label" for="email">E-Mail</label>
              <div class="col-md-6">
                <input type="email" class="form-control" name="email" value="{{ old('email') }}" id="email">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label" for="password">{{ trans('auth.password') }}</label>
              <div class="col-md-6">
                <input type="password" class="form-control" name="password" id="password">
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="remember"> {{ trans('auth.remember') }}
                  </label>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary" style="margin-right: 15px;">
                  {{ trans('auth.login') }}
                </button>

                <a href="/{{ App::getLocale() }}/password/email">{{ trans('auth.forgot_password') }}</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
