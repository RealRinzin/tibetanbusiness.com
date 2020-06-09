<?php

namespace App\Http\Controllers\Event;

use App\Event\EventBasicInfo;
use App\Event\EventPhoto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EventPhotoController extends Controller
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
        // return $request;
        if (count($request->images)) {
            foreach ($request->images as $image) {
                $restaurant = EventPhoto::create([
                    'event_basic_info_id' => $request->id,
                    'path' => $image->store(''),
                    'user_id' => Auth::user()->id,
                ]);
                // $image->store('public\images');
                $image->store('public\Event\Photos');
            }
        }
        return response()->json([
            "message" => "Done"
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
        $photo = EventPhoto::find($id);
        // return $photo->path;
        $unlink = public_path() . '/storage/Event/Photos/' . $photo->path;
        unlink($unlink);
        $photo->delete();
    }

    /**
     * 
     * Custom api functions
     * 
     *  */
    public function photo(EventBasicInfo $eventBasicInfo)
    {
        return $eventBasicInfo->event_photos()->orderBy('created_at', 'desc')->get();
    }
}
