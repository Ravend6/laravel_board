@extends('layouts.admin')

@section('title', 'Водительские права для анкеты')

@section('content')
  <h1 class="page-header">Водительские права для анкеты</h1>
  {!! link_to_action('Admin\DriverLicensesController@create', 'Создать водительские права') !!}
  <table class="table table-striped table-hover ">
    <thead>
      <tr>
        <th>#</th>
        <th>Заглавие</th>
        <th>Редактировать</th>
        <th>Удалить</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($driver_licenses as $driver_license)
        <tr>
          <td>{{ $driver_license->id }}</td>
          <td>{{ $driver_license->title }}</td>
          <td>
            {!! link_to_route('admin.driver_licenses.edit', 'Редактировать', [$driver_license->id], [
            'class' => 'btn btn-info btn-sm']) !!}
          </td>
          <td>{!! delete_to_route(['admin.driver_licenses.destroy', $driver_license->id]) !!}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@stop