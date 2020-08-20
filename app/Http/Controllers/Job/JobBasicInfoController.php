<?php

namespace App\Http\Controllers\Job;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Job\JobApplyResource;
use App\Http\Resources\Job\JobBasicInfoResource;
use App\Http\Resources\Job\JobBasicInfoResourceCollection;
use App\Job\JobBasicInfo;
use Carbon\Carbon;
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
        // return JobBasicInfoResource::collection(JobBasicInfo::all());

        // return "asdfdas";
        // //
        // $jobs =  JobBasicInfo::all();
        // return $jobs->toArray($jobs);
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
        $name = '';
        // Image upload script in php
        if ($request->banner) {
            $name = time() . '.'
                . explode('/', explode(
                    ':',
                    substr(
                        $request->banner,
                        0,
                        strpos($request->banner, ';')
                    )
                )[1])[1];
            \Image::make($request->banner)->save(public_path('/storage/Job/Banner/') . $name);
        }
        // return $name;
        $job = JobBasicInfo::create([
            'user_id' => Auth::user()->id,
            'banner' => $name,
            'title' => $request->title,
            'organization' => $request->organization,
            'salary' => $request->salary,
            'profession' => $request->profession,
            'nature' => $request->nature,
            'experience' => $request->experience,
            'deadline' => $request->deadline,
            'location' => $request->location,
            'mobile_no' => $request->mobile_no,
            'email' => $request->email,
            'address' => $request->address,
            'status' => true,
            'featured_ad' => false,
            'sidebar_ad' => false,
            'home_ad' => false,
            'description' => $request->description,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
        ]);
        return $job;
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
        return new JobBasicInfoResource(JobBasicInfo::find($id));

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
        $job = JobBasicInfo::find($id);
        $job->update($request->all());
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
        $unlink = public_path() . '/storage/Job/Banner/' . $job->banner;
        unlink($unlink);
        $job->delete();
        $job->job_questions()->delete();
        $job->job_applies()->delete();

    }
    /**
     * Get all Rent 
     * without authorization
     *  */
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
    // Job
    public function job_edit(JobBasicInfo $rentBasicInfo, $id)
    {
        if (Auth::user()->id === JobBasicInfo::find($id)->user_id) {
            return view('dashboard.job.edit', ['id' => JobBasicInfo::find($id)]);
        } else {
            // $this->authorize('rent_auth', $rentBasicInfo);
            // return redirect('/');
        }
    }
    public function banner_update(Request $request, $id)
    {
        // return $request;
        $name = '';
        // Image upload script in php
        if ($request->banner) {
            $name = time() . '.'
                . explode('/', explode(
                    ':',
                    substr(
                        $request->banner,
                        0,
                        strpos($request->banner, ';')
                    )
                )[1])[1];
            \Image::make($request->banner)->save(public_path('/storage/Job/Banner/') . $name);
        }
        // upate
        $banner = JobBasicInfo::find($id);
        $unlink = public_path() . '/storage/Job/Banner/' . $banner->banner;
        unlink($unlink);
        $banner->update(['banner' => $name]);
    }
    /**
     * Showing restaurant without relationship
     *  */
    public function show_individual($id)
    {
        $job = JobBasicInfo::find($id);
        return $job;
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
    public function all()
    {
        $jobs = JobBasicInfoResource::collection(JobBasicInfo::where('status', '=', true)
            ->orderBy('created_at', 'desc')->get());
        return $jobs->toArray($jobs);
        // $jobs =  JobBasicInfo::where('status', '=', true)
        //     ->orderBy('created_at', 'desc')->get();
        // return $jobs->toArray($jobs);
    }
    public function featured_ad()
    {
        $jobs = JobBasicInfoResource::collection(JobBasicInfo::where('featured_ad', '=', true)
            ->orderBy('created_at', 'desc')->get());
        return $jobs->toArray($jobs);
    }
    // Front
    public function home_ad()
    {
        $jobs = JobBasicInfoResource::collection(JobBasicInfo::where('home_ad', '=', true)
            ->orderBy('created_at', 'desc')->get());
        return $jobs->toArray($jobs);
    }
    // Sidebar
    public function sidebar_ad()
    {
        $jobs = JobBasicInfoResource::collection(JobBasicInfo::where('sidebar_ad', '=', true)
            ->orderBy('created_at', 'desc')->get());
        return $jobs->toArray($jobs);
    }
    // User Job
    public function user_job()
    {
        $jobs = Auth::user()->job_basic_infos;
        return $jobs->toArray($jobs);
    }
    // Search View
    public function search_engine(Request $request)
    {
        return view('job.search', ['location' => $request->location]);
    }
    // Search Query
    public function search(Request $request)
    {

        return new JobBasicInfoResourceCollection(JobBasicInfo::where('title', 'like', "$request->title%")
                ->where('location', 'like', "%$request->location%")
                ->where('profession', 'like', "$request->profession%")
                ->where('nature', 'like', "$request->nature%")
                ->where('experience', 'like', "$request->experience%")
                ->whereBetween('salary', [$request->salary_min, $request->salary_max])
                ->where('deadline', '>=', date('Y-m-d'))
                ->where('status', '=', true)
                ->orderBy('created_at', 'desc')->paginate('3'));

        // Original
        // $jobs = JobBasicInfo::where('title', 'like', "$request->title%")
        // ->where('location', 'like', "%$request->location%")
        // ->where('profession', 'like', "$request->profession%")
        // ->where('nature', 'like', "$request->nature%")
        // ->where('experience', 'like', "$request->experience%")
        // ->whereBetween('salary', [$request->salary_min, $request->salary_max])
        // ->where('deadline','>=',date('Y-m-d'))
        // ->where('status', '=', '1')
        // ->orderBy('created_at', 'desc')->paginate('3');
        // return $jobs->toArray($jobs);
    }
}
