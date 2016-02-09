<aside id="sidebar-left" class="sidebar-circle">

  @unless (Auth::check())

    @else
      <div class="sidebar-content">
        <div class="media">
          <a class="pull-left has-notif avatar" href="{{ route('account.index', [App::getLocale()]) }}">
            @if (Auth::user()->avatar)
              <img src="/uploads/users/avatars/{{ Auth::user()->id }}/{{ Auth::user()->avatar }}"
                   alt="{{ Auth::user()->name }} avatar">
            @else
              <img src="/img/noimage/avatar/50_50/noavatar_m.png"
                   alt="{{ Auth::user()->name }} avatar">
            @endif
            <i class="online"></i> {{--offline away busy--}}
          </a>
          @if (is_executor_role(Auth::user()))
            <div class="media-body">
              <h4 class="media-heading">{{ trans('default.hello') }}, <span>{{ Auth::user()->name }}</span></h4>
              @if (Auth::user()->executant)
                <small>{{ Auth::user()->executant->category->title }}</small>
              @endif
            </div>
          @endif
        </div>
      </div>

  @endunless

  <!-- Start left navigation - menu -->
  <ul class="sidebar-menu">
    <li class="submenu active">
      <a href="/">
        <span class="icon"><i class="fa fa-home"></i></span>
        <span class="text">{{ trans('navigation.main') }}</span>
      </a>
    </li>

    <li class="submenu">
      <a href="/{{ App::getLocale() }}/board">
        <span class="icon"><i class="fa fa-tasks"></i></span>
        <span class="text">{{ trans('navigation.board') }}</span>
      </a>
    </li>

    <li class="submenu">
      <a href="/executants">
        <span class="icon"><i class="fa fa-users"></i></span>
        <span class="text">{{ trans('navigation.executants') }}</span>
      </a>
    </li>

    <li class="submenu">
      <a href="/gallery">
        <span class="icon"><i class="fa fa-picture-o"></i></span>
        <span class="text">{{ trans('navigation.gallery') }}</span>
      </a>
    </li>

    <li class="submenu">
      <a href="javascript:void(0);">
        <span class="icon"><i class="fa fa-leaf"></i></span>
        <span class="text">{{ trans('navigation.info_block') }}</span>
        <span class="arrow"></span>
      </a>
      <ul>
        <li><a href="#">{{ trans('navigation.rules') }}</a></li>
        <li><a href="#">{{ trans('navigation.instructions') }}</a></li>
        <li><a href="#">{{ trans('navigation.faq') }}</a></li>
        <li><a href="#">{{ trans('navigation.about') }}</a></li>
        <li><a href="#">{{ trans('navigation.partnership') }}</a></li>
      </ul>
    </li>
    @unless (Auth::check())
      @else
        <li class="sidebar-category">
          <span>{{ trans('navigation.account') }}</span>
          <span class="pull-right"><i class="fa fa-trophy"></i></span>
        </li>

        <li class="submenu">
          <a href="javascript:void(0);">
            <span class="icon"><i class="fa fa-user"></i></span>
            <span class="text">{{ trans('navigation.profile') }}</span>
            <span class="arrow"></span>
          </a>
          <ul>
            @can('createAccount', Auth::user())
              <li class="submenu"><a href="{{ route('account.create', [App::getLocale()]) }}">{{ trans('default.create') }}</a></li>
            @endcan
            @can('editAccount', Auth::user())
              <li class="submenu"><a href="{{ route('account.edit', [App::getLocale()]) }}">{{ trans('default.edit') }}</a></li>
            @endcan
            @can('indexAccount', Auth::user())
              <li class="submenu"><a href="{{ route('account.index', [App::getLocale()]) }}">{{ trans('default.preview') }}</a></li>
            @endcan
          </ul>
        </li>

        <li class="submenu">
          <a href="javascript:void(0);">
            <span class="icon"><i class="fa fa-tasks"></i></span>
            <span class="text">{{ trans('navigation.my_tasks') }}</span>
            <span class="arrow"></span>
          </a>
          <ul>
            <li><a href="{{ route('task.create', [App::getLocale()]) }}">Создать</a></li>
            <li class="submenu">
              <a href="javascript:void(0);">{{ trans('navigation.tasks') }} <span class="arrow"></span></a>
              <ul>
                <li><a href="/{{ App::getLocale() }}/message/deal">{{ trans('navigation.accepted') }}</a></li>
                <li><a href="/{{ App::getLocale() }}/message/task" target="_blank">{{ trans('navigation.assigned') }}</a></li>
              </ul>
            </li>
          </ul>
        </li>

        <li class="submenu">
          <a href="javascript:void(0);">
            <span class="icon"><i class="fa fa-picture-o"></i></span>
            <span class="text">{{ trans('navigation.my_albums') }}</span>
            <span class="arrow"></span>
          </a>
          <ul>
            @unless (Auth::user()->albums->count() >= 3)
              <li><a href="{{ route('album.create', [App::getLocale()]) }}">{{ trans('default.create') }} </a></li>
            @endunless
            <li><a href="{{ route('album.index', [App::getLocale()]) }}">{{ trans('default.preview') }}</a></li>
          </ul>
        </li>

        <li class="submenu">
          <a href="javascript:void(0);">
            <span class="icon"><i class="fa fa-envelope"></i></span>
            <span class="text">{{ trans('navigation.messages') }}</span>
            <span class="arrow"></span>
          </a>
          <ul>
            <li><a href="#">{{ trans('default.create') }}</a></li>
            <li><a href="#">{{ trans('default.inbox') }} <span class="label label-danger pull-right">7</span> </a></li>
            <li><a href="#">{{ trans('default.outbox') }}</a></li>
          </ul>
        </li>

        <li class="submenu">
          <a href="javascript:void(0);">
            <span class="icon"><i class="fa fa-usd"></i></span>
            <span class="text">{{ trans('navigation.count') }}</span>
            <span class="arrow"></span>
          </a>
          <ul>
            <li><a href="#">{{ trans('default.preview') }}</a></li>
            <li><a href="#">{{ trans('default.add_funds') }}</a></li>
            <li><a href="#">{{ trans('default.history') }}</a></li>
            <li><a href="#">{{ trans('default.withdrawal') }}</a></li>
          </ul>
        </li>

        <li class="submenu">
          <a href="#">
            <span class="icon"><i class="fa fa-calendar"></i></span>
            <span class="text">{{ trans('navigation.calendar') }}</span>
          </a>
        </li>

        <li class="submenu">
          <a href="#">
            <span class="icon"><i class="fa fa-cogs"></i></span>
            <span class="text">{{ trans('default.settings') }}</span>
          </a>
        </li>

        <li class="submenu">
          <a href="#">
            <span class="icon"><i class="fa fa-area-chart"></i></span>
            <span class="text">{{ trans('navigation.statistic') }}</span>
          </a>
        </li>
        @endunless
  </ul>
</aside>
