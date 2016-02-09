@extends('layouts.main')

@section('title', trans('tasks.create_button'))
@section('title_class', 'icon-note icons')
@section('title_mark', '')

@section('single-styles')

@endsection

@section('breadcrumbs')
  <ol class="breadcrumb">
    <li class="active"><a href="/">Главная </a></li> /
    <li class="active"><a href="{{ route('task.create', [App::getLocale()]) }}">Создать задачу</a></li>
  </ol>
@endsection

@section('content')
  <div class="row">
    <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2">
      <div class="well bs-component">
        <div class="panel rounded shadow">
          @include('includes._panel-heading')
          @include('errors.validation')

          <div class="panel-body no-padding border-bottom">
            <form class="form-horizontal" role="form" method="POST" action="{{ route('task.store', [App::getLocale()]) }}" enctype="multipart/form-data">
              <div class="form-body">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_disabled" value="1">

                @if (Auth::guest())
                  <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    {!! Form::label('name', trans('auth.name'),
                      ['class' => 'control-label col-lg-2 col-md-3 col-sm-3 col-xs-12']) !!}

                    <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                      <input type="text" class="form-control" name="name" value="{{ old('name') }}" id="name">
                      @if ($errors->has('name'))
                        <span class="help-block">{{ $errors->first('name') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    {!! Form::label('email', 'E-Mail',
                      ['class' => 'control-label col-lg-2 col-md-3 col-sm-3 col-xs-12']) !!}

                    <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                      <input type="email" class="form-control" name="email" value="{{ old('email') }}" id="email">
                      @if ($errors->has('email'))
                        <span class="help-block">{{ $errors->first('email') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                    {!! Form::label('phone', trans('auth.phone'),
                      ['class' => 'control-label col-lg-2 col-md-3 col-sm-3 col-xs-12']) !!}

                    <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                      <input type="tel" class="form-control" name="phone" value="{{ old('phone') }}" id="phone">
                      @if ($errors->has('phone'))
                        <span class="help-block">{{ $errors->first('phone') }}</span>
                      @endif
                    </div>
                  </div>
                @endif

                <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                  {!! Form::label('category_id', trans('tasks.category'),
                    ['class' => 'control-label col-lg-2 col-md-3 col-sm-3 col-xs-12'])!!}

                  <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                    <select name="category_id" id="category_id" class="form-control">
                      <option value="">{{ trans('tasks.category_select') }}</option>
                      @foreach ($categories as $category)
                        @if (!$category->parent_id and !$category->children->isEmpty())
                          <optgroup label="{{ $category->title }}">
                            @foreach ($category->children as $children)
                              @if (old('category_id') == $children->id)
                                <option value="{{ $children->id }}" selected>{{ $children->title }}</option>
                              @else
                                <option value="{{ $children->id }}">{{ $children->title }}</option>
                              @endif
                            @endforeach
                          </optgroup>
                        @endif
                      @endforeach
                    </select>
                    {{-- {!! Form::select('category_id', $category_list, null, ['class' => 'form-control']) !!} --}}
                    @if ($errors->has('category_id'))
                      <span class="help-block">{{ $errors->first('category_id') }}</span>
                    @endif
                  </div>
                </div>
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                  {!! Form::label('title', trans('tasks.title'),
                    ['class' => 'control-label col-lg-2 col-md-3 col-sm-3 col-xs-12']) !!}

                  <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                    <input type="title" class="form-control" id="title" value="{{ old('title') }}" name="title">
                    @if ($errors->has('title'))
                      <span class="help-block">{{ $errors->first('title') }}</span>
                    @endif
                  </div>
                </div>
                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                  {!! Form::label('description', trans('tasks.description'),
                    ['class' => 'control-label col-lg-2 col-md-3 col-sm-3 col-xs-12']) !!}

                  <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                    <textarea class="form-control" rows="6" id="description" name="description">{{ old('description') }}</textarea>
                    @if ($errors->has('description'))
                      <span class="help-block">{{ $errors->first('description') }}</span>
                    @endif
                  </div>
                </div>
                <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                  {!! Form::label('image', trans('tasks.image'),
                    ['class' => 'control-label col-lg-2 col-md-3 col-sm-3 col-xs-12']) !!}

                  <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                    {!! Form::file('image', null, ['class' => 'form-control']) !!}
                    @if ($errors->has('image'))
                      <span class="help-block">{{ $errors->first('image') }}</span>
                    @endif
                  </div>
                </div>
                <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                  {!! Form::label('price', trans('tasks.price'),
                    ['class' => 'control-label col-lg-2 col-md-3 col-sm-3 col-xs-12']) !!}

                  <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                    <input type="price" class="form-control" id="price" value="{{ old('price') }}" name="price">
                    @if ($errors->has('price'))
                      <span class="help-block">{{ $errors->first('price') }}</span>
                    @endif
                  </div>
                </div>
                <div class="form-group{{ $errors->has('date_begin') ? ' has-error' : '' }}">
                  {!! Form::label('date_begin', trans('tasks.date_begin'),
                  ['class' => 'control-label col-lg-2 col-md-3 col-sm-3 col-xs-12']) !!}

                  <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                    <input type="datetime-local" class="form-control" id="date_begin"
                    value="{{ old('date_begin') ?: date('Y-m-d').'T'.date('H:i:s') }}"
                    name="date_begin">
                    @if ($errors->has('date_begin'))
                      <span class="help-block">{{ $errors->first('date_begin') }}</span>
                    @endif
                  </div>
                </div>
                <div class="form-group{{ $errors->has('date_end') ? ' has-error' : '' }}">
                  {!! Form::label('date_end', trans('tasks.date_end'),
                  ['class' => 'control-label col-lg-2 col-md-3 col-sm-3 col-xs-12']) !!}

                  <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
                    <input type="datetime-local" class="form-control" id="date_end" value="{{ old('date_end') }}" name="date_end">
                    @if ($errors->has('date_end'))
                      <span class="help-block">{{ $errors->first('date_end') }}</span>
                    @endif
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12 col-lg-offset-2 col-md-offset-3 col-sm-offset-3">
                      <button data-type="reset" class="btn btn-danger mr-5">{{ trans('messages.button_clear') }}</button>
                      <button type="submit" class="btn btn-success">{{ trans('tasks.create_button') }}</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('single-scripts')

@endsection
