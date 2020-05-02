<?php

namespace App\Http\Controllers\Rent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Rent\RentBasicInfoResource;
use App\Rent\RentBasicInfo;

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
     * 
     * Restaurant Advertisment
     * Home Featured
     * Sidebar
     * Banner etc
     *  */
    public function featured_ad()
    {
        $restaurants =  RentBasicInfo::where('featured_ad', '=', true)
            ->orderBy('created_at', 'desc')->get();
        return $restaurants->toArray($restaurants);
    }
    // Front
    public function home_ad()
    {
        $restaurants =  RentBasicInfo::where('home_ad', '=', true)
            ->orderBy('created_at', 'desc')->get();
        return $restaurants->toArray($restaurants);
    }
    // Sidebar
    public function sidebar_ad()
    {
        $restaurants =  RentBasicInfo::where('sidebar_ad', '=', true)
            ->orderBy('created_at', 'desc')->get();
        return $restaurants->toArray($restaurants);
    }
}
