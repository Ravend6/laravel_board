<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="robots" content="all">
  <title>@yield('title', 'Главная') | Админ Панель</title>
  <link rel="stylesheet" href="/bower/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/bower/animate.css/animate.min.css">
  <link rel="stylesheet" href="/bower/components-font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="/bower/bootstrap-multiselect/dist/css/bootstrap-multiselect.css">
  <link rel="stylesheet" href="/bower/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="/bower/simplemde/dist/simplemde.min.css">
  {{-- <link rel="stylesheet" href="/styles/bootstrap.min.css"> --}}

  <link rel="stylesheet" href="/styles/app.css">
</head>
<body>
  @include('includes.admin-nav')
  <div class="container">
    @yield('content')
  </div>
  @include('includes.notify')

  <script src="/bower/jquery/dist/jquery.min.js"></script>
  <script src="/bower/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="/bower/bootstrap-multiselect/dist/js/bootstrap-multiselect.js"></script>
  <script src="/bower/remarkable-bootstrap-notify/dist/bootstrap-notify.min.js"></script>
  <script src="/bower/select2/dist/js/select2.full.min.js"></script>
  <script src="/bower/simplemde/dist/simplemde.min.js"></script>

  <script src="/scripts/lib/notify.js"></script>
  <script src="/scripts/lib/nav.js"></script>
  @yield('scripts')
  <script src="/scripts/lib/validation.js"></script>
</body>
</html>