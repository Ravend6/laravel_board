@extends('layouts.main')

@section('title', trans('auth.register'))
@section('title_class', 'icon-user-follow icons')
@section('title_mark', '')

@section('single-styles')

@endsection

@section('breadcrumbs')
  <ol class="breadcrumb">
    <li class="active"><a href="/">{{ trans('navigation.main') }} </a></li> /
    <li class="active"><a href="{{ action('SessionController@getRegister', [App::getLocale()]) }}">{{ trans('auth.register') }} </a></li>
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
            <form class="form-horizontal" role="form" method="POST" action="/{{ App::getLocale() }}/auth/register">
              <div class="form-body">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                  <label class="control-label col-lg-2 col-md-3 col-sm-3 col-xs-12" for="name">{{ trans('auth.name') }}</label>
                  <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="name" {{ old('_disabled') ? 'readonly' : '' }}>
                    @if ($errors->has('name'))
                      <span class="help-block">{{ $errors->first('name') }}</span>
                    @endif
                  </div>
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                  <label class="control-label col-lg-2 col-md-3 col-sm-3 col-xs-12" for="email">E-Mail</label>
                  <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" id="email" {{ old('_disabled') ? 'readonly' : '' }}>
                    @if ($errors->has('email'))
                      <span class="help-block">{{ $errors->first('email') }}</span>
                    @endif
                  </div>
                </div>
                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                  <label class="control-label col-lg-2 col-md-3 col-sm-3 col-xs-12" for="phone">{{ trans('auth.phone') }}</label>
                  <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                    <input type="tel" class="form-control" name="phone" value="{{ old('phone') }}" id="phone" {{ old('_disabled') ? 'readonly' : '' }}>
                    @if ($errors->has('category_id'))
                      <span class="help-block">{{ $errors->first('phone') }}</span>
                    @endif
                  </div>
                </div>
                <div class="form-group{{ $errors->has('date') ? ' has-error' : '' }}">
                  <label class="control-label col-lg-2 col-md-3 col-sm-3 col-xs-12" for="birthday">{{ trans('auth.birthday') }}</label>
                  <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                    <input type="date" class="form-control" name="birthday" value="{{ old('birthday') }}" id="birthday">
                    @if ($errors->has('date'))
                      <span class="help-block">{{ $errors->first('date') }}</span>
                    @endif
                  </div>
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                  <label class="control-label col-lg-2 col-md-3 col-sm-3 col-xs-12" for="password">{{ trans('auth.password') }}</label>
                  <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                    <input type="password" class="form-control" name="password" id="password">
                    @if ($errors->has('password'))
                      <span class="help-block">{{ $errors->first('password') }}</span>
                    @endif
                  </div>
                </div>
                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                  <label class="control-label col-lg-2 col-md-3 col-sm-3 col-xs-12" for="password_confirmation">{{ trans('auth.password_confirm') }}</label>
                  <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                    @if ($errors->has('password_confirmation'))
                      <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
                    @endif
                  </div>
                </div>
                <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                  {!! Form::label('gender', trans('auth.gender'),
                    ['class' => 'control-label col-lg-2 col-md-3 col-sm-3 col-xs-12']) !!}
                  <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                    {!! Form::select('gender', $gender_list, null, ['id' => 'gender', 'class' => 'form-control']) !!}
                    @if ($errors->has('gender'))
                      <span class="help-block">{{ $errors->first('gender') }}</span>
                    @endif
                  </div>
                </div>
                <div class="form-group{{ $errors->has('role_id') ? ' has-error' : '' }}">
                  {!! Form::label('role_id', trans('auth.role'),
                  ['class' => 'control-label col-lg-2 col-md-3 col-sm-3 col-xs-12']) !!}
                  <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                    {!! Form::select('role_id', $roles, null, ['id' => 'role_id',
                    'class' => 'form-control']) !!}
                    @if ($errors->has('role_id'))
                      <span class="help-block">{{ $errors->first('role_id') }}</span>
                    @endif
                  </div>
                </div>
                <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                  <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12 col-lg-offset-2 col-md-offset-3 col-sm-offset-3">
                    {!! Recaptcha::render(['lang' => App::getLocale() ]) !!}
                  </div>
                  @if ($errors->has('g-recaptcha-response'))
                    <span class="help-block">{{ $errors->first('g-recaptcha-response') }}</span>
                  @endif
                </div>
              </div>

              <div class="form-footer">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                  <div class="form-group">
                    <div class="callout callout-info no-margin">
                      <p class="text-muted">
                        {{--To confirm and activate your new account, we will need to send the activation code to your e-mail.--}}
                        Для подтверждения данных и активации аккаунта мы вышлем Вам на e-mail активационный код.
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                  <div class="form-group">
                    <div class="ckbox ckbox-theme">
                      <input id="term-of-service" value="1" type="checkbox">
                      <label for="term-of-service" class="rounded">Я соглашаюсь с <a href="#">Правилами сайта</a></label>
                    </div>
                    <div class="ckbox ckbox-theme">
                      <input id="newsletter" data-value="1" type="checkbox">
                      <label for="newsletter" class="rounded">Присылать мне новости</label>
                    </div>
                  </div>
                </div>
                <div class="pull-right">
                  <button data-type="reset" class="btn btn-danger mr-5">{{ trans('messages.button_clear') }}</button>
                  <button data-type="submit" class="btn btn-success">{{ trans('auth.register') }}</button>
                </div>
                <div class="clearfix"></div>
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
