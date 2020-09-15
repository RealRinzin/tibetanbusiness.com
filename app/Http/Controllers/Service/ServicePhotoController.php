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
            $name = time() .$i. '.' . $extension[1];
            $thumb = time() .$i. '-thumb.' . $extension[1];
            // Original
            \Image::make($file_name)->save(public_path('/storage/Service/Photos/') . $name);
            $Original =  \Image::make($file_name)->save(public_path('/storage/Service/Photos/') . $name);
            // thumb
            $Original->resize(120, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            \Image::make($Original)->save(public_path('/storage/Service/Photos/') . $thumb);
            // Insert record
            // to Database
            $photo = ServicePhoto::create([
                'service_basic_info_id' => $request->id,
                'path' => $name,
                'thumb' => $thumb,
                'user_id' => Auth::user()->id,
            ]);
        }
        return response()->json([
            "message" => "Done"
        ]);
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
        $unlink_thumb = public_path() . '/storage/Service/Photos/' . $photo->thumb;
        unlink($unlink);
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
