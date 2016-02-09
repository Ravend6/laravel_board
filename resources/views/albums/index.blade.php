@extends('layouts.main')

@section('title',  trans('albums.page_title'))
@section('title_class', 'icon-picture icons')
@section('title_mark', '')

@section('single-styles')
  <link href="/assets/commercial/plugins/cube-portfolio/cubeportfolio/css/cubeportfolio.min.css" rel="stylesheet">
@endsection

@section('breadcrumbs')
  <ol class="breadcrumb">
    <li class="active"><a href="/">{{ trans('navigation.main') }} </a></li> /
    <li class="active"><a href="{{ route('account.index', [App::getLocale()]) }}">{{ trans('navigation.account') }}</a></li> /
    <li class="active"><a href="#">{{ trans('albums.page_title') }} </a></li>
  </ol>
@endsection

@section('content')
  <div class="body-content animated fadeIn">
    <div class="cbp-panel">
      <div id="grid-container" class="cbp">
        @foreach (Auth::user()->albums as $album)
          <div class="cbp-item art">
          <a href="{{ route('album.show', [App::getLocale(), $album->id]) }}" target="_blank" class="cbp-caption">
            <div class="cbp-caption-defaultWrap">
              @if ($album->image_id)
                <img src="/uploads/users/albums/{{ $album->id }}/{{ $album->image->name }}" alt="{{ $album->title }}"
                width="340" height="210"/>
              @else
                <img src="http://img.djavaui.com/?create=340x210,37BC9B?f=ffffff" alt="">
              @endif
            </div>
            <div class="cbp-caption-activeWrap">
              <div class="cbp-l-caption-alignCenter">
                <div class="cbp-l-caption-body">
                  <div class="cbp-l-caption-text">{{ trans('default.preview_all') }}</div>
                </div>
              </div>
            </div>
          </a>
          <a href="{{ route('album.show', [App::getLocale(), $album->id]) }}" target="_blank" class="cbp-l-grid-blog-title">{{ $album->title }}</a>
          <div class="cbp-l-grid-blog-date">{{ $album->created_at }}</div>
          <div class="cbp-l-grid-blog-split">|</div>

          <a href="{{ route('profile.show', [App::getLocale(), $album->user->id]) }}" class="cbp-l-grid-blog-comments">
            {{ $album->user->name }}
          </a>
          <div class="cbp-l-grid-blog-desc">
            <p style="text-align:justify">
              {{ $album->description }}
            </p>
          </div>
          <div class="cbp-l-grid-blog-desc ">
            <p style="float:left"><a class="btn btn-success btn-sm mr-5" href="{{ route('album.edit', [App::getLocale(), $album->id]) }}">{{ trans('albums.button_edit') }}</a></p>
            <p>{!! delete_to_route_with_lang(['album.destroy', App::getLocale(), $album->id]) !!}</p>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div><!-- /.body-content -->
@endsection

@section('single-scripts')
  <script src="/assets/commercial/plugins/cube-portfolio/cubeportfolio/js/jquery.cubeportfolio.min.js"></script>
  <script src="/assets/admin/js/pages/blankon.project.portfolio.js"></script>
@endsection
