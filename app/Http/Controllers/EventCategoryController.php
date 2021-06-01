<?php

namespace App\Http\Controllers;

use App\EventCategory;
use Illuminate\Http\Request;

class EventCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $events =  EventCategory::orderBy('name', 'asc')->get();
        return $events->toArray($events);
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
        $job = EventCategory::create([
            'name' => $request->name
        ]);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EventCategory  $eventCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EventCategory $eventCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EventCategory  $eventCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(EventCategory $eventCategory)
    {
        //
    }

    public function search(Request $request)
    {
        $eventCategory = EventCategory::where('name', 'like', "$request->name%")
        ->orderBy('created_at', 'desc')->paginate('10');
        return $eventCategory->toArray($eventCategory);
    }
}
