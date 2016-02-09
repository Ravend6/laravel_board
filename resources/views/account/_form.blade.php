<div class="form-body">
  <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
    {!! Form::label('category_id', trans('account.main_category'),
      ['class' => 'control-label col-lg-2 col-md-3 col-sm-3 col-xs-12']) !!}

    <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
      <select name="category_id" id="category_id" class="form-control">
        <option value="">{{ trans('tasks.category_select') }}</option>
        @foreach ($categories as $category)
          @if (!$category->parent_id and !$category->children->isEmpty())
            <optgroup label="{{ $category->title }}">
              @foreach ($category->children as $children)
                @if (Auth::user()->executant)
                  @if (Auth::user()->executant->category_id == $children->id)
                    <option value="{{ $children->id }}" selected>{{ $children->title }}</option>
                  @else
                    <option value="{{ $children->id }}">{{ $children->title }}</option>
                  @endif
                @else
                  @if (old('category_id') == $children->id)
                    <option value="{{ $children->id }}" selected>{{ $children->title }}</option>
                  @else
                    <option value="{{ $children->id }}">{{ $children->title }}</option>
                  @endif
                @endif
              @endforeach
            </optgroup>
          @endif
        @endforeach
      </select>
      @if ($errors->has('category_id'))
        <span class="help-block">{{ $errors->first('category_id') }}</span>
      @endif
    </div>
  </div>
  <div class="form-group{{ $errors->has('hourly_wage') ? ' has-error' : '' }}">
    {!! Form::label('hourly_wage', trans('account.hourly_wage'),
      ['class' => 'control-label col-lg-2 col-md-3 col-sm-3 col-xs-12']) !!}

    <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
      {!! Form::text('hourly_wage', null, ['class' => 'form-control']) !!}
      @if ($errors->has('hourly_wage'))
        <span class="help-block">{{ $errors->first('hourly_wage') }}</span>
      @endif
    </div>
  </div>
  <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
    {!! Form::label('description', trans('account.description'),
      ['class' => 'control-label col-lg-2 col-md-3 col-sm-3 col-xs-12']) !!}

    <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
      {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
      @if ($errors->has('description'))
        <span class="help-block">{{ $errors->first('description') }}</span>
      @endif
    </div>
  </div>
  <div class="form-group{{ $errors->has('language_list') ? ' has-error' : '' }}">
    {!! Form::label('language_list', trans('account.languages'),
      ['class' => 'control-label col-lg-2 col-md-3 col-sm-3 col-xs-12']) !!}

    <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
      {!! Form::select('language_list[]', $languages, null,
        ['id' => 'language_list', 'class' => 'form-control', 'multiple']) !!}
      @if ($errors->has('language_list'))
        <span class="help-block">{{ $errors->first('language_list') }}</span>
      @endif
    </div>
  </div>
  <div class="form-group{{ $errors->has('driver_license_list') ? ' has-error' : '' }}">
    {!! Form::label('driver_license_list', trans('account.driver_license'),
      ['class' => 'control-label col-lg-2 col-md-3 col-sm-3 col-xs-12']) !!}

    <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
      {!! Form::select('driver_license_list[]', $driver_licenses, null,
      ['id' => 'driver_license_list', 'class' => 'form-control', 'multiple']) !!}
      @if ($errors->has('driver_license_list'))
        <span class="help-block">{{ $errors->first('driver_license_list') }}</span>
      @endif
    </div>
  </div>
</div>
<div class="form-footer">
  <div class="form-group">
    <div class="pull-right">
      <button data-type="reset" class="btn btn-danger mr-5">{{ trans('default.clear') }}</button>
      <button data-type="submit" class="btn btn-success">{{ $submitButton }}</button>
    </div>
  </div>
</div>
