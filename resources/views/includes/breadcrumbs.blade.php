<div class="header-content">
  <h2><i class="@yield('title_class')"></i>@yield('title') <span>@yield('title_mark')</span></h2>
  <div class="breadcrumb-wrapper hidden-xs">
    <span class="label">{{ trans('navigation.you_here') }}:</span>
    @yield('breadcrumbs')
  </div>
</div>