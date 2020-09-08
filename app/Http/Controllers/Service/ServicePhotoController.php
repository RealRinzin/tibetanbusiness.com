<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\ServiceBasicInfo;
use App\Service\ServicePhoto;
use Illuminate\Support\Facades\Auth;

class ServicePhotoController extends Controller
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
        $countPhotos = count($_FILES['images']['name']);
        for ($i = 0; $i < $countPhotos; $i++) {
            $file_name = $_FILES['images']["tmp_name"][$i];
            // image extension extraction
            $extension = explode("/", $_FILES["images"]["type"][$i]);
            $name = time() . '.' . $extension[1];
            $card = time() . '-card.' . $extension[1];
            $thumb = time() . '-thumb.' . $extension[1];
            // Original
            \Image::make($file_name)->save(public_path('/storage/Service/Photos/') . $name);
            $Original =  \Image::make($file_name)->save(public_path('/storage/Service/Photos/') . $name);
            // card
            $Original->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            \Image::make($Original)->save(public_path('/storage/Service/Photos/') . $card);
            // thumb
            $Original->resize(240, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            \Image::make($Original)->save(public_path('/storage/Service/Photos/') . $thumb);
            // Insert record
            // to Database
            $photo = ServicePhoto::create([
                'service_basic_info_id' => $request->id,
                'path' => $name,
                'card' => $card,
                'thumb' => $thumb,
                'user_id' => Auth::user()->id,
            ]);
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
        $photo = ServicePhoto::find($id);
        $unlink = public_path() . '/storage/Service/Photos/' . $photo->path;
        $unlink_card = public_path() . '/storage/Service/Photos/' . $photo->card;
        $unlink_thumb = public_path() . '/storage/Service/Photos/' . $photo->thumb;
        unlink($unlink);
        unlink($unlink_card);
        unlink($unlink_thumb);
        $photo->delete();
    }

    /**
     * 
     * Custom
     * API
     *  */
    public function photo(ServiceBasicInfo $serviceBasicInfo)
    {
        return $serviceBasicInfo->service_photos()->orderBy('created_at', 'desc')->get();
    } 

}
