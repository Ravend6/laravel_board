@extends('layouts.admin')

@section('title', 'Категории')

@section('content')
  <div class="container">
    <h1>Категории</h1>
    <hr>
    {!! link_to_action('Admin\CategoriesController@create', 'Создать категорию') !!}
    <table class="table table-striped table-hover ">
      <thead>
        <tr>
          <th>#</th>
          <th>Заглавие</th>
          <th>Родитель</th>
          <th>Позиция</th>
          <th>Опубликовано</th>
          <th>Редактировать</th>
          <th>Удалить</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($categories as $category)
          <tr class="{{ $category->is_visible ? '' : 'danger' }}">
            <td>{{ $category->id }}</td>
            <td>{{ $category->title }}</td>
            <td>{{ $category->parent ? $category->parent->title : '' }}</td>
            <td>{{ $category->position }}</td>
            <td>{{ $category->is_visible ? 'Да' : 'Нет' }}</td>
            <td>
              {!! link_to_route('admin.categories.edit', 'Редактировать', [$category->id], [
              'class' => 'btn btn-info btn-sm']) !!}
            </td>
            <td>{!! delete_to_route(['admin.categories.destroy', $category->id]) !!}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@stop