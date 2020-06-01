<?php

namespace App\Http\Controllers\Job;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Job\JobApply;
use Illuminate\Support\Facades\Auth;

class JobApplyController extends Controller
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
        $file_name = explode('.',$request->file_name);
        $file_extension = $file_name[sizeof($file_name) - 1];

        // File Upload;
        $diir = '';
        if ($request->cv) {
            $cv = explode(";base64,", $request->cv);
            $cv_base64 = base64_decode($cv[1]);
            $diir = uniqid() .'.'.$file_extension;
            file_put_contents("img/" . $diir, $cv_base64);
        }
        $apply = JobApply::create([
            'job_basic_info_id' => $request->job_basic_info_id,
            'user_id' => Auth::user()->id,
            'document' => $diir,
            'name' => $request->name,
            'email' => $request->email,
            'mobile_no' => $request->mobile_no,
        ]);
        return $apply;

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
}
