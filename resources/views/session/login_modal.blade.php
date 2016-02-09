<div class="modal modal-teal fade" tabindex="-1" role="dialog" id="login">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ trans('auth.login') }}</h4>
            </div>
            <div class="modal-body">
                <form id="form-login" class="form-horizontal" role="form" method="POST" action="/{{ App::getLocale() }}/auth/login">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label class="col-md-4 control-label" for="email">E-Mail</label>
                    <div class="col-md-6">
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" id="email">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label" for="password">{{ trans('auth.password') }}</label>
                    <div class="col-md-6">
                        <input type="password" class="form-control" name="password" id="password">

                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4 col-sm-6 col-sm-offset-4 col-xs-12">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember"> {{ trans('auth.remember') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button id="submit-login" type="submit" class="btn btn-teal" style="margin-right: 15px;" data-csrf="{{ csrf_token() }}" data-locale="{{ App::getLocale() }}">
                            {{ trans('auth.login') }}
                        </button>

                        <a href="/{{ App::getLocale() }}/password/email">{{ trans('auth.forgot_password') }}</a>
                    </div>
                </div>
            </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
    $(document).ready(function () {
        'use strict';

        $('#form-login').on('submit', function (e) {
            e.preventDefault();

            var ctx = $(this);
            var button = $(this).find('button')
            var token = button.data('csrf');
            var locale = button.data('locale');

            var emailInput = $(this).find('input[name="email"]');
            var passwordInput = $(this).find('input[name="password"]');
            var rememberInput = $(this).find('input[name="remember"]');
            var email = emailInput.val();
            var password = passwordInput.val();

            $.ajax({
                url: '/' + locale + '/auth/login',
                method: 'post',
                data: {
                    email: email,
                    password: password,
                    remember: rememberInput.prop('checked') ? true : null,
                    _token: token
                },
            }).done(function (data, status, req) {
                window.location.href = data.url;
            }).fail(function (err) {
                if (err.status == 422) {
                    $.each(err.responseJSON, function (key, value) {
                        var spanError = $('<span>', {text: value[0], class: 'help-block'});
                        var input = ctx.find('input[name="' + key + '"]');

                        if (!input.parent().parent().hasClass('has-error')) {
                            input.parent().parent().addClass('has-error');
                            spanError.insertAfter(input);
                        } else {
                            input.next().remove();
                            spanError.insertAfter(input);
                            $.each(ctx.find('.has-error input'), function (k, v) {
                                var self = $(this);
                                if (self.attr('name') != key) {
                                    self.parent().parent().removeClass('has-error');
                                    self.next().remove();
                                }
                            });
                        }
                    });
                }
            });
        });
    }());
</script>
