<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App;
use App\Http\Requests;
use App\Image;
use App\Album;

class ImagesController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

/**
 * Store a newly created resource in storage.
 *
 * @param \Illuminate\Http\Request $request
 *
 * @return \Illuminate\Http\Response
 */
    public function store(Request $request, $lang, $id)
    {
        if ($request->ajax()) {
            $album = Album::findOrFail($id);
            $this->authorize('update', $album);

            $album = Album::find($id);
            $image = $request->image;
            $imagesCount = $album->images->count();
            $rules = ['image' => 'required|image|max:20000'];
            $validator = Validator::make(['image' => $image], $rules);
            if ($validator->passes()) {
                if ($imagesCount >= 10) {
                    return response()->make([
                        'message' => trans('images.flash_info_created'),
                        'type' => 'count',
                    ], 400);
                    // return redirect()->back()
                    //     ->with('flash_info', trans('images.flash_info_created'));
                    // return redirect(App::getLocale().'/albums/'.$id)
                    // ->with('flash_info', trans('images.flash_info_created'));
                }
                $imageExt = $image->getClientOriginalExtension();
                $model = new Image();
                $model->album_id = $id;
                $model->name = $imageExt;
                $model->save();
                $imageName = $model->id.'.'.$imageExt;
                $model->name = $imageName;
                $model->save();
                $destinationPath = base_path().config('app.uploads_albums_path');
                $image->move(
                    $destinationPath.'/'.$id,
                    $imageName
                );
                if ($album->images->isEmpty()) {
                    $album->image_id = $model->id;
                    $album->save();
                }
            } else {
                return response()->make([
                    'message' => $validator->errors()->first(),
                    'type' => 'validation'
                ], 400);
                // return redirect()->back()->withInput()->withErrors($validator);

            }
            return response()->json('success', 200);
        }

        // Without ajax
        // $album = Album::findOrFail($id);
        // $this->authorize('update', $album);
        // $images = $request->images;
        //
        // foreach ($images as $image) {
        //     $album = Album::find($id);
        //     $imagesCount = $album->images->count();
        //     $rules = ['image' => 'required|image|max:20000'];
        //     $validator = Validator::make(['image' => $image], $rules);
        //     if ($validator->passes()) {
        //         if ($imagesCount >= 10) {
        //             // return redirect()->back()
        //             //     ->with('flash_info', trans('images.flash_info_created'));
        //             return redirect(App::getLocale().'/albums/'.$id)
        //                 ->with('flash_info', trans('images.flash_info_created'));
        //         }
        //         $imageExt = $image->getClientOriginalExtension();
        //         $model = new Image();
        //         $model->album_id = $id;
        //         $model->name = $imageExt;
        //         $model->save();
        //         $imageName = $model->id.'.'.$imageExt;
        //         $model->name = $imageName;
        //         $model->save();
        //         $destinationPath = base_path().config('app.uploads_albums_path');
        //         $image->move(
        //             $destinationPath.'/'.$id,
        //             $imageName
        //         );
        //         if ($album->images->isEmpty()) {
        //             $album->image_id = $model->id;
        //             $album->save();
        //         }
        //     } else {
        //         return redirect()->back()->withInput()->withErrors($validator);
        //         // return redirect(App::getLocale().'/account/album/'.$id)
        //         //     ->withInput()->withErrors($validator);
        //     }
        // }
        // return redirect()->back();
        // // return redirect(App::getLocale().'/account/album/'.$id)
        // //     ->with('flash_success', trans('images.flash_success_created'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\ImageRequest $request, $lang, $albumId, $id)
    {
        if ($request->ajax()) {
            $image = Image::findOrFail($id);
            $album = Album::findOrFail($albumId);
            $this->authorize('update', $album);
            $image->update($request->all());

            return response()->json('success', 200);
        }
        $image = Image::findOrFail($id);
        $album = Album::findOrFail($albumId);
        $this->authorize('update', $album);
        $image->update($request->all());

        return redirect()->back();
        // return redirect(App::getLocale().'/account/album/'.$albumId)
        //     ->with('flash_success', trans('images.flash_success_updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($lang, $albumId, $id)
    {
        $image = Image::findOrFail($id);
        $album = Album::findOrFail($albumId);
        $this->authorize('destroy', $album);
        $image->delete();
        $albumsDir = base_path().config('app.uploads_albums_path').'/'.$image->album->id;
        if (file_exists($albumsDir.'/'.$image->name)) {
            unlink(realpath($albumsDir.'/'.$image->name));
        }
        return redirect()->back();
        // return redirect(App::getLocale().'/account/album/'.$albumId)
        //     ->with('flash_success', trans('images.flash_success_deleted'));
    }
}
