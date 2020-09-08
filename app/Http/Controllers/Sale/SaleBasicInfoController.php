<?php

namespace App\Http\Controllers\Sale;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Sale\SaleBasicInfoResource;
use App\Sale\SaleBasicInfo;
use App\Sale\SalePhoto;
use Illuminate\Support\Facades\Auth;

class SaleBasicInfoController extends Controller
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

        // Image upload script in php
        if ($request->banner) {
            $name = time() . '.'
                . explode('/', explode(
                    ':',
                    substr(
                        $request->banner,
                        0,
                        strpos($request->banner, ';')
                    )
                )[1])[1];
            // Card
            $card = time() . '-card.'
                . explode('/', explode(
                    ':',
                    substr(
                        $request->banner,
                        0,
                        strpos($request->banner, ';')
                    )
                )[1])[1];
            // Thumb
            $thumb = time() . '-thumb.'
                . explode('/', explode(
                    ':',
                    substr(
                        $request->banner,
                        0,
                        strpos($request->banner, ';')
                    )
                )[1])[1];
            // Images
            \Image::make($request->banner)->save(public_path('/storage/Sale/Banner/') . $name);
            $Original = \Image::make($request->banner)->save(public_path('/storage/Sale/Banner/') . $name);
            // Card 500 X
            $Original->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            \Image::make($Original)->save(public_path('/storage/Sale/Banner/') . $card);
            // Thumbnail 240 X 
            $Original->resize(240, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            \Image::make($Original)->save(public_path('/storage/Sale/Banner/') . $thumb);
        }
        // Database Record
        // Insertion
        $sale = SaleBasicInfo::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'banner' => $name,
            'card' => $card,
            'thumb' => $thumb,
            'type' => $request->type,
            'location' => $request->location,
            'total_item' => $request->total_item,
            'address' => $request->address,
            'mobile_no' => $request->mobile_no,
            'price' => $request->price,
            'description' => $request->description,
            'status' => true,
            'featured_ad' => false,
            'sidebar_ad' => false,
            'home_ad' => false,

        ]);
        return $sale;
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
        $sale = SaleBasicInfo::find($id);
        return $sale->toArray($sale);
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
        $sale = SaleBasicInfo::find($id);
        $sale->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sale = SaleBasicInfo::find($id);
        $unlink = public_path() . '/storage/Sale/Banner/' . $sale->banner;
        $unlink_card= public_path() . '/storage/Sale/Banner/' . $sale->card;
        $unlink_thumb = public_path() . '/storage/Sale/Banner/' . $sale->thumb;
        unlink($unlink);
        unlink($unlink_card);
        unlink($unlink_thumb);
        // Photo Deletes
        $photo = SalePhoto::where('sale_basic_info_id', $id)->get();
        // Looping through all the photos
        for ($i=0; $i < $photo->count(); $i++) { 
            $photo[$i]->delete();
            $photos_detach = public_path() . '/storage/Sale/Photos/' . $photo[$i]->path;
            $photos_card = public_path() . '/storage/Sale/Photos/' . $photo[$i]->card;
            $photos_thumb = public_path() . '/storage/Sale/Photos/' . $photo[$i]->thumb;
            unlink($photos_detach);
            unlink($photos_card);
            unlink($photos_thumb);
        }
        // Delete
        $sale->delete();
        $sale->sale_photos()->delete();
    }

    // CUSTOM API
    public function all()
    {
        $sales =  SaleBasicInfo::where('status', '=', true)
            ->inRandomOrder()
            ->limit('4')
            ->orderBy('created_at', 'desc')->get();
            
        return $sales->toArray($sales);
    }
    public function featured_ad()
    {
        $sales =  SaleBasicInfo::where('featured_ad', '=', true)
            ->inRandomOrder()
            ->limit('4')
            ->orderBy('created_at', 'desc')->get();
        return $sales->toArray($sales);
    }
    // Front
    public function home_ad()
    {
        $sales =  SaleBasicInfo::where('home_ad', '=', true)
            ->orderBy('created_at', 'desc')
            ->limit('4')
            ->inRandomOrder()->get();
        return $sales->toArray($sales);
    }
    // Sidebar
    public function sidebar_ad()
    {
        $sales =  SaleBasicInfo::where('sidebar_ad', '=', true)
            ->inRandomOrder()
            ->limit('4')
            ->orderBy('created_at', 'desc')->get();
        return $sales->toArray($sales);
    }
    // User Job
    public function user_sale()
    {
        $jobs = Auth::user()->sale_basic_infos;
        return $jobs->toArray($jobs);
    }
    // Update status
    public function status_update(Request $request, $id)
    {
        // return $id;
        $status = SaleBasicInfo::find($id);
        // update
        $status->update($request->all());
    }
    // Display
    public function view(SaleBasicInfo $saleBasicInfo, $id)
    {
        return view('sale.show', ['id' => SaleBasicInfo::find($id)]);
    }
    // Dashboard Edit
    public function sale_edit(SaleBasicInfo $saleBasicInfo, $id)
    {
        if (Auth::user()->id === SaleBasicInfo::find($id)->user_id) {
            return view('dashboard.sale.edit', ['id' => SaleBasicInfo::find($id)]);
        } else {
            // $this->authorize('rent_auth', $rentBasicInfo);
            // return redirect('/');
        }
    }
    // Display page
    public function display($id)
    {
        return new SaleBasicInfoResource(SaleBasicInfo::find($id));
        // $sale = SaleBasicInfo::find($id);
        // return $sale->toArray($sale);
    }
    // Banner update
    public function banner_update(Request $request, $id)
    {
        // return $request;
        $name = '';
        // Image upload script in php
        if ($request->banner) {
            $name = time() . '.'
                . explode('/', explode(
                    ':',
                    substr(
                        $request->banner,
                        0,
                        strpos($request->banner, ';')
                    )
                )[1])[1];
            // Card
            $card = time() . '-card.'
                . explode('/', explode(
                    ':',
                    substr(
                        $request->banner,
                        0,
                        strpos($request->banner, ';')
                    )
                )[1])[1];
            // Thumb
            $thumb = time() . '-thumb.'
                . explode('/', explode(
                    ':',
                    substr(
                        $request->banner,
                        0,
                        strpos($request->banner, ';')
                    )
                )[1])[1];
            \Image::make($request->banner)->save(public_path('/storage/Sale/Banner/') . $name);
            $Original = \Image::make($request->banner)->save(public_path('/storage/Sale/Banner/') . $name);
            // Card 500 X
            $Original->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            \Image::make($Original)->save(public_path('/storage/Sale/Banner/') . $card);
            // Thumbnail 240 X 
            $Original->resize(240, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            \Image::make($Original)->save(public_path('/storage/Sale/Banner/') . $thumb);
        }
        // upate
        $banner = SaleBasicInfo::find($id);
        $unlink = public_path() . '/storage/Sale/Banner/' . $banner->banner;
        $unlink_card = public_path() . '/storage/Sale/Banner/' . $banner->card;
        $unlink_thumb = public_path() . '/storage/Sale/Banner/' . $banner->thumb;
        unlink($unlink);
        unlink($unlink_card);
        unlink($unlink_thumb);
        $banner->update(['banner' => $name,'card'=>$card,'thumb'=>$thumb]);
    }
    // Search View
    public function search_engine(Request $request)
    {
        return view('sale.search', ['location' => $request->location]);
    }
    // Search Query
    public function search(Request $request)
    {
        $sales =  SaleBasicInfo::where('name', 'like', "$request->name%")
        ->where('location', 'like', "$request->location%")
        ->where('type', 'like',"$request->type%")
        // ->where('price', '<=', "$request->price")
        ->whereBetween('price', [$request->price_min, $request->price_max])
        ->where('status', '=', '1')
        ->orderBy('created_at', 'desc')->paginate('3');
        return $sales->toArray($sales);
    }
}
