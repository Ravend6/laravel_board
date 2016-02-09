<div class="form-body">
  <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
    {!! Form::label('title', trans('albums.title'),
      ['class' => 'control-label col-lg-2 col-md-3 col-sm-3 col-xs-12']) !!}

    <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
      {!! Form::text('title', null, ['class' => 'form-control']) !!}
      @if ($errors->has('title'))
        <span class="help-block">{{ $errors->first('title') }}</span>
      @endif
    </div>
  </div>

  <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
    {!! Form::label('description', trans('albums.description'),
      ['class' => 'control-label col-lg-2 col-md-3 col-sm-3 col-xs-12']) !!}
    <div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
      {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
      @if ($errors->has('description'))
        <span class="help-block">{{ $errors->first('description') }}</span>
      @endif
    </div>
  </div>
</div>
<div class="form-footer">
  <div class="form-group">
    <div class="pull-right">
      <button type="reset" class="btn btn-danger mr-5">{{ trans('messages.button_clear') }}</button>
      <button type="submit" class="btn btn-success">{{ $submitButton }}</button>
    </div>
  </div>
</div>
