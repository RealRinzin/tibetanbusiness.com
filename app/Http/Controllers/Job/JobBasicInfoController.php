<?php

namespace App\Http\Controllers\Job;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Job\JobBasicInfoResource;
use App\Job\JobBasicInfo;
use Illuminate\Support\Facades\Auth;

class JobBasicInfoController extends Controller
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
        $job = JobBasicInfo::find($id);
        $job->delete();
        $job->job_questions()->delete();
        $job->job_applies()->delete();

    }
    /**
     * Get all Rent 
     * without authorization
     *  */
    public function all()
    {

        $jobs =  JobBasicInfo::where('status', '=', true)
            ->orderBy('created_at', 'desc')->get();
        return $jobs->toArray($jobs);
    }
    // 
    public function view(JobBasicInfo $jobBasicInfo, $id)
    {
        return view('job.show', ['id' => JobBasicInfo::find($id)]);
    }
    // Display the restaurant Show
    public function display($id)
    {
        // return $id;
        return new JobBasicInfoResource(JobBasicInfo::find($id));
    }
    /**
     * 
     * Restaurant Advertisment
     * Home Featured
     * Sidebar
     * Banner etc
     *  */
    // public function live()
    // {
    //     $jobs =  JobBasicInfo::where('status', '=', true)
    //         ->orderBy('created_at', 'desc')->get();
    //     return $jobs->toArray($jobs);
    // }
    public function status_update(Request $request, $id)
    {
        // return $id;
        $status = JobBasicInfo::find($id);
        // update
        $status->update($request->all());
    }
    public function featured_ad()
    {
        $jobs =  JobBasicInfo::where('featured_ad', '=', true)
            ->orderBy('created_at', 'desc')->get();
        return $jobs->toArray($jobs);
    }
    // Front
    public function home_ad()
    {
        $jobs =  JobBasicInfo::where('home_ad', '=', true)
            ->orderBy('created_at', 'desc')->get();
        return $jobs->toArray($jobs);
    }
    // Sidebar
    public function sidebar_ad()
    {
        $jobs =  JobBasicInfo::where('sidebar_ad', '=', true)
            ->orderBy('created_at', 'desc')->get();
        return $jobs->toArray($jobs);
    }
    // User Job
    public function user_job()
    {
        $jobs = Auth::user()->job_basic_infos;
        return $jobs->toArray($jobs);
    }
}
