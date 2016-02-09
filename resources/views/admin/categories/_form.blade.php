<div class="form-group{{ $errors->has('parent_id') ? ' has-error' : '' }}">
  {!! Form::label('parent_id', 'Родитель:', ['class' => 'control-label']) !!}
  {!! Form::select('parent_id', $categories_list,
    null, ['class' => 'form-control']) !!}
  @if ($errors->has('parent_id'))
    <span class="help-block">{{ $errors->first('parent_id') }}</span>
  @endif
</div>
<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
  {!! Form::label('title', 'Заглавие:', ['class' => 'control-label']) !!}
  {!! Form::text('title', null, ['class' => 'form-control', 'data-csrf' => csrf_token()]) !!}
  @if ($errors->has('title'))
    <span class="help-block">{{ $errors->first('title') }}</span>
  @endif
</div>
<div class="form-group{{ $errors->has('position') ? ' has-error' : '' }}">
  {!! Form::label('position', 'Позиция:', ['class' => 'control-label']) !!}
  {!! Form::input('number', 'position', isset($categoriesCount) ? $categoriesCount : null, ['class' => 'form-control']) !!}
  @if ($errors->has('position'))
    <span class="help-block">{{ $errors->first('position') }}</span>
  @endif
</div>
<div class="form-group{{ $errors->has('is_visible') ? ' has-error' : '' }}">
  {!! Form::label('is_visible', 'Опубликовано:', ['class' => 'control-label']) !!}
  {!! Form::select('is_visible', $visible_list, null, ['class' => 'form-control']) !!}
  @if ($errors->has('is_visible'))
    <span class="help-block">{{ $errors->first('is_visible') }}</span>
  @endif
</div>
<div class="form-group">
  <button type="submit" class="btn btn-primary">{{ $submitButton }}</button>
  {{-- {!! Form::submit($submitButton, ['class' => 'btn btn-primary']) !!} --}}
</div>
