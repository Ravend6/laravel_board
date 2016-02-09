<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="{{ route('index') }}">Task Help</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <!-- <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li> -->
        {{-- <li><a href="{{ action('Admin\CategoriesController@index') }}">Категории</a></li> --}}
        <li><a href="{{ route('admin.index') }}">Админ Панель</a></li>
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
{{--           <li><a href="{{ action('SessionController@getLogin', [App::getLocale()]) }}">{{ trans('auth.login') }}</a></li> --}}
          <li><a href="{{ action('SessionController@getRegister', [App::getLocale()]) }}">{{ trans('auth.register') }}</a></li>
        @else
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Профайл</a></li>
              <li class="divider"></li>
              <li><a href="{{ action('SessionController@getLogout', [App::getLocale()]) }}">{{ trans('auth.logout') }}</a></li>
            </ul>
          </li>
        @endunless
      </ul>
    </div>
  </div>
</nav>