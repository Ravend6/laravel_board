$(document).ready(function(){

    var myApp = new Framework7({
        pushState: true,
        swipePanel: 'left',
        swipePanelThreshold: '20',
        swipePanelCloseOpposite: 'true'
    });

    myApp.swiper('#album-view', {
        direction: 'vertical',
        lazyLoading: true,
        preloadImages: false,
        pagination: '.swiper-pagination',
        paginationHide: false,
        paginationClickable: true,
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev'
    });

    var $$ = Dom7;

    // Notifier
    var notify = $('#flash-notify');
    // var li = notify.find('li');
    if (notify.length > 0) notify.hide();
    var p = notify.find('p');
    if (p.text()) {
      myApp.addNotification({
        title: p.text(),
        // message: p.text()
      });
    }

    //$('.open-panel').on('click', function (e) {
    //    _panelVisible = $('.panel-left').hasClass('active');
    //    if (_panelVisible) {
    //        myApp.closePanel();
    //    }
    //});

    //$('.page').on('click', function (e) {
    //    myApp.closePanel();
    //});

    $$('#login').on('click', function () {
        var token = $(this).data('csrf');
        myApp.modalLogin(null, 'Авторизация', function (email, password) {
            myApp.showPreloader('Авторизация');
            setTimeout(function () {
                $.ajax({
                    url: '/ru/auth/login',
                    method: 'post',
                    data: {
                        email: email,
                        password: password,
                        _token: token
                   },
                }).done(function (data, status, req) {
                    console.log(data);
                    myApp.alert('Приветствуем, ' + data.name + '. Вы успешно вошли!');
                    setTimeout(function () {
                        location.reload();
                    }, 1600);
                }).fail(function (err) {
                    if (err.status == 422) {
                        $.each(err.responseJSON, function (key, value) {
                            var message = '';
                            value.forEach(function (msg) {
                               message += msg;
                            });
                            myApp.addNotification({
                              title: message,
                            });
                        });
                    }
                });
                myApp.hidePreloader();
            }, 2000);
        });
    });

    $$('#logout').on('click', function () {
        myApp.confirm('Вы действительно хотите выйти?', null, function () {
            myApp.showPreloader('Выход...');
            setTimeout(function () {
                $.ajax({
                    url: 'ru/auth/logout',
                    method: 'get'
                }).done(function (data, status, req) {
                    location.reload();
                }).fail(function (err) {
                    location.reload();
                });
                myApp.hidePreloader();
            }, 2000);
        });
    });

    $$('#accept').on('click', function () {
        myApp.showPreloader('Отправка данных...');
        setTimeout(function () {
            myApp.hidePreloader();
            myApp.alert(null, 'Данные успешно отправлены!');
        }, 2000);
    });

    ///////////// Album page

    var _navbarHide = function ($elem){
        $elem.on('click', function () {
            var _navbar = $('.navbar');
            _navbarHidden = _navbar.hasClass('navbar-hidden');
            if (!_navbarHidden) {
                myApp.hideNavbar(_navbar);

            } else {
                myApp.showNavbar(_navbar);
            }
        });

    };
    _navbarHide($$('#album-view'));

    var _openPoupup = function($selector, $popup) {

        $$($selector).on('click', function () {
            myApp.popup($popup);
        });

        $$('#filter-accept').on('click', function () {
            myApp.showPreloader('Применение фильтра...');
            setTimeout(function () {
                myApp.hidePreloader();
                myApp.closeModal($popup);
            }, 2000);
        });
    };

    _openPoupup('.open-board-filter', '.popup-board-filter');
    _openPoupup('.open-quick-menu', '.popup-quick-menu');
    _openPoupup('.open-exec-filter', '.popup-exec-filter');
    _openPoupup('.open-gallery-filter', '.popup-gallery-filter');
    _openPoupup('.open-task-offer', '.popup-task-offer');
    _openPoupup('.open-reviews', '.popup-reviews');
    _openPoupup('.open-count', '.popup-count');

});

