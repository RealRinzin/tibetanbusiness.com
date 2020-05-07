<?php

namespace App\Http\Controllers\Rent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Rent\RentBasicInfoResource;
use App\Rent\RentBasicInfo;
use App\User;
use Illuminate\Support\Facades\Auth;

class RentBasicInfoController extends Controller
{
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
            \Image::make($request->banner)->save(public_path('/img/') . $name);
        }
        $rent = RentBasicInfo::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'mobile_no' => $request->mobile_no,
            'location' => $request->location,
            'email' => $request->email,
            'fare' => $request->fare,
            'banner' => $name,
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
        $rent->delete();
        $rent->rent_comments()->delete();
        $rent->rent_facilities()->delete();
        $rent->rent_view_photos()->delete();
        $rent->rent_room_photos()->delete();
    }

    /**
     * Get all Rent 
     * without authorization
     *  */
    public function all(){
        $rents =  RentBasicInfo::orderBy('created_at', 'desc')->get();
        return $rents->toArray($rents);
    }

    public function view(RentBasicInfo $rentBasicInfo, $id)
    {
        return view('rent.show', ['id' => RentBasicInfo::find($id)]);

    }
    // Display the restaurant Show
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
            \Image::make($request->banner)->save(public_path('/img/') . $name);
        }
        // upate
        $banner = RentBasicInfo::find($id);
        $banner->update(['banner' => $name]);
    }
    /**
     * 
     * Restaurant Advertisment
     * Home Featured
     * Sidebar
     * Banner etc
     *  */
    public function featured_ad()
    {
        $rents =  RentBasicInfo::where('featured_ad', '=', true)
            ->orderBy('created_at', 'desc')->get();
        return $rents->toArray($rents);
    }
    // Front
    public function home_ad()
    {
        $rents =  RentBasicInfo::where('home_ad', '=', true)
            ->orderBy('created_at', 'desc')->get();
        return $rents->toArray($rents);
    }
    // Sidebar
    public function sidebar_ad()
    {
        $rents =  RentBasicInfo::where('sidebar_ad', '=', true)
            ->orderBy('created_at', 'desc')->get();
        return $rents->toArray($rents);
    }
}
