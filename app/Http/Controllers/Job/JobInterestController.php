<?php

namespace App\Http\Controllers\Job;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Job\JobInterest;
use Illuminate\Support\Facades\Auth;

class JobInterestController extends Controller
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
        $interest = JobInterest::create([
            'user_id' => Auth::user()->id,
            'job_basic_info_id' => $request->id,
        ]);
        return $interest;
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
        $interest = JobInterest::find($id);
        $interest->delete();
    }
}
