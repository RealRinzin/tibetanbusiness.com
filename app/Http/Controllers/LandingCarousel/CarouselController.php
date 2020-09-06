<?php

namespace App\Http\Controllers\LandingCarousel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\LandingCarousel\Carousel;

class CarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants =  Carousel::orderBy('created_at', 'desc')->get();
        return $restaurants->toArray($restaurants);
        //
        // $jobs = Carousel::where('category', '=', 'job')
        // ->orderBy('created_at', 'desc')->get();
        // return $jobs->toArray($jobs);

    }

}
