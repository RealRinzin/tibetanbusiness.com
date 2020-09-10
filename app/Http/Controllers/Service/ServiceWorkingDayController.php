<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\ServiceBasicInfo;
use App\Service\ServiceWorkingDay;

class ServiceWorkingDayController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $working_day = ServiceWorkingDay::create($request->all());

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        // fetch ID
        $service = ServiceWorkingDay::find($id);
        // udpate function
        $service->update($request->all());
    }

    // Custom API
    public function working_day(ServiceBasicInfo $serviceBasicInfo)
    {
        return $serviceBasicInfo->service_working_days()->get();
    }
}
