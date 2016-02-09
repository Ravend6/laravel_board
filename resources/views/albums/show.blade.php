@extends('layouts.main')

@section('title', $album->title)
@section('title_class', 'icon-picture icons')
@section('title_mark', '')

@section('single-styles')
  <link href="/assets/commercial/plugins/cube-portfolio/cubeportfolio/css/cubeportfolio.min.css" rel="stylesheet">
@endsection

@section('breadcrumbs')
  <ol class="breadcrumb">
    <li class="active"><a href="/">{{ trans('navigation.main') }} </a></li> /
    <li class="active"><a href="{{ route('account.index', [App::getLocale()]) }}">{{ trans('navigation.account') }} </a></li> /
    <li class="active"><a href="{{ route('album.index', [App::getLocale()]) }}">{{ trans('albums.page_title') }} </a></li> /
    <li class="active"><a href="{{ route('album.show', [App::getLocale(), $album->id]) }}">{{ trans('default.preview') }} </a></li>
  </ol>
@endsection

@section('content')

  <!-- Start body content -->
  <div class="body-content animated fadeIn">

    <div class="cbp-panel">
      <div id="grid-container" class="cbp">
        @foreach ($album->images as $image)

          <div class="cbp-item">
            <div class="cbp-caption">
              <div class="cbp-caption-defaultWrap">
                {{--Сюдa будут подставлятся thumbs 330px --}}
                <img src="/uploads/users/albums/{{ $album->id }}/{{ $image->name }}" alt="{{ $image->title }}" width="330px">
              </div>
              <div class="cbp-caption-activeWrap">
                <div class="cbp-l-caption-alignCenter">
                  <div class="cbp-l-caption-body">
                    <a href="/uploads/users/albums/{{ $album->id }}/{{ $image->name }}"
                       class="cbp-lightbox cbp-l-caption-buttonRight" data-title=""> {{ trans('default.preview') }}
                    </a>
                    {{-- <a href="#" class="btn btn-danger" style="padding:0">
                      {!! delete_to_route_with_lang(['images.destroy', App::getLocale(), $album->id, $image->id]) !!}
                    </a> --}}
                    <a href="#" data-toggle="modal" data-target="#album-image-modal-edit-{{ $image->id }}"
                      class="btn btn-warning btn-sm">{{ trans('default.edit') }}
                    </a>

                  </div>
                </div>
              </div>
            </div>
            <div class="cbp-l-grid-projects-title">{{ $image->title }}</div>
            <div class="cbp-l-grid-projects-desc">{{ $image->description }}</div>
          </div>
        @endforeach
      </div>
    </div>
  </div><!-- /.body-content -->
  <!--/ End body content -->
  @foreach ($album->images as $image)
    <div class="modal fade" tabindex="-1" role="dialog" id="album-image-modal-edit-{{ $image->id }}">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body">
            <div class="panel panel-default">
              {{-- <div class="panel-heading">aaaaaa</div> --}}
              <div class="panel-body">
                <div class="">

                  <div class="">

                    <div class="well bs-component">
                      {!! Form::model($image, ['method' => 'PATCH', 'route' => [
                        'images.update', App::getLocale(), $album->id, $image->id],
                        'class' => 'form-horizontal form-image-edit']) !!}

                      <div class="form-group">
                        {!! Form::label('title', trans('images.title'),
                          ['class' => 'control-label col-lg-12 col-md-12 col-sm-12 col-xs-12']) !!}
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          {!! Form::text('title', null, ['class' => 'form-control', 'maxlength' => '45']) !!}
                          @if ($errors->has('title'))
                            <span class="help-block">{{ $errors->first('title') }}</span>
                          @endif
                        </div>
                      </div>
                      <div class="form-group">
                        {!! Form::label('description', trans('images.description'),
                          ['class' => 'control-label col-lg-12 col-md-12 col-sm-12 col-xs-12']) !!}
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          {!! Form::textarea('description', null, ['class' => 'form-control',
                            'rows' => '3', 'maxlength' => '250']) !!}
                          @if ($errors->has('description'))
                            <span class="help-block">{{ $errors->first('description') }}</span>
                          @endif
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="pull-right">

                          <button type="submit" class="btn btn-success mr-10">{{ trans('default.refresh') }}</button>
                        </div>
                      </div>
                      {!! Form::close() !!}
                    </div>
                    <div class="radio">
                      <label class="dmain-image-id">
                        <input type="checkbox" name="image_id" class="album-main-image"
                        value="{{ $image->id }}" data-action="/{{ App::getLocale() }}/account/album/image/{{ $album->id }}"
                        @if ($album->image_id == $image->id) checked @endif>
                        {{ trans('images.check_main_image') }}
                      </label>
                    </div>
                    <a href="#" class="btn btn-danger mr-5" style="padding:0">
                      {!! delete_to_route_with_lang(['images.destroy', App::getLocale(), $album->id, $image->id]) !!}
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
  @endforeach

@endsection

@section('single-scripts')
  <script src="/assets/commercial/plugins/cube-portfolio/cubeportfolio/js/jquery.cubeportfolio.min.js"></script>
  <script src="/assets/admin/js/pages/blankon.project.portfolio.js"></script>
@endsection

@section('scripts')
  <script>
    (function() {
      'use strict';

      var token = '{{ Session::getToken() }}';

      // Main image for album
      $('.album-main-image').on('click', function (e) {
        var imageId = $(this).val();
        var url = $(this).data('action');

        $.ajax({
          url: url,
          type: 'post',
          data: {
            _method: 'patch',
            _token: token,
            image_id: imageId,
          },
        }).done(function (data, status, req) {
          // console.log(data);
        }).fail(function (err) {
          // console.log(err);
        });
      });

      // Ajax update image
      $('.form-image-edit').on('submit', function (e) {
        e.preventDefault();

        var $form = $(this);
        var url = $form.attr('action');
        var $title = $form.find('input[name="title"]');
        var $description = $form.find('textarea[name="description"]');

        $.ajax({
          url: url,
          type: 'post',
          data: {
            _method: 'patch',
            _token: token,
            title: $title.val(),
            description: $description.val()
          },
        }).done(function (data, status, req) {
          // console.log(data);
          location.reload();
        }).fail(function (err) {
          // var errors = err.responseJSON;
          // $.each(errors, function (i, v) {
          //   if (i == 'title') {
          //     var $spanHelpBlock = $title.next();
          //     if ($spanHelpBlock.hasClass('help-block')) {
          //       $spanHelpBlock.text(v[0]);
          //     } else {
          //       $title.after($('<span class="help-block">').text(v[0]));
          //       $title.parent().parent().addClass('has-error');
          //     }
          //   }
          //   // if ($title.next().hasClass('help-block')) {
          //   //   $title.parent().parent().removeClass('has-error');
          //   //   $title.next().remove();
          //   // }
          //   if (i == 'description') {
          //     var $spanHelpBlock = $description.next();
          //     if ($spanHelpBlock.hasClass('help-block')) {
          //       $spanHelpBlock.text(v[0]);
          //     } else {
          //       $description.after($('<span class="help-block">').text(v[0]));
          //       $description.parent().parent().addClass('has-error');
          //     }
          //   }
          // })
        });
      });

    }());
  </script>
@endsection
