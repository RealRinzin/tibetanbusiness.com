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
        // return $request;
        if (count($request->images)) {
            foreach ($request->images as $image) {
                $photo = SalePhoto::create([
                    'sale_basic_info_id' => $request->id,
                    'path' => $image->store(''),
                    'user_id' => Auth::user()->id,
                ]);
                // $image->store('public\images');
                $image->store('public\Sale\Photos');
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
        $photo = SalePhoto::find($id);
        $unlink = public_path() . '/storage/Sale/Photos/' . $photo->path;
        unlink($unlink);
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
