<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Device;
use App\DeviceType;
use Illuminate\Http\Request;
use Prologue\Alerts\Facades\Alert;
use App\Http\Controllers\Controller;
use App\Http\Requests\Brands\StoreBrand;
use App\Http\Requests\Brands\UpdateBrand;

class DevicesController extends Controller
{
    /**
     * Brands model
     *
     * @var \App\Device
     */
    protected $device;

    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->device = new Device();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $devices = $this->device->getAll();
        return view('devices/index', compact('devices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $device = $this->device;
        $action = 'create';
        $deviceTypes = new DeviceType();
        $deviceTypes = $deviceTypes->getLists();
        $brands = new Brand();
        $brands = $brands->getLists();
        $formData = array('route' => 'devices.store', 'method' => 'POST');

        return view('devices/form', compact('action', 'device', 'deviceTypes', 'brands', 'formData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Brands\StoreBrand  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreBrand $request)
    {
        $data = $request->validated();

        $this->device->create($data);

        Alert::success(__('devices.store'))->flash();

        return redirect()->route('devices.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Device  $device
     * @return \Illuminate\View\View
     */
    public function edit(Brand $device)
    {
        $action    = 'update';
        $formData = array('route' => array('devices.update', $device->id), 'method' => 'PATCH');

        return view('devices/form', compact('action', 'brand', 'formData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Brands\UpdateBrand  $request
     * @param  \App\Device  $device
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateBrand $request, Brand $device)
    {
        $device->update($request->validated());
        Alert::success(__('devices.update'))->flash();
        return redirect()->route('devices.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Device  $device
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Brand $device)
    {
        $device->delete();
        Alert::success(__('devices.destroy'))->flash();
        return redirect()->route('devices.index');
    }
}
