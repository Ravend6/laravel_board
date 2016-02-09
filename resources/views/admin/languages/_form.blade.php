<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
  {!! Form::label('title', 'Заглавие', ['class' => 'control-label']) !!}
  {!! Form::text('title', null, ['class' => 'form-control', 'data-csrf' => csrf_token()]) !!}
  @if ($errors->has('title'))
    <span class="help-block">{{ $errors->first('title') }}</span>
  @endif
</div>
<div class="form-group{{ $errors->has('country_code_2') ? ' has-error' : '' }}">
  {!! Form::label('country_code_2', 'Код страны 2', ['class' => 'control-label']) !!}
  {!! Form::text('country_code_2', null, ['class' => 'form-control', 'data-csrf' => csrf_token()]) !!}
  @if ($errors->has('country_code_2'))
    <span class="help-block">{{ $errors->first('country_code_2') }}</span>
  @endif
</div>
<div class="form-group">
  <button type="submit" class="btn btn-primary">{{ $submitButton }}</button>
  {{-- {!! Form::submit($submitButton, ['class' => 'btn btn-primary']) !!} --}}
</div>
