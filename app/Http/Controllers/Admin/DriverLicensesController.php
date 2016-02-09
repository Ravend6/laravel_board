<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\DriverLicense;

class DriverLicensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $driver_licenses = DriverLicense::orderBy('id', 'asc')->get();

        return view('admin.driver_licenses.index', compact('driver_licenses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.driver_licenses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\Admin\DriverLicenseRequest $request)
    {
        DriverLicense::create($request->all());

        return redirect('admin/driver_licenses')
            ->with('flash_success', 'Водительские права успешно созданы.');
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
        $driver_license = DriverLicense::findOrFail($id);

        return view('admin.driver_licenses.edit', compact('driver_license'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\Admin\DriverLicenseRequest $request, $id)
    {
        $driver_license = DriverLicense::findOrFail($id);

        $driver_license->update($request->all());

        return redirect('admin/driver_licenses')
            ->with('flash_success', 'Водительские права успешно обновлены.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $driver_license = DriverLicense::findOrFail($id);
        $driver_license->delete();

        return redirect('admin/driver_licenses')
            ->with('flash_success', 'Водительские права успешно удалены.');
    }
}
