@extends('layouts.main')

@section('title', trans('navigation.deals'))
@section('title_class', 'icon-home icons')
@section('title_mark', '')

@section('breadcrumbs')
  <ol class="breadcrumb">
    <li class="active"><a href="/">{{ trans('navigation.main') }} </a></li> /
    <li class="active"><a href="{{ route('message.deal.index',
      [App::getLocale()]) }}">{{ trans('navigation.deals') }}</a></li>
  </ol>
@stop

@section('content')

  <!-- Start body content -->
  <div class="body-content animated fadeIn">

    <div class="row">
      <div class="col-md-12">

        <!-- Start double tabs -->
        <div class="panel panel-tab panel-tab-double shadow">
          <!-- Start tabs heading -->
          <div class="panel-heading no-padding">
            <ul class="nav nav-tabs">
              <li class="active nav-border nav-border-top-success">
                <a href="#tab-client-all" data-toggle="tab">
                  <i class="icon-user-following icons"></i>
                  <div>
                    <span class="text-strong">{{ trans('deals.all_deals') }} ({{ $dealMessages->count() }})</span>
                    <span>{{ trans('deals.manage_all_deals') }}</span>
                  </div>
                </a>
              </li>
              <li class="nav-border nav-border-top-danger">
                <a href="#tab-client-corporate" data-toggle="tab">
                  <i class="icon-layers icons fg-danger"></i>
                  <div>
                    <span class="text-strong">{{ trans('deals.discarded') }} ({{ $dissmisDealMessages->count() }})</span>
                    <span>{{ trans('deals.filter_red_label') }}</span>
                  </div>
                </a>
              </li>
              <li class="nav-border nav-border-top-warning">
                <a href="#tab-client-individual" data-toggle="tab">
                  <i class="icon-layers icons fg-warning"></i>
                  <div>
                    <span class="text-strong">{{ trans('deals.waiting') }} ({{ $processDealMessages->count() }})</span>
                    <span>{{ trans('deals.filter_yellow_label') }}</span>
                  </div>
                </a>
              </li>
              <li class="nav-border nav-border-top-primary">
                <a href="#tab-client-other" data-toggle="tab">
                  <i class="icon-layers icons fg-primary"></i>
                  <div>
                    <span class="text-strong">{{ trans('deals.confirmed') }} ({{ $acceptDealMessages->count() }})</span>
                    <span>{{ trans('deals.filter_blue_label') }}</span>
                  </div>
                </a>
              </li>
            </ul>
          </div><!-- /.panel-heading -->
          <!--/ End tabs heading -->

          <!-- Start tabs content -->
          <div class="panel-body no-padding">
            <div class="tab-content">
              <div class="tab-pane fade in active" id="tab-client-all">
                <!-- Start list clients all -->
                <div class="panel panel-default shadow no-margin">
                  <div class="panel-heading">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default tooltips" data-toggle="tooltip" data-placement="top" data-title="Reload" data-action="refresh"><i class="icon-refresh icons"></i></a>
                      <a href="#" class="btn btn-default tooltips" data-toggle="tooltip" data-placement="top" data-title="Print" onclick="window.print();return false;"><i class="icon-printer icons"></i></a>
                    </div>
                    <div class="pull-right">
                    </div>
                    <div class="clearfix"></div>
                  </div><!-- /.panel-heading -->
                  <div class="panel-body">
                    <!-- Start datatable -->
                    <table id="datatable-client-all" class="table table-striped table-success table-middle table-project-clients">
                      <thead>
                      <tr>
                        <th data-class="expand">Заказчик</th>
                        <th data-class="expand" >Задача</th>
                        <th data-hide="" class="text-center">Создана</th>
                        <th data-hide="" class="text-center">Начало</th>
                        <th data-hide="" class="text-center">Статус</th>
                        <th data-hide="" class="text-center">Пропозиций</th>
                        <th data-class="" class="text-center">Цена сделки</th>
                        <th data-hide="" class="text-center">Детали</th>
                      </tr>
                      </thead>
                      <!--tbody section is required-->
                      <tbody>
                        @foreach ($dealMessages as $index => $dealMessage)
                          <tr role="row" class="{{ $index % 2 != 0 ? 'even' : 'odd' }}">
                            <td class="sorting_1">
                              @if ($dealMessage->task->customer->avatar)
                                <img src="/uploads/users/avatars/{{ $dealMessage->task->customer->id }}/{{ $dealMessage->task->customer->avatar }}"
                                alt="Avatar {{ $dealMessage->task->customer->name }}" class="img-circle" width="30" height="30">
                              @else
                                <img src="http://img.djavaui.com/?create=30x30,4888E1?f=ffffff"
                                alt="Avatar {{ $dealMessage->task->customer->name }}" class="img-circle">
                              @endif
                              {{ $dealMessage->task->customer->name }}
                            </td>
                            <td>
                              <a href="{{ route('task.show', [App::getLocale(), $dealMessage->task->slug]) }}">
                                {{ $dealMessage->task->title }}
                              </a>
                            </td>
                            <td class="text-center">{{ $dealMessage->task->created_at->format('d/m/Y') }}</td>
                            <td class="text-center">{{ $dealMessage->updated_at->format('d/m/Y') }}</td>
                            <td>
                              <div class="text-center">
                                @if ($dealMessage->is_confirmed == 0)
                                  <span class="label label-warning text-capitalize">Waiting</span>
                                @endif
                                @if ($dealMessage->is_confirmed == 1)
                                  <span class="label label-primary text-capitalize">Confirmed</span>
                                @endif
                                @if ($dealMessage->is_confirmed == 2)
                                  <span class="label label-danger text-capitalize">Discarded</span>
                                @endif
                              </div>
                            </td>
                            <td class="text-center">{{ $dealMessage->task->propositions->count() }}</td>
                            <td><div class="text-center">{{ $dealMessage->price }} PLN</div></td>
                            <td>
                              <div class="text-center">
                                <a href="{{ route('message.deal.show', [App::getLocale(), $dealMessage->task->id]) }}"
                                  class="btn btn-success btn-xs rounded" data-toggle="" data-target="">
                                  {{ trans('default.preview') }}
                                </a>
                              </div>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                      <!--tfoot section is optional-->
                      <tfoot>
                      <tr>
                        <th>Заказчик</th>
                        <th class="text-center">Задача</th>
                        <th class="text-center">Создана</th>
                        <th class="text-center">Начало</th>
                        <th class="text-center">Статус</th>
                        <th class="text-center">Пропозиций</th>
                        <th class="text-center">Цена сделки</th>
                        <th class="text-center">Детали</th>
                      </tr>
                      </tfoot>
                    </table>
                    <!--/ End datatable -->
                  </div><!-- /.panel-body -->
                </div><!-- /.panel -->
                <!--/ End list clients all -->
              </div>
              <div class="tab-pane fade" id="tab-client-corporate">
                <!-- Start list clients all -->
                <div class="panel panel-default shadow no-margin">
                  <div class="panel-heading">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default tooltips" data-toggle="tooltip" data-placement="top" data-title="Reload" data-action="refresh"><i class="icon-refresh icons"></i></a>
                      <a href="#" class="btn btn-default tooltips" data-toggle="tooltip" data-placement="top" data-title="Print" onclick="window.print();return false;"><i class="icon-printer icons"></i></a>
                    </div>
                    <div class="pull-right">
                    </div>
                    <div class="clearfix"></div>
                  </div><!-- /.panel-heading -->
                  <div class="panel-body">
                    <!-- Start datatable -->
                    <table id="datatable-client-corporate" class="table table-striped table-danger table-middle table-project-clients">
                      <thead>
                      <tr>
                        <th data-class="expand">Заказчик</th>
                        <th data-class="expand" >Задача</th>
                        <th data-hide="" class="text-center">Создана</th>
                        <th data-hide="" class="text-center">Начало</th>
                        <th data-hide="" class="text-center">Статус</th>
                        <th data-hide="" class="text-center">Пропозиций</th>
                        <th data-class="" class="text-center">Цена сделки</th>
                        <th data-hide="" class="text-center">Детали</th>
                      </tr>
                      </thead>
                      <!--tbody section is required-->
                      <tbody>
                        {{-- Discarded --}}
                        @foreach ($dissmisDealMessages as $index => $dealMessage)
                          <tr role="row" class="{{ $index % 2 != 0 ? 'even' : 'odd' }}">
                            <td class="sorting_1">
                              @if ($dealMessage->task->customer->avatar)
                                <img src="/uploads/users/avatars/{{ $dealMessage->task->customer->id }}/{{ $dealMessage->task->customer->avatar }}"
                                alt="Avatar {{ $dealMessage->task->customer->name }}" class="img-circle" width="30" height="30">
                              @else
                                <img src="http://img.djavaui.com/?create=30x30,4888E1?f=ffffff"
                                alt="Avatar {{ $dealMessage->task->customer->name }}" class="img-circle">
                              @endif
                              {{ $dealMessage->task->customer->name }}
                            </td>
                            <td>
                              <a href="{{ route('task.show', [App::getLocale(), $dealMessage->task->slug]) }}">
                                {{ $dealMessage->task->title }}
                              </a>
                            </td>
                            <td class="text-center">{{ $dealMessage->task->created_at->format('d/m/Y') }}</td>
                            <td class="text-center">{{ $dealMessage->updated_at->format('d/m/Y') }}</td>
                            <td>
                              <div class="text-center">
                                <span class="label label-danger text-capitalize">Discarded</span>
                              </div>
                            </td>
                            <td class="text-center">{{ $dealMessage->task->propositions->count() }}</td>
                            <td><div class="text-center">{{ $dealMessage->price }} PLN</div></td>
                            <td>
                              <div class="text-center">
                                <a href="{{ route('message.deal.show', [App::getLocale(), $dealMessage->task->id]) }}"
                                  class="btn btn-success btn-xs rounded" data-toggle="" data-target="">
                                  {{ trans('default.preview') }}
                                </a>
                              </div>
                            </td>
                          </tr>
                        @endforeach
                        {{-- <tr role="row" class="odd">
                          <td class="sorting_1">
                            <img src="http://img.djavaui.com/?create=30x30,4888E1?f=ffffff" alt="..." class="img-circle"> Tasker Name
                          </td>
                          <td>Task Title Test Long</td>
                          <td class="text-center">17/08/2015</td>
                          <td class="text-center">17/08/2015</td>
                          <td>
                            <div class="text-center">
                              <span class="label label-danger text-capitalize">Discarded</span>
                            </div>
                          </td>
                          <td class="text-center">8</td>
                          <td><div class="text-center">400 PLN</div></td>
                          <td>
                            <div class="text-center">
                              <a href="#" class="btn btn-success btn-xs rounded" data-toggle="" data-target="">
                                {{ trans('default.preview') }}
                              </a>
                            </div>
                          </td>
                        </tr> --}}
                        {{-- <tr role="row" class="even">
                        <td class="sorting_1">
                          <img src="http://img.djavaui.com/?create=30x30,4888E1?f=ffffff" alt="..." class="img-circle"> Tasker Name
                        </td>
                        <td>Task Title Test Long</td>
                        <td class="text-center">17/08/2015</td>
                        <td class="text-center">17/08/2015</td>
                        <td>
                          <div class="text-center">
                            <span class="label label-danger text-capitalize">Discarded</span>
                          </div>
                        </td>
                        <td class="text-center">8</td>
                        <td><div class="text-center">400 PLN</div></td>
                        <td>
                          <div class="text-center">
                            <a href="#" class="btn btn-success btn-xs rounded" data-toggle="" data-target="">
                              {{ trans('default.preview') }}
                            </a>
                          </div>
                        </td>
                      </tr> --}}
                      </tbody>
                      <!--tfoot section is optional-->
                      <tfoot>
                      <tr>
                        <th>Заказчик</th>
                        <th class="text-center">Задача</th>
                        <th class="text-center">Создана</th>
                        <th class="text-center">Начало</th>
                        <th class="text-center">Статус</th>
                        <th class="text-center">Пропозиций</th>
                        <th class="text-center">Цена сделки</th>
                        <th class="text-center">Детали</th>
                      </tr>
                      </tfoot>
                    </table>
                    <!--/ End datatable -->
                  </div><!-- /.panel-body -->
                </div><!-- /.panel -->
                <!--/ End list clients all -->
              </div>
              <div class="tab-pane fade" id="tab-client-individual">
                <!-- Start list clients all -->
                <div class="panel panel-default shadow no-margin">
                  <div class="panel-heading">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default tooltips" data-toggle="tooltip" data-placement="top" data-title="Reload" data-action="refresh"><i class="icon-refresh icons"></i></a>
                      <a href="#" class="btn btn-default tooltips" data-toggle="tooltip" data-placement="top" data-title="Print" onclick="window.print();return false;"><i class="icon-printer icons"></i></a>
                    </div>
                    <div class="pull-right">
                    </div>
                    <div class="clearfix"></div>
                  </div><!-- /.panel-heading -->
                  <div class="panel-body">
                    <!-- Start datatable -->
                    <table id="datatable-client-individual" class="table table-striped table-warning table-middle table-project-clients">
                      <thead>
                      <tr>
                        <th data-class="expand">Заказчик</th>
                        <th data-class="expand" >Задача</th>
                        <th data-hide="" class="text-center">Создана</th>
                        <th data-hide="" class="text-center">Начало</th>
                        <th data-hide="" class="text-center">Статус</th>
                        <th data-hide="" class="text-center">Пропозиций</th>
                        <th data-class="" class="text-center">Цена сделки</th>
                        <th data-hide="" class="text-center">Детали</th>
                      </tr>
                      </thead>
                      <!--tbody section is required-->
                      <tbody>
                        {{-- Process --}}
                        @foreach ($processDealMessages as $index => $dealMessage)
                          <tr role="row" class="{{ $index % 2 != 0 ? 'even' : 'odd' }}">
                            <td class="sorting_1">
                              @if ($dealMessage->task->customer->avatar)
                                <img src="/uploads/users/avatars/{{ $dealMessage->task->customer->id }}/{{ $dealMessage->task->customer->avatar }}"
                                alt="Avatar {{ $dealMessage->task->customer->name }}" class="img-circle" width="30" height="30">
                              @else
                                <img src="http://img.djavaui.com/?create=30x30,4888E1?f=ffffff"
                                alt="Avatar {{ $dealMessage->task->customer->name }}" class="img-circle">
                              @endif
                              {{ $dealMessage->task->customer->name }}
                            </td>
                            <td>
                              <a href="{{ route('task.show', [App::getLocale(), $dealMessage->task->slug]) }}">
                                {{ $dealMessage->task->title }}
                              </a>
                            </td>
                            <td class="text-center">{{ $dealMessage->task->created_at->format('d/m/Y') }}</td>
                            <td class="text-center">{{ $dealMessage->updated_at->format('d/m/Y') }}</td>
                            <td>
                              <div class="text-center">
                                <span class="label label-warning text-capitalize">Waiting</span>
                              </div>
                            </td>
                            <td class="text-center">{{ $dealMessage->task->propositions->count() }}</td>
                            <td><div class="text-center">{{ $dealMessage->price }} PLN</div></td>
                            <td>
                              <div class="text-center">
                                <a href="{{ route('message.deal.show', [App::getLocale(), $dealMessage->task->id]) }}"
                                  class="btn btn-success btn-xs rounded" data-toggle="" data-target="">
                                  {{ trans('default.preview') }}
                                </a>
                              </div>
                            </td>
                          </tr>
                        @endforeach
                        {{-- <tr role="row" class="odd">
                          <td class="sorting_1">
                            <img src="http://img.djavaui.com/?create=30x30,4888E1?f=ffffff" alt="..." class="img-circle"> Tasker Name
                          </td>
                          <td>Task Title Test Long</td>
                          <td class="text-center">17/08/2015</td>
                          <td class="text-center">17/08/2015</td>
                          <td>
                            <div class="text-center">
                              <span class="label label-warning text-capitalize">Waiting</span>
                            </div>
                          </td>
                          <td class="text-center">8</td>
                          <td><div class="text-center">400 PLN</div></td>
                          <td>
                            <div class="text-center">
                              <a href="#" class="btn btn-success btn-xs rounded" data-toggle="" data-target="">
                                {{ trans('default.preview') }}
                              </a>
                            </div>
                          </td>
                        </tr> --}}
                      </tbody>
                      <!--tfoot section is optional-->
                      <tfoot>
                      <tr>
                        <th>Заказчик</th>
                        <th class="text-center">Задача</th>
                        <th class="text-center">Создана</th>
                        <th class="text-center">Начало</th>
                        <th class="text-center">Статус</th>
                        <th class="text-center">Пропозиций</th>
                        <th class="text-center">Цена сделки</th>
                        <th class="text-center">Детали</th>
                      </tr>
                      </tfoot>
                    </table>
                    <!--/ End datatable -->
                  </div><!-- /.panel-body -->
                </div><!-- /.panel -->
                <!--/ End list clients all -->
              </div>
              <div class="tab-pane fade" id="tab-client-other">
                <!-- Start list clients all -->
                <div class="panel panel-default shadow no-margin">
                  <div class="panel-heading">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default tooltips" data-toggle="tooltip" data-placement="top" data-title="Reload" data-action="refresh"><i class="icon-refresh icons"></i></a>
                      <a href="#" class="btn btn-default tooltips" data-toggle="tooltip" data-placement="top" data-title="Print" onclick="window.print();return false;"><i class="icon-printer icons"></i></a>
                    </div>
                    <div class="pull-right">
                    </div>
                    <div class="clearfix"></div>
                  </div><!-- /.panel-heading -->
                  <div class="panel-body">
                    <!-- Start datatable -->
                    <table id="datatable-client-other" class="table table-striped table-primary table-middle table-project-clients">
                      <thead>
                      <tr>
                        <th data-class="expand">Заказчик</th>
                        <th data-class="expand" >Задача</th>
                        <th data-hide="" class="text-center">Создана</th>
                        <th data-hide="" class="text-center">Начало</th>
                        <th data-hide="" class="text-center">Статус</th>
                        <th data-hide="" class="text-center">Пропозиций</th>
                        <th data-class="" class="text-center">Цена сделки</th>
                        <th data-hide="" class="text-center">Детали</th>
                      </tr>
                      </thead>
                      <!--tbody section is required-->
                      <tbody>
                        {{-- Confirmed --}}
                        @foreach ($processDealMessages as $index => $dealMessage)
                          <tr role="row" class="{{ $index % 2 != 0 ? 'even' : 'odd' }}">
                            <td class="sorting_1">
                              @if ($dealMessage->task->customer->avatar)
                                <img src="/uploads/users/avatars/{{ $dealMessage->task->customer->id }}/{{ $dealMessage->task->customer->avatar }}"
                                alt="Avatar {{ $dealMessage->task->customer->name }}" class="img-circle" width="30" height="30">
                              @else
                                <img src="http://img.djavaui.com/?create=30x30,4888E1?f=ffffff"
                                alt="Avatar {{ $dealMessage->task->customer->name }}" class="img-circle">
                              @endif
                              {{ $dealMessage->task->customer->name }}
                            </td>
                            <td>
                              <a href="{{ route('task.show', [App::getLocale(), $dealMessage->task->slug]) }}">
                                {{ $dealMessage->task->title }}
                              </a>
                            </td>
                            <td class="text-center">{{ $dealMessage->task->created_at->format('d/m/Y') }}</td>
                            <td class="text-center">{{ $dealMessage->updated_at->format('d/m/Y') }}</td>
                            <td>
                              <div class="text-center">
                                <span class="label label-primary text-capitalize">Confirmed</span>
                              </div>
                            </td>
                            <td class="text-center">{{ $dealMessage->task->propositions->count() }}</td>
                            <td><div class="text-center">{{ $dealMessage->price }} PLN</div></td>
                            <td>
                              <div class="text-center">
                                <a href="{{ route('message.deal.show', [App::getLocale(), $dealMessage->task->id]) }}"
                                  class="btn btn-success btn-xs rounded" data-toggle="" data-target="">
                                  {{ trans('default.preview') }}
                                </a>
                              </div>
                            </td>
                          </tr>
                        @endforeach
                        {{-- <tr role="row" class="odd">
                        <td class="sorting_1">
                          <img src="http://img.djavaui.com/?create=30x30,4888E1?f=ffffff" alt="..." class="img-circle"> Tasker Name
                        </td>
                        <td>Task Title Test Long</td>
                        <td class="text-center">17/08/2015</td>
                        <td class="text-center">17/08/2015</td>
                        <td>
                          <div class="text-center">
                            <span class="label label-primary text-capitalize">Confirmed</span>
                          </div>
                        </td>
                        <td class="text-center">8</td>
                        <td><div class="text-center">400 PLN</div></td>
                        <td>
                          <div class="text-center">
                            <a href="#" class="btn btn-success btn-xs rounded" data-toggle="" data-target="">
                              {{ trans('default.preview') }}
                            </a>
                          </div>
                        </td>
                      </tr> --}}
                      </tbody>
                      <!--tfoot section is optional-->
                      <tfoot>
                      <tr>
                        <th>Заказчик</th>
                        <th class="text-center">Задача</th>
                        <th class="text-center">Создана</th>
                        <th class="text-center">Начало</th>
                        <th class="text-center">Статус</th>
                        <th class="text-center">Пропозиций</th>
                        <th class="text-center">Цена сделки</th>
                        <th class="text-center">Детали</th>
                      </tr>
                      </tfoot>
                    </table>
                    <!--/ End datatable -->
                  </div><!-- /.panel-body -->
                </div><!-- /.panel -->
                <!--/ End list clients all -->
              </div>
            </div>
          </div><!-- /.panel-body -->
          <!--/ End tabs content -->
        </div><!-- /.panel -->
        <!--/ End double tabs -->

      </div>
    </div><!-- /.row -->

  </div><!-- /.body-content -->
  <!--/ End body content -->


  {{-- <h4>В процессее</h4>
  <ul>
    @foreach ($processDealMessages as $processDealMessage)
      <li>
        Заказчик:
        <a href="{{ route('profile.show', [App::getLocale(),
          $processDealMessage->task->customer->id]) }}">
          {{ $processDealMessage->task->customer->name }}
        </a>
        Задача:
        <a href="{{ route('task.show', [App::getLocale(),
          $processDealMessage->task->slug]) }}">
          {{ $processDealMessage->task->title }}
        </a>
        Цена: {{ $processDealMessage->proposition->price }}
        Подтверждаете быть исполнителем?
        <a href="#" class="btn btn-primary btn-sm task-update-deal"
          data-action="{{ route('task.deal.update', [App::getLocale(),
          $processDealMessage->task->slug, $processDealMessage->user_id,
          $processDealMessage->proposition_id, 'ok']) }}">
          {{ trans('default.accept') }}
        </a>
        <a href="#" class="btn btn-danger btn-sm task-update-deal"
          data-action="{{ route('task.deal.update', [App::getLocale(),
          $processDealMessage->task->slug, $processDealMessage->user_id,
          $processDealMessage->proposition_id, 'no']) }}">
          {{ trans('default.cancel') }}
        </a>
      </li>
    @endforeach
  </ul>
  <hr>
  <h4>Принятые</h4>
  <ul>
    @foreach ($acceptDealMessages as $acceptDealMessage)
      <li>
        Заказчик:
        <a href="{{ route('profile.show', [App::getLocale(),
          $acceptDealMessage->task->customer->id]) }}">
          {{ $acceptDealMessage->task->customer->name }}
        </a>
        Цена: {{ $acceptDealMessage->proposition->price }}
        Задача:
        <a href="{{ route('task.show', [App::getLocale(),
          $acceptDealMessage->task->slug]) }}">
          {{ $acceptDealMessage->task->title }}
        </a>
        Принята
      </li>
    @endforeach
  </ul>
  <hr>
  <h4>Отклоненные</h4>
  <ul>
    @foreach ($dissmisDealMessages as $dissmisDealMessage)
      <li>
        Заказчик:
        <a href="{{ route('profile.show', [App::getLocale(),
          $dissmisDealMessage->task->customer->id]) }}">
          {{ $dissmisDealMessage->task->customer->name }}
        </a>
        Цена: {{ $dissmisDealMessage->proposition->price }}
        Задача:
        <a href="{{ route('task.show', [App::getLocale(),
          $dissmisDealMessage->task->slug]) }}">
          {{ $dissmisDealMessage->task->title }}
        </a>
        Отклонена
      </li>
    @endforeach
  </ul> --}}
@endsection

@section('scripts')
  <script>
    (function() {
      'use strict';

      var token = '{{ Session::getToken() }}';

      // $('.task-update-deal').on('click', function (e) {
      //   e.preventDefault();
      //   var url = $(this).data('action');
      //
      //   $.ajax({
      //     url: url,
      //     type: 'post',
      //     data: {
      //       _method: 'patch',
      //       _token: token,
      //     },
      //   }).done(function (data, status, req) {
      //     // console.log(data);
      //     location.reload();
      //   }).fail(function (err) {
      //     // console.log(err);
      //   });
      // })

    }());
  </script>
@endsection
