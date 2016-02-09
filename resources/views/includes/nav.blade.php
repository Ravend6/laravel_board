<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ route('index') }}">{{ trans('navigation.main') }}</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <!-- <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li> -->
        {{-- <li><a href="{{ action('ArticlesController@index') }}">Articles</a></li> --}}
        {{-- <li><a href="{{ route('admin.index') }}">Админ Панель</a></li> --}}
        <li><a href="{{ route('tasks.create', [App::getLocale()]) }}">{{ trans('default.create') }}</a></li>
       <!--  <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li> -->
      </ul>
      <!-- <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form> -->


      <ul class="nav navbar-nav navbar-right">
        @unless (Auth::check())
        {{-- <li><a href="{{ action('Auth\AuthController@getLogin') }}">{{ trans('auth.sign_in') }}</a></li> --}}
        {{--           <li><a href="{{ action('SessionController@getLogin', [App::getLocale()]) }}">{{ trans('auth.login') }}</a></li> --}}
        <li><a data-toggle="modal" data-target="#login" href="#">{{ trans('auth.login') }}</a></li>

        {{-- <li><a href="{{ action('Auth\AuthController@getRegister') }}">Регистрация</a></li> --}}
        <li><a href="{{ action('SessionController@getRegister', [App::getLocale()]) }}">{{ trans('auth.register') }}</a></li>
        @else
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            {{-- <li><a href="{{ route('albums.index', [App::getLocale()]) }}">Альбомы</a></li> --}}
            @if (!Auth::user()->executant)
              <li><a href="{{ route('profile.create', [App::getLocale()]) }}">{{ trans('navigation.create_profile') }}</a></li>
            @else
              <li><a href="{{ route('profile.index', [App::getLocale()]) }}">{{ trans('navigation.profile') }}</a></li>
            @endif
            <li class="divider"></li>
            <li><a href="{{ action('SessionController@getLogout', [App::getLocale()]) }}">{{ trans('auth.logout') }}</a></li>
          </ul>
        </li>
        @endunless
      </ul>
    </div>
  </div>
</nav>
<div class="modal fade" tabindex="-1" role="dialog" id="login">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="panel panel-default">
          <div class="panel-heading">{{ trans('auth.sign_in') }}</div>
          <div class="panel-body">
            {{-- @include('errors.validation') --}}
            <form id="form-login" class="form-horizontal" role="form" method="POST" action="/{{ App::getLocale() }}/auth/login">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="form-group">
                <label class="col-md-4 control-label" for="email">E-Mail</label>
                <div class="col-md-6">
                  <input type="email" class="form-control" name="email" value="{{ old('email') }}" id="email">
                </div>
              </div>
              <div class="form-group">
                <label class="col-md-4 control-label" for="password">{{ trans('default.password') }}</label>
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
                <button id="submit-login" type="submit" class="btn btn-primary" style="margin-right: 15px;" data-csrf="{{ csrf_token() }}" data-locale="{{ App::getLocale() }}">
                  {{ trans('auth.sign_in') }}
                </button>

                  <a href="/{{ App::getLocale() }}/password/email">{{ trans('auth.forgot_password') }}</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script src="/bower/jquery/dist/jquery.min.js"></script>
<script>
  (function () {
    'use strict';

    $('#form-login').on('submit', function (e) {
      e.preventDefault();

      var ctx = $(this);
      var button = $(this).find('button')
      var token = button.data('csrf');
      var locale = button.data('locale');

      var emailInput = $(this).find('input[name="email"]');
      var passwordInput = $(this).find('input[name="password"]');
      var rememberInput = $(this).find('input[name="remember"]');
      var email = emailInput.val();
      var password = passwordInput.val();

      $.ajax({
        url: '/' + locale + '/auth/login',
        method: 'post',
        data: {
          email: email,
          password: password,
          remember: rememberInput.prop('checked') ? true : null,
          _token: token
        },
      }).done(function (data, status, req) {
        window.location.href = data.url;
      }).fail(function (err) {
        if (err.status == 422) {
          $.each(err.responseJSON, function (key, value) {
            var spanError = $('<span>', {text: value[0], class: 'help-block'});
            var input = ctx.find('input[name="' + key + '"]');

            if (!input.parent().parent().hasClass('has-error')) {
              input.parent().parent().addClass('has-error');
              spanError.insertAfter(input);
            } else {
              input.next().remove();
              spanError.insertAfter(input);
              $.each(ctx.find('.has-error input'), function (k, v) {
                var self = $(this);
                if (self.attr('name') != key) {
                  self.parent().parent().removeClass('has-error');
                  self.next().remove();
                }
              });
            }
          });
        }
      });
    });
  }());
</script>
