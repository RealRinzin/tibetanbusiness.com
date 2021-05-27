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

        $carousels =  Carousel::orderBy('created_at', 'desc')
        ->inRandomOrder()
        ->limit('1')
        ->get();
        return $carousels->toArray($carousels);
    }

    public function store(Request $request){
        return $request;
        // Counting the photos
        $countPhotos = count($_FILES['c_name']['name']);
        // Looping the files
        for ($i = 0; $i < $countPhotos; $i++) {
            // File Loop
            $file_name = $_FILES['c_images']["tmp_name"][$i];
            // image extension extraction
            $extension = explode("/", $_FILES["images"]["type"][$i]);
            $name = time() . $i . '.' . $extension[1];
            // Original
            \Image::make($file_name)->save($this->path . $name);
            $Original =  \Image::make($file_name)->save($this->path . $name);
            // thumb
            // Inserting
            // Recording in Database
            $jobDocument = Carousel::create([
                'name' => $name

            ]);
        }
        return response()->json([
            "message" => "Done"
        ]);

    }

}
