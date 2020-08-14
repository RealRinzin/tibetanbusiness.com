<?php

namespace App\Http\Controllers\Category;

use App\Category\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
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
     * Categories
     * Events
     * Services
     * Sales
     *  */ 
    // Job profession
    public function job(){
        $jobs = Category::where('category','=','job')
        ->orderBy('created_at', 'desc')->get();
        return $jobs->toArray($jobs);
    }
    // Events category
    public function event()
    {
        $events = Category::where('category', '=', 'event')
        ->orderBy('created_at', 'desc')->get();
        return $events->toArray($events);
    }
    // Sales category
    public function sale()
    {
        $sales = Category::where('category', '=', 'sale')
        ->orderBy('created_at', 'desc')->get();
        return $sales->toArray($sales);
    }
    // Sales category
    public function service()
    {
        $services = Category::where('category', '=', 'service')
        ->orderBy('created_at', 'desc')->get();
        return $services->toArray($services);
    }

}