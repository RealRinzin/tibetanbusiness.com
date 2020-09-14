<?php

namespace App\Http\Controllers\Sale;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sale\SaleBasicInfo;
use App\Sale\SalePhoto;
use Illuminate\Support\Facades\Auth;

class SalePhotoController extends Controller
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
            for ($i=0; $i < $countPhotos; $i++) {
                $file_name = $_FILES['images']["tmp_name"][$i];
                // image extension extraction
                $extension = explode("/", $_FILES["images"]["type"][$i]);
                $name = time() . '.' . $extension[1];
                $thumb = time() . '-thumb.' . $extension[1];
            // Original
                \Image::make($file_name)->save(public_path('/storage/Sale/Photos/') . $name);
                $Original =  \Image::make($file_name)->save(public_path('/storage/Sale/Photos/') . $name);
            // thumb
                $Original->resize(200, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                \Image::make($Original)->save(public_path('/storage/Sale/Photos/') . $thumb);
            // Insert record
            // to Database
            $photo = SalePhoto::create([
                'sale_basic_info_id' => $request->id,
                'path' => $name,
                'thumb' => $thumb,
                'user_id' => Auth::user()->id,
            ]);
            }
        // die();
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
        $photo = SalePhoto::find($id);
        $unlink = public_path() . '/storage/Sale/Photos/' . $photo->path;
        $unlink_thumb = public_path() . '/storage/Sale/Photos/' . $photo->thumb;
        unlink($unlink);
        unlink($unlink_thumb);
        $photo->delete();
    }

    /**
     * 
     * Custom
     * API
     *  */
    public function photo(SaleBasicInfo $saleBasicInfo)
    {
        return $saleBasicInfo->sale_photos()->orderBy('created_at', 'desc')->get();
    } 
}
