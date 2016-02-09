<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

use App;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Role;
use App\Task;
use App\Events\UserHasRegistered;


class SessionController extends Controller
{
    // use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    // protected $redirectTo = '/';

    public function __construct()
    {
        // $this->middleware('lang', ['except' => 'getLogout']);
        $this->middleware('lang');
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function getRegister()
    {
        $rawRoles = Role::where('name', '!=', 'admin')
            ->where('name', '!=', 'moderator')
            ->lists('name', 'id')
            ->toArray();
        $roles = [];
        foreach ($rawRoles as $key => $value) {
            $roles[$key] = trans('roles.' . $value);
        }

        $gender_list = [trans('auth.female'), trans('auth.male')];

        return view('session.register', compact('roles', 'gender_list'));
    }

    public function postRegister(Requests\SessionRegisterRequest $request)
    {
        $input = $request->all();
        // TODO: captcha
        $input['password'] = bcrypt($input['password']);
        $input['activation_token'] = bin2hex(openssl_random_pseudo_bytes(32));
        $user = User::create($input);
        $user->activation_token = $input['activation_token'];
        $user->save();

        \Mail::send('emails.email_verification',
            ['token' => $user->activation_token, 'id' => $user->id], function ($message) use ($input) {
            $message->to($input['email'], $input['name'])->subject(trans('auth.account_activation'));
            // $message->to('bob@email.com', 'Bob')->from('local@jost.com')->subject('Привет!');
        });

        event(new UserHasRegistered($user, 1));

        return redirect('/' . App::getLocale())
            ->with('flash_info', trans('auth.register_send_email_verification'));
    }

    public function getLogin()
    {
        return view('session.login');
    }

    public function postLogin(Requests\SessionLoginRequest $request)
    // public function postLogin(Request $request)
    {
        if ($request->ajax()) {
            $remember = $request->remember;
            if (Auth::attempt([
                'email' => $request->email,
                'password' => $request->password,
                'email_confirm' => true,
            ], $remember)) {
                return ['url' => \URL::previous()];
            } else {
                // return ['name' => 'error'];
                return response()->json(['email' => [trans('auth.login_validation')]], 422);
            }
        } else {
            $remember = $request->remember;
            if (Auth::attempt([
                    'email' => $request->email,
                    'password' => $request->password,
                    'email_confirm' => true,
                ], $remember)) {
                return redirect()->intended('/' . App::getLocale());
            } else {

                return redirect(App::getLocale() . '/auth/login')
                    ->with('flash_info', trans('auth.login_validation'))
                    ->withInput();
            }
        }

    }

    public function getLogout()
    {
        Auth::logout();
        return redirect('/' . App::getLocale());
    }

    public function getEmailVerification($lang, $token, $id)
    {
        $user = User::findOrFail($id);
        if ($user->activation_token == $token) {
            $user->email_confirm = true;
            if (User::where('email_confirm', true)->get()->count() <= 1000) {
                $user->count = 19;
            }
            $user->save();
            $tasks = Task::where('email', $user->email)->where('is_visible', false)->get();

            if (!$tasks->isEmpty()) {
                foreach ($tasks as $task) {
                    $task->is_visible = true;
                    $task->user_customer_id = $user->id;
                    $task->save();
                }
            }

            event(new UserHasRegistered($user, 2));

            return redirect(App::getLocale() . '/auth/login')
                ->with('flash_success', trans('auth.email_verification_success'));
        } else {
            return redirect('/')
                ->with('flash_danger', trans('auth.email_verification_error'));
        }

    }

}
