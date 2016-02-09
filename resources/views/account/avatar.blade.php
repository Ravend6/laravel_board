@extends('layouts.main')

@section('title', trans('account.create_avatar'))
@section('title_class', 'fa fa-plus')
@section('title_mark', '')

@section('single-styles')

@endsection

@section('breadcrumbs')
  <ol class="breadcrumb">
    <li class="active"><a href="/">{{ trans('navigation.main') }}</a></li> /
    <li class="active"><a href="{{ route('account.avatar.create', [App::getLocale()]) }}">{{ trans('account.create_avatar') }} </a></li>
  </ol>
@endsection

@section('content')
  <div class="row">
      <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
        <div class="well bs-component">

          <div class="dropzone" id="my-dropzone">
          </div>
          {{-- <form id="my-dropzone" action="/file-upload" class="dropzone mb-20 rounded">
            <div class="fallback">
              <input name="file" type="file" multiple />
            </div>
          </form> --}}


          {{-- {!! Form::open([
            'url' => App::getLocale().'/account/avatar',
            'class' => 'form-horizontal dropzone mb-20 rounded',
            'id' => 'my-dropzone',
            'files' => true
          ]) !!}
            <fieldset>
              <legend>{{ trans('account.create_avatar') }}</legend>

              <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                {!! Form::label('avatar', 'Аватар:', ['class' => 'control-label']) !!}
                <div class="fallback">
                  {!! Form::file('avatar', null, ['class' => 'form-control']) !!}
                </div>
                @if ($errors->has('avatar'))
                  <span class="help-block">{{ $errors->first('avatar') }}</span>
                @endif
              </div>



              <div class="form-group">
                {!! Form::submit(trans('account.create_avatar'), ['class' => 'btn btn-primary btn-sm']) !!}
              </div>

            </fieldset>
          {!! Form::close() !!} --}}

          @if (Auth::user()->avatar)
            <div class="show-avatar">
              <img src="/uploads/users/avatars/{{ Auth::user()->id }}/{{ Auth::user()->avatar }}"
                alt="{{ Auth::user()->name }} avatar" class="thumbnail" width="200">
              <p></p>
              {!! delete_to_route_with_lang(['account.avatar.destroy', App::getLocale()]) !!}
            </div>
          @endif
        </div>
      </div>
    </div>

@stop

@section('single-scripts')
  <script>
    (function() {
      'use strict';

      var baseUrl = "/{{ App::getLocale().'/account/avatar' }}";
      var token = "{{ Session::getToken() }}";

      function deleteAvatar() {
        $.ajax({
          url: baseUrl,
          type: 'post',
          data: {
            _method: 'delete',
            _token: token
          },
        }).done(function (data, status, req) {
          // console.log(data);
        }).fail(function (err) {
          // console.log(err);
        });
      }

      Dropzone.autoDiscover = false;
      var myDropzone = new Dropzone("#my-dropzone", {
        url: baseUrl,
        paramName: "avatar",
        maxFilesize: 20, // MB
        maxFiles: 1,
        // addRemoveLinks: true,
        params: {
          _token: token
        }
      });

      myDropzone.on("success", function(file, result) {
        console.log('success11',result);
        $('.show-avatar').remove();
      });

      myDropzone.on('removedfile', function (file) {
        $('.avatar-error').remove();
        if (file.status == 'success') {
          deleteAvatar();
        }
      });

      myDropzone.on("error", function(file, errorMessage, xhr) {
        if (xhr) {
          $('#my-dropzone').append(
            $('<div class="avatar-error" style="margin-top: 10px; color: #E9573F">')
              .text(errorMessage)
          );
        }
      });
    }());
  </script>
=======
@endsection

