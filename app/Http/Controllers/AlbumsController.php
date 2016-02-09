<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Album;
use Gate;

class AlbumsController extends Controller
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
        return view('albums.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->checkCountAlbums();

        return view('albums.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\AlbumRequest $request)
    {
        $this->checkCountAlbums();

        \Auth::user()->albums()->save(new Album($request->all()));

        return redirect(App::getLocale().'/account/gallery/album')
            ->with('flash_success', trans('albums.flash_success_created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($lang, $id)
    {
        $album = Album::findOrFail($id);
        $this->authorize('update', $album);

        return view('albums.show', compact('album'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($lang, $id)
    {
        $album = Album::findOrFail($id);
        $this->authorize('update', $album);
        // if (Gate::denies('update', $album)) {
        //     abort(403, trans('messages.403'));
        // }

        return view('albums.edit', compact('album'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\AlbumRequest $request, $lang, $id)
    {
        $album = Album::findOrFail($id);
        $this->authorize('update', $album);
        $album->update($request->all());

        return redirect()->back();
        // return redirect(App::getLocale().'/account/gallery/album')
        //     ->with('flash_success', trans('albums.flash_success_updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($lang, $id)
    {
        $album = Album::findOrFail($id);
        $this->authorize('destroy', $album);
        $album->delete();

        $albumsDir = base_path().config('app.uploads_albums_path').'/'.$album->id;
        if (is_dir($albumsDir)) {
            system("rm -rf ".escapeshellarg($albumsDir));
        }

        return redirect(App::getLocale().'/account/gallery/album')
            ->with('flash_success', trans('albums.flash_success_deleted'));
    }

    public function updateImage(Request $request, $lang, $id)
    {
        $album = Album::findOrFail($id);
        $this->authorize('update', $album);
        $album->update($request->all());
        
        return response()->json('success', 200);
    }

    private function checkCountAlbums()
    {
        if (\Auth::user()->albums->count() >= 3) {
            abort(403);
        }
    }
}
