<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Category;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories_list = Category::lists('title', 'id');
        $categories_list[''] = 'Пожалуйста выберите';

        $categoriesCount = Category::count();
        $categoriesCount += 1;
        $visible_list = [1 => 'Да', 0 =>'Нет'];

        return view('admin.categories.create',
            compact('categoriesCount', 'categories_list', 'categoriesCount', 'visible_list'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\Admin\CategoryRequest $request)
    {
        if ($request->parent_id == '') {
            $r = $request->all();
            $r['parent_id'] = null;
            Category::create($r);
        } else {
            Category::create($request->all());
        }
        return redirect('admin/categories')
            ->with('flash_success', 'Категория успешно создана.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        $categories_list = Category::where('id', '!=', $id)
            ->lists('title', 'id');
        $categories_list[''] = 'Пожалуйста выберите';

        $visible_list = [1 => 'Да', 0 =>'Нет'];

        return view('admin.categories.edit',
            compact('category', 'categories_list', 'visible_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\Admin\CategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        if ($request->parent_id == '') {
            $r = $request->all();
            $r['parent_id'] = null;
            $category->update($r);
        } else {
            $category->update($request->all());
        }

        return redirect('admin/categories')
            ->with('flash_success', 'Категория успешно обновлена.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect('admin/categories')
            ->with('flash_success', 'Категория успешно удалена.');
    }
}
