<?php

use App\Lib\Message;
use App\User;

if (!function_exists('delete_to_route')) {
    function delete_to_route($params) {
        $form = Form::open(['route' => $params, 'method' => 'delete']);
        $form .= Form::submit('Удалить', [
            'class' => 'btn btn-danger btn-sm',
            'onclick' => 'return confirm("Вы действительно хотите удалить?");']);
        $form .= Form::close();
        return $form;
    }
}

if (!function_exists('delete_to_route_with_lang')) {
    function delete_to_route_with_lang($params) {
        $form = Form::open(['route' => $params, 'method' => 'delete']);
        $form .= Form::submit(trans('default.delete'), [
            'class' => 'btn btn-danger btn-sm',
            'onclick' => 'return confirm("' . trans('messages.delete_confirm') .'");']);
        $form .= Form::close();
        return $form;
    }
}

if (!function_exists('is_executor_role')) {
    function is_executor_role(User $user) {
        return $user->role->name == 'executor';
    }
}

if (!function_exists('is_customer_role')) {
    function is_customer_role(User $user) {
        return $user->role->name == 'customer';
    }
}

if (!function_exists('is_moderator_role')) {
    function is_moderator_role(User $user) {
        return $user->role->name == 'moderator';
    }
}

if (!function_exists('is_admin_role')) {
    function is_admin_role(User $user) {
        return $user->role->name == 'admin';
    }
}

// if (!function_exists('lang_check')) {
//     function lang_check($lang) {
//         if (in_array($lang, config('app.list_locales'))) {
//             if ($lang == \App::getLocale()) return;
//             \App::setLocale($lang);
//         } else {
//             abort(404);
//         }
//     }
// }
