@extends('layouts.main')

@section('title', $task->title)
@section('title_class', 'icon-home icons')
@section('title_mark', '')

@section('breadcrumbs')
  <ol class="breadcrumb">
    <li class="active"><a href="/">{{ trans('navigation.main') }} </a></li> /
    <li class="active"><a href="{{ route('task.show', [App::getLocale(), $task->slug]) }}">{{ $task->title }}</a></li>
  </ol>
@stop

@section('content')
  <div class="body-content animated fadeIn">


    <div class="row" id="blog-single">

      <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">

        <div class="panel panel-default panel-blog rounded shadow">
          <div class="panel-body">
            <h3 class="blog-title">{{ $task->title }}</h3>
            <ul class="blog-meta">

              <li>Автор:
                <a href="{{ route('profile.show', [App::getLocale(), $task->customer->id]) }}" target="_blank">
                  {{ $task->customer->name }}
                </a>
              </li>

              <li>{{ $task->created_at->diffForHumans() }}</li>
              <li>
                <a href="{{ route('task.show', [App::getLocale(), $task->slug]) }}">{{ $task->propositions->count() }}
                  {{ trans('default.propositions') }}
                </a>
              </li>
            </ul>
            <div class="blog-img">
              @if ($task->image)
                <img src="/uploads/users/tasks/{{ $task->id }}/{{ $task->image }}" class="img-responsive full-width" alt="{{ $task->title }}"/>
              @else
                <img src="http://img.djavaui.com/?create=750x500,4888E1?f=ffffff" class="img-responsive full-width" alt="{{ $task->title }}">
              @endif
            </div>
            <p>{{ $task->description }}</p>
            <p>

            <div>{{ trans('tasks.category') }} {{ $task->category->title }}</div>
            <div>{{ trans('tasks.price') }} {{ $task->price }}</div>
            <div>{{ trans('tasks.date_begin') }} {{ $task->date_begin }}</div>
            <div>{{ trans('tasks.date_end') }} {{ $task->date_end }}</div>
            </p>
          </div><!-- panel-body -->
        </div><!-- panel-blog -->

        <h5 class="comment-count"> {{ $task->propositions->count() }} {{ trans('default.propositions') }}</h5>

        <ul class="media-list comment-list">

          @foreach ($task->propositions as $proposition)
            @can('showProposition', $proposition)
              <li class="media">
                <div class="media-left">
                  <a href="#">
                    @if ($proposition->user->avatar)
                      <img class="media-object thumbnail"
                      src="/uploads/users/avatars/{{ $proposition->user->id }}/{{ $proposition->user->avatar }}"
                      alt="{{ $proposition->user->name }} avatar" width="50">
                    @else
                      <img class="media-object thumbnail" src="/img/style/noavatar_m.png"
                          alt="{{ $proposition->user->name }} avatar" width="50">
                    @endif

                  </a>
                </div>
                <div class="media-body">

                  @can('createDeal', $task)
                    <a href="#" class="btn btn-success btn-xs pull-right rounded"
                      data-toggle="modal" data-target="#create-deal-{{ $proposition->id }}">
                      {{ trans('default.accept') }}
                    </a>
                  @endcan
                  @can('acceptDealProposition', $proposition)
                    <button class="btn btn-primary btn-xs pull-right rounded" disabled>Выбран</button>
                  @endcan
                  @can('processDealProposition', $proposition)
                    <button class="btn btn-warning btn-xs pull-right rounded" disabled>В процессе</button>
                  @endcan
                  @can('dissmisDealProposition', $proposition)
                    <button class="btn btn-danger btn-xs pull-right rounded" disabled>Отклонено</button>
                  @endcan

                  <h4>{{ $proposition->user->name }}</h4>
                  <small class="text-muted">{{ $proposition->price }} PLN</small> |
                  <small class="text-muted">{{ $proposition->created_at->diffForHumans() }}</small>
                  <p>{{ $proposition->description }}</p>
                </div>
              </li><!-- media -->
            @endcan
          @endforeach

        </ul><!-- comment-list -->
        <br/>
        @can('createProposition', $task)
        <h5 class="comment-title mb-5">{{ trans('task.comment_please') }}</h5>
        <p class="text-muted">{{ trans('task.about_details') }}</p>
        <div class="mb-20"></div>
          {!! Form::open([
            'method' => 'POST',
            'route' => ['proposition.store', App::getLocale()],
            'class' => 'form-horizontal mb-20'
            // 'files' => true
          ])
          !!}
          <input type="hidden" name="task_id" value="{{ $task->id }}">
          @if ($task->price != '0.00')
            <div class="checkbox">
              <label>
                <input type="checkbox" name="accept_price" id="accept_price"
                  {{ old('accept_price') ? 'checked' : '' }}>
                {{ trans('proposition.accept_price') }}
              </label>
            </div>
          @endif
          {{-- @include('proposition._form', ['submitButton' => 'Создать']) --}}
          @include('proposition._form', ['submitButton' => 'Создать'])
          <div class="form-group no-margin no-padding">
            <button type="submit" class="btn btn-success pull-right rounded"
                    onclick="return confirm('{{ trans('messages.create_confirm') }}')">
              {{ trans('default.send') }}</button>
          </div>
          {!! Form::close() !!}
        @endcan
      </div>
      <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
        <div class="blog-sidebar">
          <h5 class="blog-subtitle">Title</h5>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

          <div class="panel transparent">
            <div class="panel-heading no-border">
              <h4 class="no-margin">Flickr</h4>
            </div>
            <div class="panel-body no-padding transparent">
              <div class="blog-gallery">
                <ul class="list-inline">
                  <li>
                    <a href="#"><img src="http://img.djavaui.com/?create=64x40,81B71A?f=ffffff" alt="..."/></a>
                  </li>
                  <li>
                    <a href="#"><img src="http://img.djavaui.com/?create=64x40,A90329?f=ffffff" alt="..."/></a>
                  </li>
                  <li>
                    <a href="#"><img src="http://img.djavaui.com/?create=64x40,F4645F?f=ffffff" alt="..."/></a>
                  </li>
                  <li>
                    <a href="#"><img src="http://img.djavaui.com/?create=64x40,6880B0?f=ffffff" alt="..."/></a>
                  </li>
                  <li>
                    <a href="#"><img src="http://img.djavaui.com/?create=64x40,5a67a5?f=ffffff" alt="..."/></a>
                  </li>
                  <li>
                    <a href="#"><img src="http://img.djavaui.com/?create=64x40,DD4814?f=ffffff" alt="..."/></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <div class="panel panel-theme shadow">
            <div class="panel-heading">
              <h3 class="panel-title">Categories</h3>
            </div>
            <div class="panel-body no-padding">
              <div class="list-group no-margin">
                <a href="#" class="list-group-item">
                  Nature
                </a>
                <a href="#" class="list-group-item">Entertainment</a>
                <a href="#" class="list-group-item">Technology</a>
                <a href="#" class="list-group-item">Food &amp; Health</a>
                <a href="#" class="list-group-item">Movies &amp; TV Shows</a>
              </div>
            </div>
          </div>

          <div class="panel panel-theme shadow">
            <div class="panel-heading">
              <h3 class="panel-title">Tags</h3>
            </div>
            <div class="panel-body">
              <ul class="list-inline blog-tags">
                <li>
                  <a href="#"><i class="fa fa-tags"></i> People </a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-tags"></i> Nature </a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-tags"></i> Phone </a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-tags"></i> Internet </a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-tags"></i> Photos </a>
                </li>
                <li>
                  <a href="#"><i class="fa fa-tags"></i> Business </a>
                </li>
              </ul>
            </div>
          </div>

          <div class="panel panel-theme shadow">
            <div class="panel-heading">
              <h3 class="panel-title">Archives</h3>
            </div>
            <div class="panel-body no-padding">
              <div class="list-group no-margin">
                <a href="#" class="list-group-item">Juni 2014</a>
                <a href="#" class="list-group-item">Mei 2014</a>
                <a href="#" class="list-group-item">April 2014</a>
              </div>
            </div>
          </div>

          <div class="panel panel-theme shadow blog-list-slider">
            <div class="panel-heading">
              <h3 class="panel-title">NEWS & UPDATES</h3>
            </div>
            <div id="carousel-blog-list" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carousel-blog-list" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-blog-list" data-slide-to="1"></li>
              </ol>
              <div class="carousel-inner">
                <div class="item active">
                  <div class="blog-list">
                    <div class="media">
                      <a class="pull-left" href="#">
                        <img src="http://img.djavaui.com/?create=45x30,A90329?f=ffffff" alt="..." class="img-responsive img-thumbnail"/>
                      </a>
                      <div class="media-body">
                        <h4 class="media-heading"><a href="blog-single.html" title="Lorem ipsum dolor sit">Lorem ipsum dolor sit</a></h4>
                        <small class="media-desc">Amet, consectetur adipisicing elit, sed do ut labore et dolore magna aliqua...</small>
                      </div>
                    </div>

                    <div class="media">
                      <a class="pull-left" href="#">
                        <img src="http://img.djavaui.com/?create=45x30,F4645F?f=ffffff" alt="..." class="img-responsive img-thumbnail"/>
                      </a>
                      <div class="media-body">
                        <h4 class="media-heading"><a href="blog-single.html" title="Ut enim ad minim veniam">Ut enim ad minim veniam</a></h4>
                        <small class="media-desc">Quis nostrud exercitation ullamco laboris nisi ut aliquip ex commodo...</small>
                      </div>
                    </div>

                  </div>
                </div>
                <div class="item">
                  <div class="blog-list">
                    <div class="media">
                      <a class="pull-left" href="#">
                        <img src="http://img.djavaui.com/?create=45x30,6880B0?f=ffffff" alt="..." class="img-responsive img-thumbnail"/>
                      </a>
                      <div class="media-body">
                        <h4 class="media-heading"><a href="blog-single.html" title="Excepteur sint occaecat cupidatat">Excepteur sint occaecat cupidatat</a></h4>
                        <small class="media-desc">Sunt in culpa qui officia deserunt mollit anim id est laborum...</small>
                      </div>
                    </div>

                    <div class="media">
                      <a class="pull-left" href="#">
                        <img src="http://img.djavaui.com/?create=45x30,5a67a5?f=ffffff" alt="..." class="img-responsive img-thumbnail"/>
                      </a>
                      <div class="media-body">
                        <h4 class="media-heading"><a href="blog-single.html" title="Sed ut perspiciatis unde">Sed ut perspiciatis unde</a></h4>
                        <small class="media-desc">Omnis iste natus error sit voluptatem accusantium...</small>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div><!-- /.blog-list-slider -->

          <div class="panel transparent">
            <div class="panel-heading no-border">
              <h4 class="no-margin">Recent Twitts</h4>
            </div>
            <div class="panel-body no-padding transparent">
              <div class="blog-twitter">
                <div class="blog-twitter-list">
                  <a href="https://twitter.com/djavaui" target="_blank"> @djavaui </a>
                  <p>
                    RELEASED NEW VERSION Blankon Yii2 Framework version.
                  </p>
                  <a href="https://t.co/kvwQUHCg0w" target="_blank">
                    <em>https://t.co/kvwQUHCg0w</em>
                  </a>
                  <span> 3 hours ago </span>
                  <i class="fa fa-twitter blog-twitter-icon"></i>
                </div>
                <div class="blog-twitter-list">
                  <a href="https://twitter.com/djavaui" target="_blank"> @djavaui </a>
                  <p>
                    Blankon AngularJS version 1.0.1, Many feature are present.
                  </p>
                  <a href="https://t.co/kvwQUHCg0w" target="_blank">
                    <em>https://t.co/kvwQUHCg0w</em>
                  </a>
                  <span> 1 hours ago </span>
                  <i class="fa fa-twitter blog-twitter-icon"></i>
                </div>
              </div>
            </div>
          </div>

        </div><!-- blog-sidebar -->
      </div>
    </div><!-- row -->
  </div>
  {{-- Modal create deal --}}
  @foreach ($task->propositions as $proposition)
    @can('showProposition', $proposition)
      @can('createDeal', $task)
        <div id="create-deal-{{ $proposition->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog modal-sm">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Сделка</h4>
              </div>
              <div class="modal-body">
                Вы подтверждаете сделку с {{ $proposition->user->name }} стоимостью
                {{ $proposition->price }}? Для подтверждения нажмите {{ trans('default.yes') }},
                для отмены нажмите {{ trans('default.cancel') }}.
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('default.cancel') }}</button>
                <button type="button" class="btn btn-primary create-deal"
                  data-action="/{{ App::getLocale() }}/task/deal/{{ $task->slug }}/{{ $proposition->user->id }}/{{ $proposition->id }}">
                  {{ trans('default.yes') }}
                </button>
              </div>
            </div>
            </div>
          </div>
        </div>
      @endcan
    @endcan
  @endforeach

@stop

@section('scripts')
  <script>
    (function() {
      'use strict';

      var token = '{{ Session::getToken() }}';

      $('#accept_price').on('click', function (e) {
        var $price = $('#price');
        var taskPrice = "{{ $task->price }}";
        if ($(this).is(':checked')) {
          $price.val(taskPrice);
          $price.prop('readonly', true);
          // $price.prop('disabled', true);
        } else {
          $price.val('');
          $price.prop('readonly', false);
          // $price.prop('disabled', false);
        }
      });

      // Ajax create deal
      $('.create-deal').on('click', function (e) {
        var url = $(this).data('action');

        $.ajax({
          url: url,
          type: 'post',
          data: {
            // _method: 'patch',
            _token: token,
          },
        }).done(function (data, status, req) {
          // console.log(data);
          location.reload();
        }).fail(function (err) {
          // console.log(err);
        });
      });

    }());
  </script>
@endsection
