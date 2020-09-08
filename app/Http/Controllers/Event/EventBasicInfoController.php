<?php

namespace App\Http\Controllers\Event;

use App\Event\EventBasicInfo;
use App\Event\EventPhoto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Event\EventInfoBasicResource;
use App\Http\Resources\Event\EventInfoBasicResourceCollection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
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
        // Check the entry Fee
        if($request->entry_fee == null){
            $request->entry_fee = 0;
        }
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
            // Original
            \Image::make($request->banner)->save(public_path('/storage/Event/Banner/') . $name);
            $Original = \Image::make($request->banner)->save(public_path('/storage/Event/Banner/') . $name);
            // Card 500 X
            $Original->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            \Image::make($Original)->save(public_path('/storage/Event/Banner/') . $card);
            // Thumbnail 240 X 
            $Original->resize(240, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            \Image::make($Original)->save(public_path('/storage/Event/Banner/') . $thumb);

        }
        // return $name;
        $job = EventBasicInfo::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'banner' => $name,
            'card' => $card,
            'thumb' => $thumb,
            'email' => $request->email,
            'entry_free'=>$request->entry_free,
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
        // return new EventInfoBasicResource(EventBasicInfo::find($id));
        $event = EventBasicInfo::find($id);
        return $event->toArray($event);


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
        $event = EventBasicInfo::find($id);
        $event->update($request->all());
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
        $unlink_card= public_path() . '/storage/Event/Banner/' . $event->card;
        $unlink_thumb = public_path() . '/storage/Event/Banner/' . $event->thumb;
        unlink($unlink);
        unlink($unlink_card);
        unlink($unlink_thumb);
        // Photos Delete
        $photos = EventPhoto::where('event_basic_info_id', $id)->get();
        for ($i = 0; $i < $photos->count(); $i++) {
            $photos[$i]->delete();
            $photos_detach = public_path() . '/storage/Event/Photos/' . $photos[$i]->path;
            $photos_card = public_path() . '/storage/Event/Photos/' . $photos[$i]->card;
            $photos_thumb = public_path() . '/storage/Event/Photos/' . $photos[$i]->thumb;
            unlink($photos_detach);
            unlink($photos_card);
            unlink($photos_thumb);
        }
        $event->delete();
        $event->event_interests()->delete();
        $event->event_reviews()->delete();
        $event->event_photos()->delete();
    }

    /**
     *  Updating Star rating
     * Restaurant
     * Star Rate
     * 
     *  */
    public function update_rate(Request $request, $id)
    {
        $rate = EventBasicInfo::find($id);
        $rate->rate=$request->rate;
        $rate->update();
        // $rate->update($request->all());
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
    // Banner update
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
                // Store Image
            \Image::make($request->banner)->save(public_path('/storage/Event/Banner/') . $name);
            $Original = \Image::make($request->banner)->save(public_path('/storage/Event/Banner/') . $name);
            // Card 500 X
            $Original->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            \Image::make($Original)->save(public_path('/storage/Event/Banner/') . $card);
            // Thumbnail 240 X 
            $Original->resize(240, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            \Image::make($Original)->save(public_path('/storage/Event/Banner/') . $thumb);
        }
        // upate
        $banner = EventBasicInfo::find($id);
        // Remove old photos
        $unlink = public_path() . '/storage/Event/Banner/' . $banner->banner;
        $unlink_card = public_path() . '/storage/Event/Banner/' . $banner->card;
        $unlink_thumb = public_path() . '/storage/Event/Banner/' . $banner->thumb;
        unlink($unlink);
        unlink($unlink_card);
        unlink($unlink_thumb);
        // Update fields
        $banner->update(['banner' => $name,'card'=>$card,'thumb'=>$thumb]);
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
        $events = EventInfoBasicResource::collection(EventBasicInfo::where('status', '=', true)
            ->where('start_date', '>=', date('Y-m-d'))
            ->inRandomOrder()
            ->limit(4)
            ->orderBy('created_at', 'desc')->get());
        return $events->toArray($events);
    }
    public function featured_ad()
    {
        $events = EventInfoBasicResource::collection(EventBasicInfo::where('featured_ad', '=', true)
            ->where('start_date', '>=', date('Y-m-d'))
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->inRandomOrder()->get());
        return $events->toArray($events);
    }
    // Front
    public function home_ad()
    {
        $events = EventInfoBasicResource::collection(EventBasicInfo::where('home_ad', '=', true)
            ->where('start_date', '>=', date('Y-m-d'))
            ->inRandomOrder()
            ->limit('4')
            ->orderBy('created_at', 'desc')->get());
        return $events->toArray($events);
    }
    // Sidebar
    public function sidebar_ad()
    {
        $events = EventInfoBasicResource::collection(EventBasicInfo::where('sidebar_ad', '=', true)
            ->where('start_date', '>=', date('Y-m-d'))
            ->inRandomOrder()
            ->limit(4)
            ->orderBy('created_at', 'desc')->get());
        return $events->toArray($events);
    }
    // Search View
    public function search_engine(Request $request)
    {
        return view('event.search', ['location' => $request->location]);
    }
    // Search Query
    public function search(Request $request)
    {
        // return $request;
        $min = (int)$request->fee_min;
        $max = (int)$request->fee_max;

        if($request->entry_free === 'true'){
            $status = true;
        }else{
            $status = false;
        }

        if(!$status){
            return new EventInfoBasicResourceCollection(EventBasicInfo::where('name', 'like', "$request->name%")
                ->where('location', 'like', "%$request->location")
                ->where('category', 'like', "$request->category%")
                ->whereBetween('start_date', [$request->from, $request->to])
                ->whereBetween('entry_fee', [$min, $max])
                // ->orWhere('entry_fee','=',NULL)
                ->where('start_date', '>=', date('Y-m-d'))
                ->where('status', '=', true)->orderBy('created_at', 'desc')->paginate('4'));
        }else{
            // return "not empty";
            $fee_charged = true;
            return new EventInfoBasicResourceCollection(EventBasicInfo::where('name', 'like', "$request->name%")
                ->where('location', 'like', "$request->location%")
                ->where('category', 'like', "$request->category%")
                ->where('entry_free', $fee_charged)
                // ->whereBetween('entry_fee', [$min, $max])
                ->whereBetween('start_date', [$request->from, $request->to])
                ->where('start_date', '>=', date('Y-m-d'))
                ->where('status', '=', true)->orderBy('created_at', 'desc')->paginate('4'));
        }

        // return new EventInfoBasicResourceCollection(EventBasicInfo::where('name', 'like', "$request->name%")
        //     ->where('location', 'like', "$request->location%")
        //     ->where('category', 'like', "$request->category%")
        //     ->whereBetween('start_date', [$request->from, $request->to])
        //     ->where('entry_free', false)
        //     ->whereBetween('entry_fee', [$min, $max])
        //     ->where('start_date', '>=', date('Y-m-d'))
        //     ->where('status', '=', true)->orderBy('created_at', 'desc')->paginate('4'));
    }
}
