<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Authentication routes...
// Route::get('auth/login', 'Auth\AuthController@getLogin');
// Route::post('auth/login', 'Auth\AuthController@postLogin');
// Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
// Route::get('auth/register', 'Auth\AuthController@getRegister');
// Route::post('auth/register', 'Auth\AuthController@postRegister');

// Auth
Route::get('{lang}/auth/register',
    ['as' => 'register', 'uses' => 'SessionController@getRegister']);
Route::post('{lang}/auth/register',
    ['as' => 'register.store', 'uses' => 'SessionController@postRegister']);
Route::get('{lang}/auth/logout', 'SessionController@getLogout');
Route::get('{lang}/auth/login',
    ['as' => 'login', 'uses' => 'SessionController@getLogin']);
Route::post('{lang}/auth/login',
    ['as' => 'login.store', 'uses' => 'SessionController@postLogin']);

// Email verification
Route::get('{lang}/email/verification/{token}/{id}',
    ['as' => 'email.verification', 'uses' => 'SessionController@getEmailVerification']);

// Password reset link request routes...
Route::get('{lang}/password/email', 'Auth\PasswordController@getEmail');
Route::post('{lang}/password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('{lang}/password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('{lang}/password/reset', 'Auth\PasswordController@postReset');

// // Password reset link request routes...
// Route::get('password/email', 'Auth\PasswordController@getEmail');
// Route::post('password/email', 'Auth\PasswordController@postEmail');

// // Password reset routes...
// Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
// Route::post('password/reset', 'Auth\PasswordController@postReset');


// Admin
Route::group(['prefix' => 'admin'], function () {
    // Main
    Route::get('/',
        ['as' => 'admin.index', 'uses' => 'PagesController@getAdmin']);
    Route::resource('categories', 'Admin\CategoriesController');
    Route::resource('languages', 'Admin\LanguagesController');
    Route::resource('driver_licenses', 'Admin\DriverLicensesController');
    Route::resource('log', 'Admin\LogController');
});

// Pages routes
Route::get('/',
    ['as' => 'index', 'uses' => 'PagesController@getIndex']);
Route::get('/{lang}',
    ['as' => 'index.lang', 'uses' => 'PagesController@getIndexLang']);
Route::get('/{lang}/board',
    ['as' => 'board.index', 'uses' => 'PagesController@getBoard']);
Route::get('/{lang}/rules',
    ['as' => 'rules.index', 'uses' => 'PagesController@getRules']);
Route::get('/{lang}/instructions',
    ['as' => 'instructions.index', 'uses' => 'PagesController@getInstructions']);
Route::get('/{lang}/faq',
    ['as' => 'faq.index', 'uses' => 'PagesController@getFaq']);
Route::get('/{lang}/about',
    ['as' => 'about.index', 'uses' => 'PagesController@getAbout']);
Route::get('/{lang}/contact-us',
    ['as' => 'contact-us.index', 'uses' => 'PagesController@getContactUs']);
Route::get('/{lang}/partnership',
    ['as' => 'partnership.index', 'uses' => 'PagesController@getPartnership']);

// Tasks
// Route::get('{lang}/tasks',
//     ['as' => 'tasks.index', 'uses' => 'TasksController@index']);
Route::get('{lang}/task/create',
    ['as' => 'task.create', 'uses' => 'TasksController@create']);
Route::post('{lang}/task',
    ['as' => 'task.store', 'uses' => 'TasksController@store']);
Route::get('{lang}/task/{task}',
    ['as' => 'task.show', 'uses' => 'TasksController@show']);
Route::post('{lang}/task/deal/{task}/{user}/{proposition}',
    ['as' => 'task.deal.store', 'uses' => 'TasksController@storeDeal']);
// Route::patch('{lang}/task/deal/{task}/{user}/{proposition}/{answer}',
//     ['as' => 'task.deal.update', 'uses' => 'TasksController@updateDeal']);
Route::get('{lang}/task/accepted',
    ['as' => 'task.accepted.index', 'uses' => 'TasksController@indexAccepted']);

// Messages
// Deal messages
Route::get('{lang}/message/deal',
    ['as' => 'message.deal.index', 'uses' => 'MessageController@indexDeal']);
Route::get('{lang}/message/deal/{deal}',
    ['as' => 'message.deal.show', 'uses' => 'MessageController@showDeal']);
Route::get('{lang}/message/task',
    ['as' => 'message.task.index', 'uses' => 'MessageController@indexTask']);

// Account
Route::get('{lang}/account',
    ['as' => 'account.index', 'uses' => 'AccountController@index']);
Route::get('{lang}/account/create',
    ['as' => 'account.create', 'uses' => 'AccountController@create']);
Route::post('{lang}/account',
    ['as' => 'account.store', 'uses' => 'AccountController@store']);
Route::get('{lang}/account/edit',
    ['as' => 'account.edit', 'uses' => 'AccountController@edit']);
Route::patch('{lang}/account',
    ['as' => 'account.update', 'uses' => 'AccountController@update']);
Route::get('{lang}/account/avatar/create',
    ['as' => 'account.avatar.create', 'uses' => 'AccountController@createAvatar']);
Route::post('{lang}/account/avatar',
    ['as' => 'account.avatar.store', 'uses' => 'AccountController@storeAvatar']);
Route::delete('{lang}/account/avatar',
    ['as' => 'account.avatar.destroy', 'uses' => 'AccountController@destroyAvatar']);
Route::post('{lang}/account/study',
    ['as' => 'account.study.store', 'uses' => 'AccountController@storeStudy']);
Route::patch('{lang}/account/study/{study}',
    ['as' => 'account.study.update', 'uses' => 'AccountController@updateStudy']);
Route::post('{lang}/account/experience',
    ['as' => 'account.experience.store', 'uses' => 'AccountController@storeExperience']);
Route::patch('{lang}/account/experience/{experience}',
    ['as' => 'account.experience.update', 'uses' => 'AccountController@updateExperience']);


// Albums
Route::get('{lang}/account/gallery/album',
    ['as' => 'album.index', 'uses' => 'AlbumsController@index']);
Route::get('{lang}/account/album/create',
    ['as' => 'album.create', 'uses' => 'AlbumsController@create']);
Route::post('{lang}/account/album',
    ['as' => 'album.store', 'uses' => 'AlbumsController@store']);
Route::get('{lang}/account/album/{album}',
    ['as' => 'album.show', 'uses' => 'AlbumsController@show']);
Route::get('{lang}/account/album/{album}/edit',
    ['as' => 'album.edit', 'uses' => 'AlbumsController@edit']);
Route::patch('{lang}/account/album/{album}',
    ['as' => 'album.update', 'uses' => 'AlbumsController@update']);
Route::delete('{lang}/account/album/{album}',
    ['as' => 'album.destroy', 'uses' => 'AlbumsController@destroy']);
Route::patch('{lang}/account/album/image/{album}',
    ['as' => 'album.image.update', 'uses' => 'AlbumsController@updateImage']);

// Proposition
Route::post('{lang}/proposition',
    ['as' => 'proposition.store', 'uses' => 'PropositionController@store']);

// Profile
Route::get('{lang}/profile/{profile}',
    ['as' => 'profile.show', 'uses' => 'ProfileController@show']);

// Images
// Route::get('{lang}/images/{albums}',
//     ['as' => 'images.index', 'uses' => 'ImagesController@index']);
// Route::get('{lang}/images/{albums}/create',
//     ['as' => 'images.create', 'uses' => 'ImagesController@create']);
Route::post('{lang}/images/{albums}',
    ['as' => 'images.store', 'uses' => 'ImagesController@store']);
// Route::get('{lang}/images/{albums}/{images}/edit',
//     ['as' => 'images.edit', 'uses' => 'ImagesController@edit']);
Route::patch('{lang}/images/{albums}/{images}',
    ['as' => 'images.update', 'uses' => 'ImagesController@update']);
Route::delete('{lang}/images/{albums}/{images}',
    ['as' => 'images.destroy', 'uses' => 'ImagesController@destroy']);



    // Route::get('{lang}/test',
    //     ['as' => 'test.index', 'uses' => 'TasksController@test']);
