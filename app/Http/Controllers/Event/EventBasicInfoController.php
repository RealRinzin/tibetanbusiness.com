<?php

namespace App\Http\Controllers\Event;

use App\Event\EventBasicInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Event\EventInfoBasicResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class EventBasicInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        echo URL::current();
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
            \Image::make($request->banner)->save(public_path('/storage/Event/Banner/') . $name);
        }
        // return $name;
        $job = EventBasicInfo::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'banner' => $name,
            'email' => $request->email,
            'location' => $request->location,
            'category' => $request->category,
            'address' => $request->address,
            'mobile_no' => $request->mobile_no,
            'entry_fee' => $request->entry_fee,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'description' => $request->description,
            'status' => true,
            'featured_ad' => false,
            'sidebar_ad' => false,
            'home_ad' => false,
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
        
        $event = EventBasicInfo::find($id);
        $unlink = public_path() . '/storage/Event/Banner/' . $event->banner;
        unlink($unlink);
        $event->delete();
        // $job->job_questions()->delete();
        // $job->job_applies()->delete();
    }
    /**
     * Customized API
     * Routes
     *  */
    // Event View page
    public function view(EventBasicInfo $eventBasicInfo, $id)
    {
        return view('event.show', ['id' => EventBasicInfo::find($id)]);
    }
    // Dashboard Edit
    public function event_edit(EventBasicInfo $eventBasicInfo, $id)
    {
        if (Auth::user()->id === EventBasicInfo::find($id)->user_id) {
            return view('dashboard.event.edit', ['id' => EventBasicInfo::find($id)]);
        } else {
            // $this->authorize('rent_auth', $rentBasicInfo);
            // return redirect('/');
        }
    }
    // Display page
    public function display($id)
    {
        // return "hellow";
        return new EventInfoBasicResource(EventBasicInfo::find($id));
    }
    // User Job
    public function user_event()
    {
        $events = Auth::user()->event_basic_infos;
        return $events->toArray($events);
    }

    // Update status
    public function status_update(Request $request, $id)
    {
        // return $id;
        $status = EventBasicInfo::find($id);
        // update
        $status->update($request->all());
    }
    public function all()
    {
        $events =  EventBasicInfo::where('status', '=', true)
            ->orderBy('created_at', 'desc')->get();
        return $events->toArray($events);
    }
    public function featured_ad()
    {
        $jobs =  EventBasicInfo::where('featured_ad', '=', true)
            ->orderBy('created_at', 'desc')->get();
        return $jobs->toArray($jobs);
    }
    // Front
    public function home_ad()
    {
        $jobs =  EventBasicInfo::where('home_ad', '=', true)
            ->orderBy('created_at', 'desc')->get();
        return $jobs->toArray($jobs);
    }
    // Sidebar
    public function sidebar_ad()
    {
        $jobs =  EventBasicInfo::where('sidebar_ad', '=', true)
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