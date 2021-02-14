<?php

namespace App\Http\Controllers\Rent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Rent\RentBasicInfoResource;
use App\Rent\RentBasicInfo;
use App\Rent\RentRoomPhoto;
use App\Rent\RentViewPhoto;
use App\User;
use Illuminate\Support\Facades\Auth;
use MetaTag;

class RentBasicInfoController extends Controller
{
    protected $path = '../public/storage/Rent/Banner/';
    protected $path_view = '../public/storage/Rent/View-Photos/';
    protected $path_room = '../public/storage/Rent/Room-Photos/';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return RentBasicInfoResource::collection(RentBasicInfo::all());
        // return RentBasicInfoResource::collection(RentBasicInfoResource::get());

        $rents =  RentBasicInfo::all();
        return $rents->toArray($rents);
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
            \Image::make($request->banner)->save($this->path. $name);
            $Original = \Image::make($request->banner)->save($this->path. $name);
            // Card 500 X
            $Original->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            \Image::make($Original)->save($this->path. $card);
            // Thumbnail 240 X 
            $Original->resize(240, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            \Image::make($Original)->save($this->path. $thumb);
        }
        $rent = RentBasicInfo::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'mobile_no' => $request->mobile_no,
            'location' => $request->location,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
            'email' => $request->email,
            'fare' => $request->fare,
            'banner' => $name,
            'rate'=>0,
            'card' => $card,
            'thumb' => $thumb,
            'accomodation_size' => $request->accomodation_size,
            'address' => $request->address,
            'status' => true,
            'featured_ad' => false,
            'sidebar_ad' => false,
            'home_ad' => false,
            'description' => $request->description,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
        ]);
        return $rent;
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
        return new RentBasicInfoResource(RentBasicInfo::find($id));

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
        return new RentBasicInfoResource(RentBasicInfo::find($id));

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

        $rent = RentBasicInfo::find($id);
        $rent->update($request->all());
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
        $rent = RentBasicInfo::find($id);
        $unlink = $this->path. $rent->banner;
        $unlink_card = $this->path. $rent->card;
        $unlink_thumb = $this->path. $rent->thumb;
        unlink($unlink);
        unlink($unlink_card);
        unlink($unlink_thumb);
        // View Photos
        $view_photos = RentViewPhoto::where('rent_basic_info_id', $id)->get();
        for ($i = 0; $i < $view_photos->count(); $i++) {
            $view_photos[$i]->delete();
            $view_detach = $this->path_view. $view_photos[$i]->path;
            $view_thumb = $this->path_view. $view_photos[$i]->thumb;
            unlink($view_detach);
            unlink($view_thumb);
        }
        // Room Photos
        $room_photos = RentRoomPhoto::where('rent_basic_info_id', $id)->get();
        for ($i = 0; $i < $room_photos->count(); $i++) {
            $room_photos[$i]->delete();
            $room_detach = $this->path_room. $room_photos[$i]->path;
            $room_thumb = $this->path_room. $room_photos[$i]->thumb;
            unlink($room_detach);
            unlink($room_thumb);
        }
        $rent->delete();
        $rent->rent_comments()->delete();
        $rent->rent_facilities()->delete();
        $rent->rent_view_photos()->delete();
        $rent->rent_room_photos()->delete();
    }
    /**
     *  Updating Star rating
     * Restaurant
     * Star Rate
     * 
     *  */
    public function update_rate(Request $request, $id)
    {
        // return $request;
        $rate = RentBasicInfo::find($id);
        // $rent->rate = $request->rate;
        // $rent->update();
        $rate->update($request->all());
    }
    /**
     * Get all Rent 
     * without authorization
     *  */
    public function view(RentBasicInfo $rentBasicInfo, $id)
    {
        // Meta Description
        $meta = RentBasicInfo::find($id);
        $meta->fare = 'Rs:'.$meta->fare;
        MetaTag::set('title', $meta->name .' - '. $meta->fare);
        MetaTag::set('description', $meta->location .' '.$meta->description);
        MetaTag::set('image', asset('storage/Rent/Banner/'.$meta->banner));
        // Meta Description End
        return view('rent.show', ['id' => RentBasicInfo::find($id)]);

    }
    // Display the restaurant Showv
    public function display($id){
        return new RentBasicInfoResource(RentBasicInfo::find($id));
    }
    /**
     *  Restaurant 
     *  Retrieve only the logged / ower's restaurant
     *  */
    public function user_rent(User $user, RentBasicInfo $rentBasicInfo)
    {
        // Getting only auth resources
        $rents = Auth::user()->rent_basic_infos;
        return $rents->toArray($rents);

    }
    /**
     * Showing restaurant without relationship
     *  */
    public function show_individual($id)
    {
        $rent = RentBasicInfo::find($id);
        return $rent;
    }
    // Status update
    /**
     * 
     * Status update 
     * On and off
     * 
     *  */
    public function status_update(Request $request, $id)
    {
        $status = RentBasicInfo::find($id);
        // update
        $status->update($request->all());
    }
    /**
     * 
     * Restaurant Edit
     *  */
    public function rent_edit(RentBasicInfo $rentBasicInfo, $id)
    {
        if (Auth::user()->id === RentBasicInfo::find($id)->user_id) {
            return view('dashboard.rent.edit', ['id' => RentBasicInfo::find($id)]);
        } else {
            $this->authorize('rent_auth', $rentBasicInfo);
            // return redirect('/');
        }
    }
    public function banner_update(Request $request, $id)
    {
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
            \Image::make($request->banner)->save($this->path. $name);
            $Original = \Image::make($request->banner)->save($this->path. $name);
            // Card 500 X
            $Original->resize(420, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            \Image::make($Original)->save($this->path. $card);
            // Thumbnail 240 X 
            $Original->resize(220, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            \Image::make($Original)->save($this->path. $thumb);
        }
        // upate
        $banner = RentBasicInfo::find($id);
        $unlink = $this->path. $banner->banner;
        $unlink_card = $this->path. $banner->card;
        $unlink_thumb = $this->path. $banner->thumb;
        unlink($unlink);
        unlink($unlink_card);
        unlink($unlink_thumb);
        $banner->update(['banner' => $name,'card'=>$card,'thumb'=>$thumb]);
    }
    /**
     * 
     * Restaurant Advertisment
     * Home Featured
     * Sidebar
     * Banner etc
     *  */
    public function max_fare(){
        $max = RentBasicInfo::where('status','=',true)->max('fare');
        return $max;
    }
    public function min_fare()
    {
        $min = RentBasicInfo::where('status', '=', true)->min('fare');
        return $min;
    }
    public function all(){
    $rents =  RentBasicInfo::where('status', '=', true)
        ->orderBy('created_at', 'desc')
        // ->limit('1')
        ->inRandomOrder()->get();
    return $rents->toArray($rents);
    }

    public function featured_ad()
    {
        $rents =  RentBasicInfo::where('featured_ad', '=', true)
            ->orderBy('created_at', 'desc')
            ->limit('1')
            ->inRandomOrder()->get();
        return $rents->toArray($rents);
    }
    // Front
    public function home_ad()
    {
        $rents =  RentBasicInfo::where('home_ad', '=', true)
            ->inRandomOrder()
            ->limit('1')
            ->orderBy('created_at', 'desc')->get();
        return $rents->toArray($rents);
    }
    // Sidebar
    public function sidebar_ad()
    {
        $rents =  RentBasicInfo::where('sidebar_ad', '=', true)
            ->inRandomOrder()
            // ->limit('1')
            ->orderBy('created_at', 'desc')->get();
        return $rents->toArray($rents);
    }
    // sidebar
    public function sidebar(Request $request,$location){
        $rents =  RentBasicInfo::where('location', 'like', "$location%")
        ->inRandomOrder()
        ->orderBy('created_at', 'desc')->paginate('4');
        return $rents->toArray($rents);

    }
    // Search View
    public function search_engine(Request $request)
    {
        return view('rent.search', ['location' => $request->location]);
    }
    // Search Query
    public function search(Request $request)
    {
        // return $request;
        $rents =  RentBasicInfo::where('name', 'like', "$request->name%")
        ->where('location', 'like', "$request->location%")
        ->where('rate','like',"$request->rate%")
        ->whereBetween('fare', [$request->fare_min,$request->fare_max])
        ->where('accomodation_size', 'like', "$request->accomodation_size%")
        ->where('status', '=', '1')
        ->orderBy('created_at', 'desc')->paginate('3');
        return $rents->toArray($rents);
    }
}
