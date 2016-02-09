@extends('layouts.main')

@section('title', 'Профиль')
@section('title_class', 'icon-user icons')
@section('title_mark', '')

@section('single-styles')
  <link href="/assets/global/plugins/bower_components/flag-icon-css/css/flag-icon.min.css" rel="stylesheet">
  <link href="/assets/commercial/plugins/cube-portfolio/cubeportfolio/css/cubeportfolio.min.css" rel="stylesheet">
  <link href="/assets/admin/css/pages/project-team.css" rel="stylesheet">
@endsection

@section('breadcrumbs')
  <ol class="breadcrumb">
    <li class="active"><a href="/">{{ trans('navigation.main') }} </a></li> /
    <li class="active"><a href="{{ route('account.index', [App::getLocale()]) }}">{{ trans('navigation.account') }} </a></li>
  </ol>
@endsection

@section('content')
  <style>
    .icon-plus{
      line-height: inherit;
    }
    .icon-plus::before{
      display: none;
    }
  </style>
  <div class="body-content animated fadeIn">

    <div class="row">
      <div class="col-md-12">
        <div class="cbp-l-member-img no-margin">

          @if (Auth::user()->avatar)
            <img src="/uploads/users/avatars/{{ Auth::user()->id }}/{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }} avatar">
          @else
             <img src="/img/noimage/avatar/410_310/noavatar_m.png"
              alt="{{ Auth::user()->name }} avatar" class="thumbnail" >
          @endif


        </div>
        <div class="cbp-l-member-info no-margin">
          <div class="cbp-l-member-name">{{ Auth::user()->name }} <i class="fa fa-check-circle text-success"></i></div>
          <div class="cbp-l-member-position">{{ Auth::user()->executant->category->title }}</div>
          <div class="cbp-l-member-desc">
            <p><b>{{ trans('account.hourly_wage') }}:</b> {{ Auth::user()->executant->hourly_wage }}</p>
            <p><b>E-Mail:</b> {{ Auth::user()->email }}</p>
            <p><b>{{ trans('account.phone') }}:</b> +{{ Auth::user()->phone }}</p>
            {{ Auth::user()->executant->description }}
          </div>
          <div class="cbp-l-member-meta">
            <ul class="list-inline">
              <li>
                <a href="#" target="_blank"><i class="fa fa-envelope-o"></i> </a>
              </li>
              <li>
                <a href="#"><i class="fa fa-phone"></i></a>
              </li>
              <li>
                <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
              </li>
            </ul>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="cbp-l-member-biodata">
          <div class="row">
            <div class="col-md-9">
              <div class="resume-category">
                <h3 class="resume-category-title clearfix">{{ trans('account.education') }} <span id="toggle-form-study-create" class="icon-plus cursor"><i class="fa fa-plus"></i></span></h3>

                @can('createStudy', Auth::user())
                  <form id="form-study-create" class="form-horizontal mb-10 mt-20"
                  role="form" style="display: none;" method="post"
                  action="{{ route('account.study.store', [App::getLocale()]) }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="{{ trans('account.institution') }}"
                      name="institution">
                      <span class="help-block"></span>
                    </div>
                    <div class="no-margin">
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <input type="text" class="form-control"
                            placeholder="{{ trans('account.specialization') }}"
                            name="specialization">
                            <span class="help-block"></span>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-btn">
                                <span class="btn ">{{ trans('default.from') }}</span>
                              </span>
                              <input class="form-control" type="date" name="from">
                            </div>
                            <span class="help-block"></span>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-btn">
                                <span class="btn">{{ trans('default.to') }}</span>
                              </span>
                              <input class="form-control study-to-0" type="date"
                              name="to" data-id="0">
                            </div>
                            <span class="help-block"></span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <input type="hidden" name="_wysihtml5_mode" value="1">
                      <textarea id="comment-form" class="form-control" rows="5"
                      placeholder="{{ trans('account.whats_new') }}" name="description"></textarea>
                      <span class="help-block"></span>
                    </div>

                    <div class="form-group no-margin no-padding">
                      <button type="submit" class="btn btn-success pull-right rounded">{{ trans('default.add_info') }}</button>
                      <div class="pull-right mr-20 mt-5">
                        {{-- <div class="ckbox ckbox-theme">
                          <input id="is_present" type="checkbox" name="is_present">
                          <label for="is_present">{{ trans('account.yet_study') }}</label>
                        </div> --}}
                        <div class="checkbox">
                          <label>
                            <input data-type="study" data-id="0" type="checkbox"
                            name="is_present"> {{ trans('account.yet_study') }}
                          </label>
                        </div>
                      </div>
                    </div>
                  </form>
                @endcan


                  {{-- <form id="form-study-update" class="form-horizontal mb-10 mt-20"
                  role="form" style="display: none;" method="post"
                  action="{{ route('account.study.update', [App::getLocale()]) }}">
                    <input name="_method" type="hidden" value="PATCH">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="{{ trans('account.institution') }}"
                      name="institution" value="{{ Auth::user()->study->institution }}">
                    </div>
                    <div class="form-group no-margin">
                      <div class="row">
                        <div class="col-md-4">
                          <input type="text" class="form-control mb-15"
                          placeholder="{{ trans('account.specialization') }}"
                          name="specialization" value="{{ Auth::user()->study->specialization }}">
                        </div>
                        <div class="col-md-4">
                          <div class="input-group mb-15">
                            <span class="input-group-btn">
                              <span class="btn ">{{ trans('default.from') }}</span></span>
                            <input class="form-control" type="date" name="from"
                            value="{{ Auth::user()->study->from }}">
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="input-group mb-15">
                            <span class="input-group-btn">
                              <span class="btn ">{{ trans('default.to') }}</span></span>
                            <input class="form-control" type="date" name="to"
                            value="{{ Auth::user()->study->to }}">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <textarea id="comment-form" class="form-control" rows="5"
                      placeholder="{{ trans('account.whats_new') }}"
                      name="description">{{ Auth::user()->study->description }}</textarea>
                      <input type="hidden" name="_wysihtml5_mode" value="1">
                    </div>

                    <div class="form-group no-margin no-padding">
                      <button type="submit" class="btn btn-success pull-right rounded">{{ trans('default.edit') }}</button>
                      <div class="pull-right mr-20 mt-5">
                        <div class="ckbox ckbox-theme">
                          <input id="checkbox-checked1" type="checkbox">
                          <label for="checkbox-checked1">{{ trans('account.yet_study') }}</label>
                        </div>
                      </div>
                    </div>
                  </form> --}}
                  @foreach (Auth::user()->studies as $study)
                    <div class="resume-post">
                      <div class="resume-post-body">
                        <div class="resume-post-date edit-study" data-id="{{ $study->id }}"><a href="#">{{ trans('default.edit') }} <span class="fa fa-pencil-square-o"></span></a></div>
                        <h4 class="resume-post-title">{{ $study->institution }}</h4>
                        <h5 class="resume-post-subtitle">{{ $study->specialization }}
                          <div class="pull-right">
                            {{ $study->from }} - {{ $study->is_present ? 'Present' : $study->to }}
                          </div>
                        </h5>
                        <div class="resume-post-cont">
                          <p>{{ $study->description }}</p>
                        </div>
                      </div>
                    </div>
                    @can('updateStudy', $study)
                      <form class="form-study-update form-study-update-{{ $study->id }} form-horizontal mb-10 mt-20"
                      role="form" style="display: none;" method="post" data-show="false"
                      action="{{ route('account.study.update', [App::getLocale(), $study->id]) }}">
                        <input name="_method" type="hidden" value="PATCH">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                          <input type="text" class="form-control" placeholder="{{ trans('account.institution') }}"
                          name="institution" value="{{ $study->institution }}">
                          <span class="help-block"></span>
                        </div>
                        <div class="no-margin">
                          <div class="row">
                            <div class="col-md-4">
                              <div class="form-group">
                                <input type="text" class="form-control"
                                placeholder="{{ trans('account.specialization') }}"
                                name="specialization" value="{{ $study->specialization }}">
                                <span class="help-block"></span>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-btn">
                                    <span class="btn ">{{ trans('default.from') }}</span>
                                  </span>
                                  <input class="form-control" type="date" name="from"
                                  value="{{ $study->from }}">
                                </div>
                                <span class="help-block"></span>
                              </div>
                            </div>
                            <div class="col-md-4">
                              <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-btn">
                                    <span class="btn">{{ trans('default.to') }}</span>
                                  </span>
                                  <input class="form-control study-to-{{ $study->id }}" type="date" name="to"
                                  {{ $study->is_present ? 'disabled' : 'value='.$study->to}}
                                  data-id="{{ $study->id }}">
                                </div>
                                <span class="help-block"></span>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <input type="hidden" name="_wysihtml5_mode" value="1">
                          <textarea id="comment-form" class="form-control" rows="5"
                          placeholder="{{ trans('account.whats_new') }}" name="description">{{ $study->description }}</textarea>
                          <span class="help-block"></span>
                        </div>

                        <div class="form-group no-margin no-padding">
                          <button type="submit" class="btn btn-success pull-right rounded">{{ trans('default.edit') }}</button>
                          <div class="pull-right mr-20 mt-5">
                            {{-- <div class="ckbox ckbox-theme">
                              <input class="is_present" type="checkbox" name="is_present"
                              data-id="{{ $study->id }}" {{ $study->is_present ? 'checked' : ''}}>
                              <label for="is_present">{{ trans('account.yet_study') }}</label>
                            </div> --}}
                            <div class="checkbox">
                              <label>
                                <input type="checkbox" name="is_present"
                                data-type="study"
                                data-id="{{ $study->id }}" {{ $study->is_present ? 'checked' : ''}}>
                                {{ trans('account.yet_study') }}
                              </label>
                            </div>
                          </div>
                        </div>
                      </form>
                    @endcan
                  @endforeach



              </div>
              <div class="resume-category">
                <h3 class="resume-category-title clearfix">{{ trans('account.professional_expirience') }} <span id="toggle-form-experience-create" class="icon-plus cursor"><i class="fa fa-plus"></i></span></h3>

                @can('createExperience', Auth::user())
                  <form id="form-experience-create" class="form-horizontal mb-10 mt-20"
                  role="form" style="display: none;" method="post"
                  action="{{ route('account.experience.store', [App::getLocale()]) }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                      <input type="text" class="form-control" placeholder="{{ trans('account.company_name') }}"
                      name="company">
                      <span class="help-block"></span>
                    </div>
                    <div class="no-margin">
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <input type="text" class="form-control"
                            placeholder="{{ trans('account.position') }}"
                            name="position">
                            <span class="help-block"></span>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-btn">
                                <span class="btn ">{{ trans('default.from') }}</span>
                              </span>
                              <input class="form-control" type="date" name="from">
                            </div>
                            <span class="help-block"></span>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-btn">
                                <span class="btn">{{ trans('default.to') }}</span>
                              </span>
                              <input class="form-control experience-to-0" type="date"
                              name="to" data-id="0">
                            </div>
                            <span class="help-block"></span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <input type="hidden" name="_wysihtml5_mode" value="1">
                      <textarea id="comment-form" class="form-control" rows="5"
                      placeholder="{{ trans('account.whats_new') }}" name="description"></textarea>
                      <span class="help-block"></span>
                    </div>

                    <div class="form-group no-margin no-padding">
                      <button type="submit" class="btn btn-success pull-right rounded">{{ trans('default.add_info') }}</button>
                      <div class="pull-right mr-20 mt-5">
                        {{-- <div class="ckbox ckbox-theme">
                          <input id="is_present" type="checkbox" name="is_present">
                          <label for="is_present">{{ trans('account.yet_study') }}</label>
                        </div> --}}
                        <div class="checkbox">
                          <label>
                            <input data-type="experience" data-id="0" type="checkbox"
                            name="is_present"> {{ trans('account.yet_working') }}
                          </label>
                        </div>
                      </div>
                    </div>
                  </form>
                @endcan

                {{-- <form class="form-horizontal mb-10 mt-20" role="form">
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="{{ trans('account.company_name') }}">
                  </div>
                  <div class="form-group no-margin">
                    <div class="row">
                      <div class="col-md-4">
                        <input type="text" class="form-control mb-15" placeholder="{{ trans('account.position') }}">
                      </div>
                      <div class="col-md-4">
                        <div class="input-group mb-15">
                          <span class="input-group-btn">
                            <span class="btn ">{{ trans('default.from') }}</span></span>
                          <input class="form-control" type="date">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="input-group mb-15">
                          <span class="input-group-btn">
                            <span class="btn ">{{ trans('default.to') }}</span></span>
                          <input class="form-control" type="date">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <textarea id="comment-form" class="form-control" rows="5" placeholder="{{ trans('account.whats_new') }}"></textarea>
                    <input type="hidden" name="_wysihtml5_mode" value="1">
                  </div>
                  <div class="form-group no-margin no-padding">
                    <button type="submit" class="btn btn-success pull-right rounded">{{ trans('default.add_info') }}</button>
                    <div class="pull-right mr-20 mt-5">
                      <div class="ckbox ckbox-theme">
                        <input id="checkbox-checked1" type="checkbox">
                        <label for="checkbox-checked1">{{ trans('account.yet_working') }}</label>
                      </div>
                    </div>
                  </div>
                </form> --}}
                @foreach (Auth::user()->experiences as $experience)
                  <div class="resume-post">
                    <div class="resume-post-body">
                      <div class="resume-post-date edit-experience" data-id="{{ $experience->id }}"><a href="#">{{ trans('default.edit') }} <span class="fa fa-pencil-square-o"></span></a></div>
                      <h4 class="resume-post-title">{{ $experience->company }}</h4>
                      <h5 class="resume-post-subtitle">{{ $experience->position }}
                        <div class="pull-right">
                          {{ $experience->from }} - {{ $experience->is_present ? 'Present' : $experience->to }}
                        </div>
                      </h5>
                      <div class="resume-post-cont">
                        <p>{{ $experience->description }}</p>
                      </div>
                    </div>
                  </div>
                  @can('updateExperience', $experience)
                    <form class="form-experience-update form-experience-update-{{ $experience->id }} form-horizontal mb-10 mt-20"
                    role="form" style="display: none;" method="post" data-show="false"
                    action="{{ route('account.experience.update', [App::getLocale(), $experience->id]) }}">
                      <input name="_method" type="hidden" value="PATCH">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="{{ trans('account.company_name') }}"
                        name="company" value="{{ $experience->company }}">
                        <span class="help-block"></span>
                      </div>
                      <div class="no-margin">
                        <div class="row">
                          <div class="col-md-4">
                            <div class="form-group">
                              <input type="text" class="form-control"
                              placeholder="{{ trans('account.position') }}"
                              name="position" value="{{ $experience->position }}">
                              <span class="help-block"></span>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <div class="input-group">
                                <span class="input-group-btn">
                                  <span class="btn ">{{ trans('default.from') }}</span>
                                </span>
                                <input class="form-control" type="date" name="from"
                                value="{{ $experience->from }}">
                              </div>
                              <span class="help-block"></span>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="form-group">
                              <div class="input-group">
                                <span class="input-group-btn">
                                  <span class="btn">{{ trans('default.to') }}</span>
                                </span>
                                <input class="form-control experience-to-{{ $experience->id }}" type="date" name="to"
                                {{ $experience->is_present ? 'disabled' : 'value='.$experience->to}}
                                data-id="{{ $experience->id }}">
                              </div>
                              <span class="help-block"></span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <input type="hidden" name="_wysihtml5_mode" value="1">
                        <textarea id="comment-form" class="form-control" rows="5"
                        placeholder="{{ trans('account.whats_new') }}" name="description">{{ $experience->description }}</textarea>
                        <span class="help-block"></span>
                      </div>

                      <div class="form-group no-margin no-padding">
                        <button type="submit" class="btn btn-success pull-right rounded">{{ trans('default.edit') }}</button>
                        <div class="pull-right mr-20 mt-5">
                          {{-- <div class="ckbox ckbox-theme">
                            <input class="is_present" type="checkbox" name="is_present"
                            data-id="{{ $experience->id }}" {{ $experience->is_present ? 'checked' : ''}}>
                            <label for="is_present">{{ trans('account.yet_working') }}</label>
                          </div> --}}
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" name="is_present"
                              data-type="experience"
                              data-id="{{ $experience->id }}" {{ $experience->is_present ? 'checked' : ''}}>
                              {{ trans('account.yet_working') }}
                            </label>
                          </div>
                        </div>
                      </div>
                    </form>
                  @endcan
                @endforeach

              </div>
            </div>
            <div class="col-md-3">
              <div class="resume-sidebar">
                <aside class="skill-box">
                  <h3>{{ trans('account.driver_license') }} <span class="icon-plus"><i class="fa fa-plus"></i></span></h3>

                  <div class="textwidget">
                    @foreach (Auth::user()->executant->driverLicenses as $driverLicense)
                      <div class="skill-row">
                        <h4 class="skill-title">{{ $driverLicense->title }}</h4>
                        <div class="skill-data">
                          <span style="width: 99%;" class="skill-percent-line" data-width="99"></span>
                          <span class="skill-percent">99%</span>
                        </div>
                      </div>
                    @endforeach

                  </div>
                </aside>
                <aside class="skill-box">
                  <h3>{{ trans('account.languages') }} <span class="icon-plus"><i class="fa fa-plus"></i></span></h3>

                  <div class="textwidget">
                    @foreach (Auth::user()->executant->languages as $language)
                      <aside class="skill-language">
                        <div class="skill-row clearfix">
                          <h4 class="skill-title clearfix">
                            <div class="flag flag-icon-background flag-icon-{{ $language->country_code_2 }}" title="{{ $language->title }}"></div> <span>{{ $language->title }}</span>
                            <div class="rating rating-success pull-right">
                              <span class="star"></span>
                              <span class="star active"></span>
                              <span class="star"></span>
                              <span class="star"></span>
                              <span class="star"></span>
                            </div><!-- /.rating -->
                          </h4>
                        </div>
                      </aside>
                    @endforeach
                  </div>
                </aside>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div><!-- /.body-content -->

