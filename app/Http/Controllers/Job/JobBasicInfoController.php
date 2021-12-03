<?php

namespace App\Http\Controllers\Job;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Job\JobBasicInfoResource;
use App\Http\Resources\Job\JobBasicInfoResourceCollection;
use App\Job\JobDocument;
use App\Job\JobBasicInfo;
use Illuminate\Support\Facades\Auth;
use MetaTag;
use Mockery\Undefined;

class JobBasicInfoController extends Controller
{
    protected $path = '../public/storage/Job/Banner/';
    protected $document= '../public/storage/Job/Documents/';
   /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
            // Card
            $card = time() . '-card.'
                . explode('/', explode(
                    ':',
                    substr(
                        $request->banner,
                        0,
                        strpos($request->banner, ';')
                    )
                )[1])[1];
            // Thumb
            $thumb = time() . '-thumb.'
                . explode('/', explode(
                    ':',
                    substr(
                        $request->banner,
                        0,
                        strpos($request->banner, ';')
                    )
                )[1])[1];
                // Saving Images
            \Image::make($request->banner)->save($this->path . $name);
            $Original = \Image::make($request->banner)->save($this->path . $name);
            // Card 500 X
            $Original->resize(420, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            \Image::make($Original)->save($this->path . $card);
            // Thumbnail 240 X 
            $Original->resize(220, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            \Image::make($Original)->save($this->path . $thumb);
            
        }
        // return $name;
        $job = JobBasicInfo::create([
            'user_id' => Auth::user()->id,
            'banner' => $name,
            'card' => $card,
            'thumb' => $thumb,
            'title' => $request->title,
            'types' => $request->types,
            // Job
            'organization' => $request->organization,
            'salary' => $request->salary,
            'profession' => $request->profession,
            'nature' => $request->nature,
            'experience' => $request->experience,
            'deadline' => $request->deadline,
            'location' => $request->location,
            // Scholarshiop
            'course_name' => $request->course_name,
            'graduation' => $request->degree,
            'duration' => $request->duration,
            'country' => $request->country,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
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
            'website' => $request->website,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new JobBasicInfoResource(JobBasicInfo::find($id));
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
        $unlink = $this->path. $job->banner;
        $unlink_card = $this->path. $job->card;
        $unlink_thumb = $this->path. $job->thumb;
        unlink($unlink);
        unlink($unlink_card);
        unlink($unlink_thumb);
        // Documents Delete
        $documents = JobDocument::where('job_basic_info_id', $id)->get();
        for ($i = 0; $i < $documents->count(); $i++) {
            $documents[$i]->delete();
            $documents_detach = $this->document. $documents[$i]->path;
            if($documents[$i]->thumb != ''){
                $thumb = $this->document. $documents[$i]->thumb;
                unlink($thumb);

            }
            unlink($documents_detach);
        }
        // Delete
        $job->delete();
        $job->job_interests()->delete();
        $job->job_documents()->delete();
        $job->job_questions()->delete();
    }
    /**
     * Get all Rent 
     * without authorization
     *  */
    // 
    public function view(JobBasicInfo $jobBasicInfo, $id)
    {
        $meta = JobBasicInfo::find($id);
        if($meta->types == '2'){
            MetaTag::set('title', $meta->title .' - '. $meta->country);
            MetaTag::set('description', $meta->course_name . ' - ' . $meta->graduation . ' -'. $meta->duration);
        }else{
            MetaTag::set('title', $meta->title . ' - ' . $meta->organization);
            MetaTag::set('description', $meta->location .' - '.$meta->profession);
        }
        MetaTag::set('image', asset('storage/Job/Banner/'.$meta->banner));
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
        $meta = JobBasicInfo::find($id);
        if ($meta->types == '2') {
            MetaTag::set('title', $meta->title . ' - ' . $meta->country);
            MetaTag::set('description', $meta->course_name . ' - ' . $meta->graduation . ' -' . $meta->duration);
        } else {
            MetaTag::set('title', $meta->title . ' - ' . $meta->organization);
            MetaTag::set('description', $meta->location . ' - ' . $meta->profession);
        }
        MetaTag::set('image', asset('storage/Job/Banner/'.$meta->banner));
        if (Auth::user()->id === JobBasicInfo::find($id)->user_id) {
            return view('dashboard.job.edit', ['id' => JobBasicInfo::find($id)]);
        } else {
            $this->authorize('job_edit', $rentBasicInfo);
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
            // Card
            $card = time() . '-card.'
                . explode('/', explode(
                    ':',
                    substr(
                        $request->banner,
                        0,
                        strpos($request->banner, ';')
                    )
                )[1])[1];
            // Thumb
            $thumb = time() . '-thumb.'
                . explode('/', explode(
                    ':',
                    substr(
                        $request->banner,
                        0,
                        strpos($request->banner, ';')
                    )
                )[1])[1];

            \Image::make($request->banner)->save($this->path . $name);
            $Original = \Image::make($request->banner)->save($this->path . $name);
            // Card 500 X
            $Original->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            \Image::make($Original)->save($this->path . $card);
            // Thumbnail 240 X 
            $Original->resize(240, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            \Image::make($Original)->save($this->path . $thumb);
        }
        // upate
        $banner = JobBasicInfo::find($id);
        $unlink = $this->path. $banner->banner;
        $unlink_card = $this->path. $banner->card;
        $unlink_thumb = $this->path. $banner->thumb;
        unlink($unlink);
        unlink($unlink_card);
        unlink($unlink_thumb);
        $banner->update(['banner' => $name,'card'=>$card,'thumb'=>$thumb]);
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
     * Job Ads
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
            ->where('deadline', '>=', date('Y-m-d'))
            ->inRandomOrder()
            ->orderBy('created_at', 'desc')->get());    
        return $jobs->toArray($jobs);

    }
    public function featured_ad()
    {
        $jobs = JobBasicInfoResource::collection(JobBasicInfo::where('featured_ad', '=', true)
            ->where('status', '=', true)
            ->where('deadline', '>=', date('Y-m-d'))
            ->orderBy('created_at', 'desc')
            ->limit('1')
            ->inRandomOrder()->get());
        return $jobs->toArray($jobs);
    }
    // Front
    public function home_ad()
    {
        $jobs = JobBasicInfoResource::collection(JobBasicInfo::where('home_ad', '=', true)
            ->where('status', '=', true)
            ->inRandomOrder()
            // ->limit('1')
            ->orderBy('created_at', 'desc')->get());
        return $jobs->toArray($jobs);
    }
    // Sidebar
    public function sidebar_ad()
    {
        $jobs = JobBasicInfoResource::collection(JobBasicInfo::where('sidebar_ad', '=', true)
            ->where('status', '=', true)
            ->where('deadline', '>=', date('Y-m-d'))
            ->inRandomOrder()
            // ->limit('1')
            ->orderBy('created_at', 'desc')->get());
        return $jobs->toArray($jobs);
    }
    // Popup ad
    public function popup_ad()
    {
        $jobs = JobBasicInfo::where('popup_ad', '=', true)
            ->inRandomOrder()
            ->limit('1')
            ->orderBy('created_at', 'desc')->get();
        return $jobs->toArray($jobs);
    }
    // Sidebar
    public function sidebar(Request $request,$location){
        $jobs=  JobBasicInfo::where('location', 'like', "$location%")
        ->where('deadline', '>=', date('Y-m-d'))
        ->where('status', '=', true)
        ->where('id','!=',"$request->id")
        ->inRandomOrder()
        ->orderBy('created_at', 'desc')->paginate('4');
        return $jobs->toArray($jobs);

    }
    // User Job
    public function user_job()
    {
        $jobs = JobBasicInfo::where('user_id','=', Auth::user()->id)
        ->orderBy('created_at', 'desc')->get();
        return $jobs->toArray($jobs);
    }
    // Search View
    public function search_engine(Request $request)
    {
        MetaTag::set('title', $request->location);
        return view('job.search', ['location' => $request->location]);
    }
    // location
    public function location()
    {
        $location = JobBasicInfo::inRandomOrder()
            ->limit('1')
            ->get('location');
        return $location->toArray($location);
    }
    // Search Query
    public function search(Request $request)
    {
        // return $request;
        return new JobBasicInfoResourceCollection(JobBasicInfo::where('title', 'like', "$request->title%")
                ->where('location', 'like', "%$request->location%")
                ->where('profession', 'like', "$request->profession%")
                ->where('nature', 'like', "$request->nature%")
                ->where('experience', 'like', "$request->experience%")
                // ->whereBetween('salary', [$request->salary_min, $request->salary_max])
                // ->where('types', 'like', "$request->types%")
                // ->where('course_name', 'like', "$request->course_name%")
                // ->where('duration', 'like', "$request->duration%")
                // ->where('graduation', 'like', "$request->graduation%")
                // ->where('country', 'like', "$request->country%")
                ->where('deadline', '>=', date('Y-m-d'))
                ->where('status', '=', true)
                ->orderBy('created_at', 'desc')->paginate('10'));
    }
}
