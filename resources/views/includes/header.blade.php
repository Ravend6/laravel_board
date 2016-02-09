<header id="header">

  <!-- Start header left -->
  <div class="header-left">
    <!-- Start offcanvas left: This menu will take position at the top of template header (mobile only). Make sure that only #header have the `position: relative`, or it may cause unwanted behavior -->
    <div class="navbar-minimize-mobile left">
      <i class="fa fa-bars"></i>
    </div>
    <!--/ End offcanvas left -->

    <!-- Start navbar header -->
    <div class="navbar-header">

      <!-- Start brand -->
      <a class="navbar-brand" href="/">
        <img class="logo" src="http://img.djavaui.com/?create=175x50,81B71A?f=ffffff" alt="brand logo">
      </a><!-- /.navbar-brand -->
      <!--/ End brand -->

    </div><!-- /.navbar-header -->
    <!--/ End navbar header -->

    <!-- Start offcanvas right: This menu will take position at the top of template header (mobile only). Make sure that only #header have the `position: relative`, or it may cause unwanted behavior -->
    <div class="navbar-minimize-mobile right">
      <i class="fa fa-cog"></i>
    </div>
    <!--/ End offcanvas right -->

    <div class="clearfix"></div>
  </div><!-- /.header-left -->
  <!--/ End header left -->

  <!-- Start header right -->
  <div class="header-right">
    <!-- Start navbar toolbar -->
    <div class="navbar navbar-toolbar">

      <!-- Start left navigation -->
      <ul class="nav navbar-nav navbar-left">

        <!-- Start sidebar shrink -->
        <li class="navbar-minimize">
          <a href="javascript:void(0);" title="Minimize sidebar">
            <i class="fa fa-bars"></i>
          </a>
        </li>
        <!--/ End sidebar shrink -->

        <!-- Start form search -->
        <li class="navbar-search">
          <!-- Just view on mobile screen-->
          <a href="#" class="trigger-search"><i class="fa fa-search"></i></a>
          <form class="navbar-form">
            <div class="form-group has-feedback">
              <input type="text" class="form-control typeahead rounded" placeholder="Search for people, places and things">
              <button type="submit" class="btn btn-theme fa fa-search form-control-feedback rounded"></button>
            </div>
          </form>
        </li>
        <!--/ End form search -->

      </ul><!-- /.nav navbar-nav navbar-left -->
      <!--/ End left navigation -->

      <!-- Start right navigation -->
      <ul class="nav navbar-nav navbar-right"><!-- /.nav navbar-nav navbar-right -->

        <li class="dropdown navbar-message">
          <a href="{{ route('task.create', [App::getLocale()]) }}">
            <i class="icon-note icons"> {{-- trans('default.add_task') --}}</i>
          </a>
        </li>

        <li class="dropdown navbar-message">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-language"></i></a>
          <div class="dropdown-menu animated flipInX" style="width:240px;min-height:60px;">
            <div class="dropdown-header">
              <span class="title">Выбор языка</span>
            </div>
            <div class="dropdown-body" style="height:66px;">
              <div class="media-list niceScroll">
                <a href="/ru/{{ mb_substr(Request::path(), 3) }}" class="media pull-left ">
                  <div class=""><img src="/img/style/lang/ru.png" class="media-object img-circle" alt="..."/></div>
                </a>
                <a href="/pl/{{ mb_substr(Request::path(), 3) }}" class="media pull-left ">
                  <div class=""><img src="/img/style/lang/pl.png" class="media-object img-circle" alt="..."/></div>
                </a>
                <a href="/en/{{ mb_substr(Request::path(), 3) }}" class="media pull-left ">
                  <div class=""><img src="/img/style/lang/en.png" class="media-object img-circle" alt="..."/></div>
                </a>
              </div>
            </div>
          </div>
        </li><!-- /.dropdown navbar-message -->

        <!-- Start profile -->
        @unless (Auth::check())

          <li class="dropdown navbar-notification">
            <a href="{{ action('SessionController@getRegister', [App::getLocale()]) }}">
              <i class="icon-user-follow icons"></i>
            </a>
          </li>

          <li class="dropdown navbar-notification">
            <a data-toggle="modal" data-target="#login" href="#">
              <i class="icon-login icons"></i>
            </a>
          </li>

          @else

            {{--<li class="dropdown navbar-notification">

              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell-o"></i><span class="count label label-danger rounded">6</span></a>

              <!-- Start dropdown menu -->
              <div class="dropdown-menu animated flipInX">
                <div class="dropdown-header">
                  <span class="title">Notifications <strong>(10)</strong></span>
                  <span class="option text-right"><a href="#"><i class="fa fa-cog"></i> Setting</a></span>
                </div>
                <div class="dropdown-body niceScroll">

                  <!-- Start notification list -->
                  <div class="media-list small">

                    <a href="#" class="media">
                      <div class="media-object pull-left"><i class="fa fa-share-alt fg-info"></i></div>
                      <div class="media-body">
                        <span class="media-text"><strong>Dolanan Remi : </strong><strong>Chris Job,</strong><strong>Denny Puk</strong> and <strong>Joko Fernandes</strong> sent you <strong>5 free energy boosts and other request</strong></span>
                        <!-- Start meta icon -->
                        <span class="media-meta">3 minutes</span>
                        <!--/ End meta icon -->
                      </div><!-- /.media-body -->
                    </a><!-- /.media -->

                    <a href="#" class="media">
                      <div class="media-object pull-left"><i class="fa fa-cogs fg-success"></i></div>
                      <div class="media-body">
                        <span class="media-text">Your sistem is updated</span>
                        <!-- Start meta icon -->
                        <span class="media-meta">5 minutes</span>
                        <!--/ End meta icon -->
                      </div><!-- /.media-body -->
                    </a><!-- /.media -->

                    <a href="#" class="media">
                      <div class="media-object pull-left"><i class="fa fa-ban fg-danger"></i></div>
                      <div class="media-body">
                        <span class="media-text">3 Member is BANNED</span>
                        <!-- Start meta icon -->
                        <span class="media-meta">5 minutes</span>
                        <!--/ End meta icon -->
                      </div><!-- /.media-body -->
                    </a><!-- /.media -->

                    <a href="#" class="media">
                      <div class="media-object pull-left"><img class="img-circle" src="http://img.djavaui.com/?create=30x30,4888E1?f=ffffff" alt="..."/></div>
                      <div class="media-body">
                        <span class="media-text">daddy pushed to project Blankon version 1.0.0</span>
                        <!-- Start meta icon -->
                        <span class="media-meta">45 minutes</span>
                        <!--/ End meta icon -->
                      </div><!-- /.media-body -->
                    </a><!-- /.media -->

                    <a href="#" class="media">
                      <div class="media-object pull-left"><i class="fa fa-user fg-info"></i></div>
                      <div class="media-body">
                        <span class="media-text">Change your user profile</span>
                        <!-- Start meta icon -->
                        <span class="media-meta">1 days</span>
                        <!--/ End meta icon -->
                      </div><!-- /.media-body -->
                    </a><!-- /.media -->

                    <a href="#" class="media">
                      <div class="media-object pull-left"><i class="fa fa-book fg-info"></i></div>
                      <div class="media-body">
                        <span class="media-text">Added new article</span>
                        <!-- Start meta icon -->
                        <span class="media-meta">1 days</span>
                        <!--/ End meta icon -->
                      </div><!-- /.media-body -->
                    </a><!-- /.media -->

                    <!-- Start notification indicator -->
                    <a href="#" class="media indicator inline">
                      <span class="spinner">Load more notifications...</span>
                    </a>
                    <!--/ End notification indicator -->

                  </div>
                  <!--/ End notification list -->

                </div>
                <div class="dropdown-footer">
                  <a href="#">See All</a>
                </div>
              </div>
              <!--/ End dropdown menu -->
            </li><!-- /.dropdown navbar-notification -->--}}

            <li class="dropdown navbar-profile">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="meta">
                  <span class="avatar">

                    @if (Auth::user()->avatar)
                      <img src="/uploads/users/avatars/{{ Auth::user()->id }}/{{ Auth::user()->avatar }}"
                           alt="{{ Auth::user()->name }} avatar" class="img-circle">
                    @else
                      <img src="/img/noimage/avatar/50_50/noavatar_m.png"
                           alt="{{ Auth::user()->name }} avatar" class="img-circle" >
                    @endif

                  </span>
                  <span class="text hidden-xs hidden-sm text-muted">{{ Auth::user()->name }} </span>
                  <span class="caret"></span>
                </span>
              </a>
              <ul class="dropdown-menu animated flipInX">
                <li class="dropdown-header">{{ trans('navigation.profile') }}</li>
                <li>
                  <a href="{{ route('account.avatar.create', [App::getLocale()]) }}"><i class="fa fa-plus"></i> {{ trans('default.avatar') }} </a>
                </li>
                {{--Если еще не создан--}}
                @can('createAccount', Auth::user())
                  <li>
                    <a href="{{ route('account.create', [App::getLocale()]) }}"><i class="fa fa-plus"></i> {{ trans('default.create') }}</a>
                  </li>
                @endcan
                @can('editAccount', Auth::user())
                  <li>
                    <a href="{{ route('account.edit', [App::getLocale()]) }}"><i class="fa fa-pencil-square-o"></i> {{ trans('default.edit') }} </a>
                  </li>
                @endcan
                {{--Если уже создан--}}
                @can('indexAccount', Auth::user())
                  <li>
                    <a href="{{ route('account.index', [App::getLocale()]) }}"><i class="icon-user icons"></i> {{ trans('default.preview') }}</a>
                  </li>
                @endcan
                {{--Конец условия--}}
                <li class="divider"></li>
                <li><a href="{{ action('SessionController@getLogout', [App::getLocale()]) }}"><i class="fa fa-sign-out"></i>{{ trans('auth.sign_out') }}</a></li>
              </ul>
            </li>
            @endunless
              <!-- Start settings -->
            {{--<li class="navbar-setting pull-right">
                <a href="javascript:void(0);"><i class="fa fa-cog fa-spin"></i></a>
            </li>--}}
              <!--/ End settings -->
      </ul>
    </div>
  </div>
</header> <!-- /#header -->
