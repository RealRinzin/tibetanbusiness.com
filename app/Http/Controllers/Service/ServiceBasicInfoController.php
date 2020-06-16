<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\ServiceBasicInfo;
use Illuminate\Support\Facades\Auth;

class ServiceBasicInfoController extends Controller
{
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $service = ServiceBasicInfo::find($id);
        return $service->toArray($service);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
    // CUSTOM API
    // Dashboard Edit
    public function service_edit(ServiceBasicInfo $serviceBasicInfo, $id)
    {
        if (Auth::user()->id === ServiceBasicInfo::find($id)->user_id) {
            return view('dashboard.service.edit', ['id' => ServiceBasicInfo::find($id)]);
        } else {
            // $this->authorize('rent_auth', $rentBasicInfo);
            // return redirect('/');
        }
    }
    public function all()
    {
        $service =  ServiceBasicInfo::where('status', '=', true)
            ->orderBy('created_at', 'desc')->get();
        return $service->toArray($service);
    }
    public function featured_ad()
    {
        $service =  ServiceBasicInfo::where('featured_ad', '=', true)
            ->orderBy('created_at', 'desc')->get();
        return $service->toArray($service);
    }
    
    public function user_service()
    {
        $service = Auth::user()->service_basic_infos;
        return $service->toArray($service);
    }
}