@endsection

@section('single-scripts')

@endsection

@section('scripts')
  <script>
    (function() {
      'use strict';

      var token = '{{ Session::getToken() }}';

      $('.icon-plus.cursor').css('cursor', 'pointer');

      $('#toggle-form-study-create').click(function (e) {
        var $i = $(this).find('i');
        if ($i.attr('class') == 'fa fa-plus') {
          $i.attr('class', 'fa fa-minus');
          $('#form-study-create').slideDown('slow');
          $('#form-study-update').slideDown('slow');
        } else {
          $i.attr('class', 'fa fa-plus');
          $('#form-study-create').slideUp('slow');
          $('#form-study-update').slideUp('slow');
        }
      });

      // experience
      $('#toggle-form-experience-create').click(function (e) {
        var $i = $(this).find('i');
        if ($i.attr('class') == 'fa fa-plus') {
          $i.attr('class', 'fa fa-minus');
          $('#form-experience-create').slideDown('slow');
          $('#form-experience-update').slideDown('slow');
        } else {
          $i.attr('class', 'fa fa-plus');
          $('#form-experience-create').slideUp('slow');
          $('#form-experience-update').slideUp('slow');
        }
      });

      // checked is_present
      $('input[name="is_present"]').on('click', function (e) {
        var type = $(this).data('type');
        var id = $(this).data('id');
        var $input;

        if (type == 'study') {
          $input = $('.study-to-' + id);
          if ($(this).prop('checked')) {
            $input.prop('disabled', true);
          } else {
            $input.prop('disabled', false);
          }
        }

        if (type == 'experience') {
          $input = $('.experience-to-' + id);
          if ($(this).prop('checked')) {
            $input.prop('disabled', true);
          } else {
            $input.prop('disabled', false);
          }
        }
      });

      // form-study-create submit
      $('#form-study-create').on('submit', function (e) {
        e.preventDefault();
        var $form = $(this);
        var url = $form.attr('action');
        var $institution = $form.find('input[name="institution"]');
        var $specialization = $form.find('input[name="specialization"]');
        var $description = $form.find('textarea[name="description"]');
        var $from = $form.find('input[name="from"]');
        var $to = $form.find('input[name="to"]');
        var $is_present = $form.find('input[name="is_present"]');
        var is_present = 0;
        if ($is_present.prop('checked')) {
          var is_present = 1;
        }

        $.ajax({
          url: url,
          type: 'post',
          data: {
            // _method: 'patch',
            _token: token,
            institution: $institution.val(),
            specialization: $specialization.val(),
            description: $description.val(),
            from: $from.val(),
            to: $to.val(),
            is_present: is_present,
          },
        }).done(function (data, status, req) {
          // console.log(data);
          location.reload();
        }).fail(function (err) {
          var errors = err.responseJSON;

          $.each(errors, function (name, msg) {
            if (name == 'institution') {
              $institution.parent('div').attr('class', 'form-group has-error');
              $institution.next().text(msg[0]);
            } else if (!errors.hasOwnProperty('institution')) {
              $institution.parent('div').attr('class', 'form-group');
              $institution.next().text('');
            }

            if (name == 'specialization') {
              $specialization.parent('div').attr('class', 'form-group has-error');
              $specialization.next().text(msg[0]);
            } else if (!errors.hasOwnProperty('specialization')) {
              $specialization.parent('div').attr('class', 'form-group');
              $specialization.next().text('');
            }

            if (name == 'description') {
              $description.parent('div').attr('class', 'form-group has-error');
              $description.next().text(msg[0]);
            } else if (!errors.hasOwnProperty('description')) {
              $description.parent('div').attr('class', 'form-group');
              $description.next().text('');
            }

            if (name == 'from') {
              $from.parent('div').parent().attr('class', 'form-group has-error');
              $from.parent().next().text(msg[0]);
            } else if (!errors.hasOwnProperty('from')) {
              $from.parent('div').parent().attr('class', 'form-group');
              $from.parent().next().text('');
            }

            if (name == 'to') {
              $to.parent('div').parent().attr('class', 'form-group has-error');
              $to.parent().next().text(msg[0]);
            } else if (!errors.hasOwnProperty('to')) {
              $to.parent('div').parent().attr('class', 'form-group');
              $to.parent().next().text('');
            }
          })
        });
      });

      // form-experience-create submit
      $('#form-experience-create').on('submit', function (e) {
        e.preventDefault();
        var $form = $(this);
        var url = $form.attr('action');
        var $company = $form.find('input[name="company"]');
        var $position = $form.find('input[name="position"]');
        var $description = $form.find('textarea[name="description"]');
        var $from = $form.find('input[name="from"]');
        var $to = $form.find('input[name="to"]');
        var $is_present = $form.find('input[name="is_present"]');
        var is_present = 0;
        if ($is_present.prop('checked')) {
          var is_present = 1;
        }

        $.ajax({
          url: url,
          type: 'post',
          data: {
            // _method: 'patch',
            _token: token,
            company: $company.val(),
            position: $position.val(),
            description: $description.val(),
            from: $from.val(),
            to: $to.val(),
            is_present: is_present,
          },
        }).done(function (data, status, req) {
          // console.log(data);
          location.reload();
        }).fail(function (err) {
          var errors = err.responseJSON;

          $.each(errors, function (name, msg) {
            if (name == 'company') {
              $company.parent('div').attr('class', 'form-group has-error');
              $company.next().text(msg[0]);
            } else if (!errors.hasOwnProperty('company')) {
              $company.parent('div').attr('class', 'form-group');
              $company.next().text('');
            }

            if (name == 'position') {
              $position.parent('div').attr('class', 'form-group has-error');
              $position.next().text(msg[0]);
            } else if (!errors.hasOwnProperty('position')) {
              $position.parent('div').attr('class', 'form-group');
              $position.next().text('');
            }

            if (name == 'description') {
              $description.parent('div').attr('class', 'form-group has-error');
              $description.next().text(msg[0]);
            } else if (!errors.hasOwnProperty('description')) {
              $description.parent('div').attr('class', 'form-group');
              $description.next().text('');
            }

            if (name == 'from') {
              $from.parent('div').parent().attr('class', 'form-group has-error');
              $from.parent().next().text(msg[0]);
            } else if (!errors.hasOwnProperty('from')) {
              $from.parent('div').parent().attr('class', 'form-group');
              $from.parent().next().text('');
            }

            if (name == 'to') {
              $to.parent('div').parent().attr('class', 'form-group has-error');
              $to.parent().next().text(msg[0]);
            } else if (!errors.hasOwnProperty('to')) {
              $to.parent('div').parent().attr('class', 'form-group');
              $to.parent().next().text('');
            }
          })
        });
      });

      $('.edit-study').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var $form = $('.form-study-update-' + id);

        if ($form.data('show') == false) {
          $form.slideDown('slow');
          $form.data('show', true);
        } else {
          $form.slideUp('slow');
          $form.data('show', false);
        }
      });

      $('.edit-experience').on('click', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var $form = $('.form-experience-update-' + id);
        console.log($form.data('show'));

        if ($form.data('show') == false) {
          console.log(false);
          $form.slideDown('slow');
          $form.data('show', true);
        } else {
          console.log('else');
          $form.slideUp('slow');
          $form.data('show', false);
        }
      });

      // form-study-update submit
      $('.form-study-update').on('submit', function (e) {
        e.preventDefault();
        var $form = $(this);
        var url = $form.attr('action');
        var $institution = $form.find('input[name="institution"]');
        var $specialization = $form.find('input[name="specialization"]');
        var $description = $form.find('textarea[name="description"]');
        var $from = $form.find('input[name="from"]');
        var $to = $form.find('input[name="to"]');
        var $is_present = $form.find('input[name="is_present"]');
        var is_present = 0;
        if ($is_present.prop('checked')) {
          var is_present = 1;
        }

        $.ajax({
          url: url,
          type: 'post',
          data: {
            _method: 'patch',
            _token: token,
            institution: $institution.val(),
            specialization: $specialization.val(),
            description: $description.val(),
            from: $from.val(),
            to: $to.val(),
            is_present: is_present,
          },
        }).done(function (data, status, req) {
          // console.log(data);
          location.reload();
        }).fail(function (err) {
          var errors = err.responseJSON;

          $.each(errors, function (name, msg) {
            if (name == 'institution') {
              $institution.parent('div').attr('class', 'form-group has-error');
              $institution.next().text(msg[0]);
            } else if (!errors.hasOwnProperty('institution')) {
              $institution.parent('div').attr('class', 'form-group');
              $institution.next().text('');
            }

            if (name == 'specialization') {
              $specialization.parent('div').attr('class', 'form-group has-error');
              $specialization.next().text(msg[0]);
            } else if (!errors.hasOwnProperty('specialization')) {
              $specialization.parent('div').attr('class', 'form-group');
              $specialization.next().text('');
            }

            if (name == 'description') {
              $description.parent('div').attr('class', 'form-group has-error');
              $description.next().text(msg[0]);
            } else if (!errors.hasOwnProperty('description')) {
              $description.parent('div').attr('class', 'form-group');
              $description.next().text('');
            }

            if (name == 'from') {
              $from.parent('div').parent().attr('class', 'form-group has-error');
              $from.parent().next().text(msg[0]);
            } else if (!errors.hasOwnProperty('from')) {
              $from.parent('div').parent().attr('class', 'form-group');
              $from.parent().next().text('');
            }

            if (name == 'to') {
              $to.parent('div').parent().attr('class', 'form-group has-error');
              $to.parent().next().text(msg[0]);
            } else if (!errors.hasOwnProperty('to')) {
              $to.parent('div').parent().attr('class', 'form-group');
              $to.parent().next().text('');
            }
          })
        });
      });

      // form-experience-update submit
      $('.form-experience-update').on('submit', function (e) {
        e.preventDefault();

        var $form = $(this);
        var url = $form.attr('action');
        var $company = $form.find('input[name="company"]');
        var $position = $form.find('input[name="position"]');
        var $description = $form.find('textarea[name="description"]');
        var $from = $form.find('input[name="from"]');
        var $to = $form.find('input[name="to"]');
        var $is_present = $form.find('input[name="is_present"]');
        var is_present = 0;
        if ($is_present.prop('checked')) {
          var is_present = 1;
        }

        $.ajax({
          url: url,
          type: 'post',
          data: {
            _method: 'patch',
            _token: token,
            company: $company.val(),
            position: $position.val(),
            description: $description.val(),
            from: $from.val(),
            to: $to.val(),
            is_present: is_present,
          },
        }).done(function (data, status, req) {
          // console.log(data);
          location.reload();
        }).fail(function (err) {
          var errors = err.responseJSON;

          $.each(errors, function (name, msg) {
            if (name == 'company') {
              $company.parent('div').attr('class', 'form-group has-error');
              $company.next().text(msg[0]);
            } else if (!errors.hasOwnProperty('company')) {
              $company.parent('div').attr('class', 'form-group');
              $company.next().text('');
            }

            if (name == 'position') {
              $position.parent('div').attr('class', 'form-group has-error');
              $position.next().text(msg[0]);
            } else if (!errors.hasOwnProperty('position')) {
              $position.parent('div').attr('class', 'form-group');
              $position.next().text('');
            }

            if (name == 'description') {
              $description.parent('div').attr('class', 'form-group has-error');
              $description.next().text(msg[0]);
            } else if (!errors.hasOwnProperty('description')) {
              $description.parent('div').attr('class', 'form-group');
              $description.next().text('');
            }

            if (name == 'from') {
              $from.parent('div').parent().attr('class', 'form-group has-error');
              $from.parent().next().text(msg[0]);
            } else if (!errors.hasOwnProperty('from')) {
              $from.parent('div').parent().attr('class', 'form-group');
              $from.parent().next().text('');
            }

            if (name == 'to') {
              $to.parent('div').parent().attr('class', 'form-group has-error');
              $to.parent().next().text(msg[0]);
            } else if (!errors.hasOwnProperty('to')) {
              $to.parent('div').parent().attr('class', 'form-group');
              $to.parent().next().text('');
            }
          })
        });
      });
    }());
  </script>
@endsection
