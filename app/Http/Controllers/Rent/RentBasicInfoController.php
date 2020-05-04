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
            $this->authorize('rent_edit', $rentBasicInfo);
            // return redirect('/');
        }
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
