<?php

namespace App\Http\Controllers\LandingCarousel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\LandingCarousel\Carousel;


class CarouselController extends Controller
{
    protected $path = '../public/storage/Carousel/';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $carousels =  Carousel::orderBy('created_at', 'desc')
        ->inRandomOrder()
        ->limit('1')
        ->get();
        return $carousels->toArray($carousels);
        
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
        $name = '';
        // Image upload script in php
        if ($request->c_name) {
            $name = time() . '.'
                . explode('/', explode(
                    ':',
                    substr(
                        $request->c_name,
                        0,
                        strpos($request->c_name, ';')
                    )
                )[1])[1];

            // Original
            \Image::make($request->c_name)->save($this->path . $name);
            $Original = \Image::make($request->c_name)->save($this->path . $name);
        }
        $jobDocument = Carousel::create([
            'name' => $name
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
    }
}
