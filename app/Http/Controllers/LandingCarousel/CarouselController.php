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

        $carousels =  Carousel::orderBy('created_at', 'desc')
        ->inRandomOrder()
        ->limit('1')
        ->get();
        return $carousels->toArray($carousels);
    }

}
