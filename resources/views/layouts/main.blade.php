<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="keywords" content="">
  <meta name="robots" content="all">
  <title>@yield('title', 'Главная') | TASKHELP.COM</title>
  {{--APPLE-TOUCH-ICONS--}}
  <link href="http://themes.djavaui.com/blankon-fullpack-admin-theme/img/ico/html/apple-touch-icon-144x144-precomposed.png" rel="apple-touch-icon-precomposed" sizes="144x144">
  <link href="http://themes.djavaui.com/blankon-fullpack-admin-theme/img/ico/html/apple-touch-icon-114x114-precomposed.png" rel="apple-touch-icon-precomposed" sizes="114x114">
  <link href="http://themes.djavaui.com/blankon-fullpack-admin-theme/img/ico/html/apple-touch-icon-72x72-precomposed.png" rel="apple-touch-icon-precomposed" sizes="72x72">
  <link href="http://themes.djavaui.com/blankon-fullpack-admin-theme/img/ico/html/apple-touch-icon-57x57-precomposed.png" rel="apple-touch-icon-precomposed">
  <link href="http://themes.djavaui.com/blankon-fullpack-admin-theme/img/ico/html/apple-touch-icon.png" rel="shortcut icon">
  {{--GOOGLE-FONTS--}}
  <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700" rel="stylesheet">
  <link href="http://fonts.googleapis.com/css?family=Oswald:700,400" rel="stylesheet">

  {{--VENDOR-STYLES--}}
  <link href="/assets/global/plugins/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="/assets/global/plugins/bower_components/fontawesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="/assets/global/plugins/bower_components/animate.css/animate.min.css" rel="stylesheet">
  <link href="/assets/global/plugins/bower_components/dropzone/downloads/css/dropzone.css" rel="stylesheet">
  <link href="/assets/global/plugins/bower_components/jquery.gritter/css/jquery.gritter.css" rel="stylesheet">
  <link href="/assets/global/plugins/bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css" rel="stylesheet">
  <link href="/assets/global/plugins/bower_components/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">
  {{--STYLES--}}
  <link href="/assets/admin/css/reset.css" rel="stylesheet">
  <link href="/assets/admin/css/layout.css" rel="stylesheet">
  <link href="/assets/admin/css/components.css" rel="stylesheet">
  <link href="/assets/admin/css/plugins.css" rel="stylesheet">
  <link href="/assets/admin/css/themes/default.theme.css" rel="stylesheet" id="theme">
  @yield('single-styles')
  <link href="/assets/admin/css/custom.css" rel="stylesheet">
</head>

<body class="page-session page-sound page-header-fixed page-sidebar-fixed page-footer-fixed">

  <section id="wrapper">
    @include('includes.header')
    @include('session.login_modal')
    @include('includes.sidebar-left')

    <section id="page-content">
      @include('includes.breadcrumbs')

      @yield('content')

      @include('includes.footer')
    </section>

    {{--@include('includes.sidebar-right')--}}
  </section>

  {{--Удалить за ненадобностью--}}
  <div id="back-top" class="animated pulse circle">
    <i class="fa fa-angle-up"></i>
  </div>

  @include('includes.notify')
  @include('includes.post-footer')
  @yield('single-scripts')
  @yield('scripts')

</body>
</html>
