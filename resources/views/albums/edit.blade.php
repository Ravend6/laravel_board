@extends('layouts.main')

@section('title', trans('albums.button_edit'))
@section('title_class', 'fa fa-pencil-square-o')
@section('title_mark', '')

@section('single-styles')
  <link href="/assets/commercial/plugins/cube-portfolio/cubeportfolio/css/cubeportfolio.min.css" rel="stylesheet">
@endsection

@section('breadcrumbs')
  <ol class="breadcrumb">
    <li class="active"><a href="/">Главная </a></li> /
    <li class="active"><a href="{{ route('account.index', [App::getLocale()]) }}">Кабинет</a></li> /
    <li class="active"><a href="{{ route('album.index', [App::getLocale()]) }}">{{ trans('albums.page_title') }} </a></li> /
    <li class="active"><a href="{{ route('album.edit', [App::getLocale(), $album->id]) }}">Редактирование </a></li>
  </ol>
@endsection

@section('content')

  <div class="body-content animated fadeIn">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <div class="well bs-component">
          <div class="panel rounded shadow">
            @include('includes._panel-heading')
            @include('errors.validation')

            <div class="panel-body no-padding border-bottom">

              {!! Form::model($album,
                ['method' => 'PATCH', 'action' => ['AlbumsController@update', App::getLocale(), $album->id], 'class' => 'form-horizontal']) !!}

              @include('albums._form', ['submitButton' => trans('albums.button_edit')])

              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>

      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        {{-- Форма загрузки картинок --}}
        <div class="well bs-component">
          <div class="dropzone" id="my-dropzone">
          </div>
        </div>
        <div class="well bs-component">
          <div class="text-center">
            <a href="{{ route('album.show', [App::getLocale(), $album->id]) }}" class="btn btn-info">{{ trans('images.show_images') }}</a>
          </div>
        </div>
          {{-- {!! Form::open(['method' => 'POST', 'route' => [
            'images.store', App::getLocale(), $album->id],
            'files' => true,
            'class' => 'form-horizontal']) !!}
          <fieldset>
            <legend>{{ trans('images.page_title') }}</legend>
            <div class="form-group">
              {!! Form::label('images', trans('images.images'),
              ['class' => 'control-label col-lg-2 col-md-3 col-sm-3 col-xs-12']) !!}
              <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                {!! Form::file('images[]', ['multiple' => true, 'class' => 'form-control']) !!}
                @if ($errors->has('image'))
                  <span class="help-block">{{ $errors->first('image') }}</span>
                @endif
              </div>
            </div>

            <div class="form-group">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12 col-lg-offset-2 col-md-offset-3 col-sm-offset-3">
                  <button type="reset" class="btn btn-warning">{{ trans('messages.button_clear') }}</button>
                  <button type="submit" class="btn btn-primary">{{ trans('images.page_title') }}</button>
                </div>
              </div>
            </div>
          </fieldset>
          {!! Form::close() !!} --}}
        {{-- </div>
      </div> --}}

    </div>
  </div>
@endsection

@section('single-scripts')
  <script src="/assets/commercial/plugins/cube-portfolio/cubeportfolio/js/jquery.cubeportfolio.min.js"></script>
  <script src="/assets/admin/js/pages/blankon.blog.type2.js"></script>
@endsection

@section('scripts')
  <script>
    (function() {
      'use strict';

      var token = '{{ Session::getToken() }}';

      // // Main image for album
      // $('.album-main-image').on('click', function (e) {
      //   var imageId = $(this).val();
      //   var url = $(this).data('action');
      //
      //   $.ajax({
      //     url: url,
      //     type: 'post',
      //     data: {
      //       _method: 'patch',
      //       _token: token,
      //       image_id: imageId,
      //     },
      //   }).done(function (data, status, req) {
      //     // console.log(data);
      //   }).fail(function (err) {
      //     // console.log(err);
      //   });
      // });
      //
      // // Ajax update image
      // $('.form-image-edit').on('submit', function (e) {
      //   e.preventDefault();
      //
      //   var $form = $(this);
      //   var url = $form.attr('action');
      //   var $title = $form.find('input[name="title"]');
      //   var $description = $form.find('textarea[name="description"]');
      //
      //   $.ajax({
      //     url: url,
      //     type: 'post',
      //     data: {
      //       _method: 'patch',
      //       _token: token,
      //       title: $title.val(),
      //       description: $description.val()
      //     },
      //   }).done(function (data, status, req) {
      //     console.log(data);
      //   }).fail(function (err) {
      //     // var errors = err.responseJSON;
      //     // $.each(errors, function (i, v) {
      //     //   if (i == 'title') {
      //     //     var $spanHelpBlock = $title.next();
      //     //     if ($spanHelpBlock.hasClass('help-block')) {
      //     //       $spanHelpBlock.text(v[0]);
      //     //     } else {
      //     //       $title.after($('<span class="help-block">').text(v[0]));
      //     //       $title.parent().parent().addClass('has-error');
      //     //     }
      //     //   }
      //     //   // if ($title.next().hasClass('help-block')) {
      //     //   //   $title.parent().parent().removeClass('has-error');
      //     //   //   $title.next().remove();
      //     //   // }
      //     //   if (i == 'description') {
      //     //     var $spanHelpBlock = $description.next();
      //     //     if ($spanHelpBlock.hasClass('help-block')) {
      //     //       $spanHelpBlock.text(v[0]);
      //     //     } else {
      //     //       $description.after($('<span class="help-block">').text(v[0]));
      //     //       $description.parent().parent().addClass('has-error');
      //     //     }
      //     //   }
      //     // })
      //   });
      // });

      // Upload images dropzone

      var baseUrl = "/{{ App::getLocale().'/images/'.$album->id }}";

      // function deleteAvatar() {
      //   $.ajax({
      //     url: baseUrl,
      //     type: 'post',
      //     data: {
      //       _method: 'delete',
      //       _token: token
      //     },
      //   }).done(function (data, status, req) {
      //     // console.log(data);
      //   }).fail(function (err) {
      //     // console.log(err);
      //   });
      // }

      Dropzone.autoDiscover = false;
      var myDropzone = new Dropzone("#my-dropzone", {
        url: baseUrl,
        paramName: 'image',
        maxFilesize: 20, // MB
        maxFiles: 10,
        // addRemoveLinks: true,
        params: {
          _token: token,

        }
      });

      myDropzone.on("success", function(file, result) {
        console.log(result);
        // $('.show-avatar').remove();
      });

      // myDropzone.on('removedfile', function (file) {
      //   $('.avatar-error').remove();
      //   if (file.status == 'success') {
      //     deleteAvatar();
      //   }
      // });

      myDropzone.on("error", function(file, errorMessage, xhr) {
        if (xhr) {
          if (errorMessage.type == 'validation') {
            setNotify('danger', errorMessage.message);
          }
          if (errorMessage.type == 'count') {
            setNotify('danger', errorMessage.message);
          }
          // $('#my-dropzone').append(
          //   $('<div class="avatar-error" style="margin-top: 10px; color: #E9573F">')
          //     .text(errorMessage)
          // );
        }
      });

    }());
  </script>
@endsection
