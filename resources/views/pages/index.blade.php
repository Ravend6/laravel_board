@extends('layouts.main')

@section('title', 'Главная')
@section('title_class', 'icon-home icons')
@section('title_mark', '')

@section('single-styles')

@stop

@section('breadcrumbs')
  <ol class="breadcrumb">
    <li class="active"><a href="/">{{ trans('navigation.main') }} </a></li>
  </ol>
@stop

@section('content')
  <div class="body-content animated fadeIn">

    <div class="row mb-20">
      <div class="text-center">
        <h1>{{ trans('default.how_it_works') }}</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
          <div class="panel rounded shadow">
            <div class="panel-body">
              <div class="ribbon-wrapper">
                <a class="ribbon ribbon-warning">
                  <i class="fa fa-check"></i>
                </a>
              </div><!-- /.ribbon-wrapper -->
              <ul class="inner-all list-unstyled">
                <li class="text-center">
                  <img class="img-circle img-bordered-success"
                       src="" alt="">
                </li>
                <li class="text-center">
                  <h4>{{ trans('default.creating') }}</h4>
                  <p class="text-muted">{{ trans('default.creating_description') }}</p>
                </li>
              </ul><!-- /.list-unstyled -->
            </div><!-- /.panel-body -->
          </div>
      </div>
      <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
        <div class="panel rounded shadow">
          <div class="panel-body">
            <div class="ribbon-wrapper">
              <a class="ribbon ribbon-primary">
                <i class="fa fa-check"></i>
              </a>
            </div><!-- /.ribbon-wrapper -->
            <ul class="inner-all list-unstyled">
              <li class="text-center">
                <img class="img-circle img-bordered-success"
                     src="" alt="">
              </li>
              <li class="text-center">
                <h4>{{ trans('default.compare') }}</h4>
                <p class="text-muted">{{ trans('default.compare_description') }}</p>
              </li>
            </ul><!-- /.list-unstyled -->
          </div><!-- /.panel-body -->
        </div>
      </div>
      <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
        <div class="panel rounded shadow">
          <div class="panel-body">
            <div class="ribbon-wrapper">
              <a class="ribbon ribbon-success">
                <i class="fa fa-check"></i>
              </a>
            </div><!-- /.ribbon-wrapper -->
            <ul class="inner-all list-unstyled">
              <li class="text-center">
                <img class="img-circle img-bordered-success"
                     src="" alt="">
              </li>
              <li class="text-center">
                <h4>{{ trans('default.dealing') }}</h4>
                <p class="text-muted">{{ trans('default.dealing_description') }}</p>
              </li>
            </ul><!-- /.list-unstyled -->
          </div><!-- /.panel-body -->
        </div>
      </div>
    </div>
    <div class="row mb-20">
      <div class="text-center">
        <h1>{{ trans('default.opened_tasks_in') }}</h1>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="panel rounded shadow panel-info">
          <div class="panel-heading">
            <div class="pull-right">
              <button class="btn btn-sm" data-action="refresh" data-container="body" data-toggle="tooltip" data-placement="top" data-title="Refresh" data-original-title="" title=""><i class="fa fa-refresh"></i></button>
              <button class="btn btn-sm" data-action="collapse" data-container="body" data-toggle="tooltip" data-placement="top" data-title="Collapse" data-original-title="" title=""><i class="fa fa-angle-up"></i></button>
            </div>
            <div class="clearfix"></div>
          </div><!-- /.panel-heading -->
          <div class="panel-body no-padding">
            <div id="map-multiple-marker" class="map" style="position: relative; overflow: hidden; transform: translateZ(0px); background-color: rgb(229, 227, 223);">

              <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6632.248000703498!2d151.265683!3d-33.7832959!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6b12abc7edcbeb07%3A0x5017d681632bfc0!2sManly+Vale+NSW+2093%2C+Australia!5e0!3m2!1sen!2sin!4v1433329298259"
                style="border:0;width:100%;height:400px">
              </iframe>
            </div><!-- /.panel-body -->
          </div><!-- /.panel-body -->
        </div>
      </div>
    </div>
  </div>

@stop

@section('single-scripts')
  <script src="/assets/admin/js/pages/blankon.dashboard.js"></script>
@stop
