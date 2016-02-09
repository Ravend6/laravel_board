<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Language;
use App\Executant;
use App\User;
use App\Category;
use App\Study;
use App\Experience;
use App\DriverLicense;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('lang');
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('indexAccount', \Auth::user());

        return view('account.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('createAccount', \Auth::user());

        $languages = Language::lists('title', 'id');
        $category_list = Category::where('is_visible', true)->lists('title', 'id');
        // $driver_license_list = DriverLicense::lists('title', 'id');
        $categories = Category::where('is_visible', true)->get();
        $driver_licenses = DriverLicense::lists('title', 'id');

        return view('account.create',
            compact('languages', 'category_list', 'categories', 'driver_licenses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\AccountRequest $request)
    {
        $this->authorize('createAccount', \Auth::user());

        $executant = \Auth::user()->executant()->save(new Executant($request->all()));
        $executant->languages()->attach($request->input('language_list'));
        $executant->driverLicenses()->attach($request->input('driver_license_list'));

        return redirect(App::getLocale().'/account')
            ->with('flash_success', 'Профайл успешно создан.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return view('account.show');
    }

    public function edit($lang)
    {
        $this->authorize('editAccount', \Auth::user());

        $languages = Language::lists('title', 'id');
        $categories = Category::where('is_visible', true)->get();
        $driver_licenses = DriverLicense::lists('title', 'id');

        return view('account.edit', compact('languages', 'categories', 'driver_licenses'));
    }


    public function update(Requests\AccountRequest $request, $lang)
    {
        $this->authorize('editAccount', \Auth::user());

        $executant = \Auth::user()->executant;
        $executant->update($request->all());
        $executant->languages()->sync($request->input('language_list'));
        $executant->driverLicenses()->sync($request->input('driver_license_list'));

        return redirect(App::getLocale().'/account')
            ->with('flash_success', 'Профайл успешно обновлен.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // Avatar
    public function createAvatar()
    {
        return view('account.avatar');
    }

    public function storeAvatar(Request $request)
    {
        $rules = ['avatar' => 'image|max:20000'];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->make($validator->errors()->first(), 400);
        }

        $destinationPath = base_path().config('app.uploads_avatars_path');
        $user = \Auth::user();

        // delete avatar
        $avatar = $destinationPath.'/'.$user->id.'/'.$user->avatar;
        if (file_exists($avatar)) {
            unlink($avatar);
        }

        $avatarExt = $request->avatar->getClientOriginalExtension();
        $avatarName = $user->id.'.'.$avatarExt;
        $user->avatar = $avatarName;
        $user->save();

        $isUploaded = $request->avatar->move(
            $destinationPath.'/'.$user->id,
            $avatarName
        );

        if ($isUploaded) {
            return response()->json('success', 200);
        } else {
            return response()->json('error', 400);
        }
        // $rules = ['avatar' => 'required|image|max:1000'];
        // $validator = Validator::make(['avatar' => $request->avatar], $rules);
        // if ($validator->passes()) {
        //     $destinationPath = base_path().config('app.uploads_avatars_path');
        //     $user = \Auth::user();
        //
        //     // delete avatar
        //     $avatar = $destinationPath.'/'.$user->id.'/'.$user->avatar;
        //     if (file_exists($avatar)) {
        //         unlink($avatar);
        //     }
        //
        //     $avatarExt = $request->avatar->getClientOriginalExtension();
        //     $avatarName = $user->id.'.'.$avatarExt;
        //     $user->avatar = $avatarName;
        //     $user->save();
        //
        //     $request->avatar->move(
        //         $destinationPath.'/'.$user->id,
        //         $avatarName
        //     );
        // } else {
        //     return redirect($request->lang.'/account/avatar/create')
        //         ->withInput()->withErrors($validator);
        // }
        // return redirect('/'.$request->lang.'/account/avatar/create')
        //     ->with('flash_success', trans('account.flash_success_store_avatar'));

    }

    public function destroyAvatar(Request $request)
    {
        // $this->authorize('accountActions', \Auth::user());
        if ($request->ajax()) {
            $user = \Auth::user();
            if ($user->avatar) {
                $user->avatar = null;
                $user->save();

                $avatarsDir = base_path().config('app.uploads_avatars_path').'/'.$user->id;
                if (is_dir($avatarsDir)) {
                    system("rm -rf ".escapeshellarg($avatarsDir));
                }
            }

            return response()->json('success', 200);
        }

        $user = \Auth::user();
        $user->avatar = null;
        $user->save();

        $avatarsDir = base_path().config('app.uploads_avatars_path').'/'.$user->id;
        if (is_dir($avatarsDir)) {
            system("rm -rf ".escapeshellarg($avatarsDir));
        }
        // if (file_exists($avatarsDir.'/'.$user->avatar)) {
        //     unlink(realpath($avatarsDir.'/'.$user->avatar));
        // }
        return redirect('/'.$request->lang.'/account/avatar/create')
            ->with('flash_success', trans('account.flash_success_destroy_avatar'));
    }

    public function storeStudy(Requests\StudyRequest $request, $lang)
    {
        if ($request->ajax()) {
            $this->authorize('createStudy', \Auth::user());

            $input = $request->all();
            if (isset($input['is_present']) and $input['is_present']) {
                $input['is_present'] = 1;
            }
            \Auth::user()->studies()->save(new Study($input));

            return response()->json('success', 200);
        }

        return redirect()->back();
    }

    public function updateStudy(Requests\StudyRequest $request, $lang, $studyId)
    {
        $study = Study::findOrFail($studyId);

        if ($request->ajax()) {
            $this->authorize('updateStudy', $study);

            $input = $request->all();
            if (isset($input['is_present']) and $input['is_present']) {
                $input['is_present'] = 1;
            }
            $study->update($input);

            return response()->json('success', 200);
        }

        return redirect()->back();
    }

    public function storeExperience(Requests\ExperienceRequest $request, $lang)
    {
        if ($request->ajax()) {
            $this->authorize('createExperience', \Auth::user());

            $input = $request->all();
            if (isset($input['is_present']) and $input['is_present']) {
                $input['is_present'] = 1;
            }
            \Auth::user()->experiences()->save(new Experience($input));

            return response()->json('success', 200);
        }

        return redirect()->back();
    }

    public function updateExperience(Requests\ExperienceRequest $request, $lang, $experienceId)
    {
        $experience = Experience::findOrFail($experienceId);

        if ($request->ajax()) {
            $this->authorize('updateExperience', $experience);

            $input = $request->all();
            if (isset($input['is_present']) and $input['is_present']) {
                $input['is_present'] = 1;
            }
            $experience->update($input);

            return response()->json('success', 200);
        }

        return redirect()->back();
    }
}
