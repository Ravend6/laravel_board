<div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
  {!! Form::label('price', trans('proposition.price'), ['class' => 'control-label']) !!}
  {!! Form::text('price', null, ['class' => 'form-control', old('accept_price') ? 'readonly' : '']) !!}
  @if ($errors->has('price'))
    <span class="help-block">{{ $errors->first('price') }}</span>
  @endif
</div>
<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
  {!! Form::label('description', trans('proposition.description'), ['class' => 'control-label']) !!}
  {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
  @if ($errors->has('description'))
    <span class="help-block">{{ $errors->first('description') }}</span>
  @endif
</div>
