<?php

namespace App\Http\Controllers\Sale;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Sale\SaleBasicInfoResource;
use App\Sale\SaleBasicInfo;
use App\Sale\SalePhoto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use MetaTag;
use Mockery\Undefined;

class SaleBasicInfoController extends Controller
{

    protected $path = '../public/storage/Sale/Banner/';
    protected $path_photo = '../public/storage/Sale/Photos/';

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->price == ''){
            $request->price = 0;
        }
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
            \Image::make($request->banner)->save($this->path . $name);
            $Original = \Image::make($request->banner)->save($this->path . $name);
            // Card 500 X
            $Original->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            \Image::make($Original)->save($this->path . $card);
            // Thumbnail 240 X 
            $Original->resize(240, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            \Image::make($Original)->save($this->path . $thumb);
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
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
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
        $unlink = $this->path . $sale->banner;
        $unlink_card= $this->path . $sale->card;
        $unlink_thumb = $this->path . $sale->thumb;
        unlink($unlink);
        unlink($unlink_card);
        unlink($unlink_thumb);
        // Photo Deletes
        $photo = SalePhoto::where('sale_basic_info_id', $id)->get();
        // Looping through all the photos
        for ($i=0; $i < $photo->count(); $i++) { 
            $photo[$i]->delete();
            $photos_detach = $this->path_photo . $photo[$i]->path;
            $photos_thumb = $this->path_photo . $photo[$i]->thumb;
            unlink($photos_detach);
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
            // ->limit('1')
            ->orderBy('created_at', 'desc')->get();
            
        return $sales->toArray($sales);
    }
    public function featured_ad()
    {
        $sales =  SaleBasicInfo::where('featured_ad', '=', true)
            ->inRandomOrder()
            // ->limit('1')
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
            ->limit('1')
            ->orderBy('created_at', 'desc')->get();
        return $sales->toArray($sales);
    }
    // Popup ad
    public function popup_ad()
    {
        $sales = SaleBasicInfo::where('popup_ad', '=', true)
            ->inRandomOrder()
            // ->limit('1')
            ->orderBy('created_at', 'desc')->get();
        return $sales->toArray($sales);
    }
    // sidebar location
    public function sidebar(Request $request,$location){
        $sales =  SaleBasicInfo::where('location', 'like', "$location%")
        ->where('status','=',true)
        ->inRandomOrder()
        ->orderBy('created_at', 'desc')->paginate('4');
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
        // Meta Description
        $meta = SaleBasicInfo::find($id);

        if($meta->price  > 0){
            MetaTag::set('title', $meta->name.' - Rs:'.$meta->price);
        }else{
            MetaTag::set('title', $meta->name.' - Tibetanbusiness.com');
        }
        MetaTag::set('description', $meta->location .$meta->address.' - '.$meta->description);
        MetaTag::set('image', asset('storage/Sale/Banner/'.$meta->banner));
        // Meta Description End
        return view('sale.show', ['id' => SaleBasicInfo::find($id)]);
    }
    // Dashboard Edit
    public function sale_edit(SaleBasicInfo $saleBasicInfo, $id)
    {
        // Meta Description
        $meta = SaleBasicInfo::find($id);
        if ($meta->price > 0) {
            MetaTag::set('title', $meta->name . ' - Rs:' . $meta->price);
        } else {
            MetaTag::set('title', $meta->name . ' - Tibetanbusiness.com');
        }
        MetaTag::set('title', $meta->name.' - '.$meta->price);
        MetaTag::set('description', $meta->location.' - '.$meta->description);
        MetaTag::set('image', asset('storage/Sale/Banner/'.$meta->banner));
        // Meta Description End
        if (Auth::user()->id === SaleBasicInfo::find($id)->user_id) {
            return view('dashboard.sale.edit', ['id' => SaleBasicInfo::find($id)]);
        } else {
            $this->authorize('sale_edit', $saleBasicInfo);
            return redirect('/');
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
            \Image::make($request->banner)->save($this->path . $name);
            $Original = \Image::make($request->banner)->save($this->path . $name);
            // Card 500 X
            $Original->resize(420, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            \Image::make($Original)->save($this->path . $card);
            // Thumbnail 240 X 
            $Original->resize(220, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            \Image::make($Original)->save($this->path . $thumb);
        }
        // upate
        $banner = SaleBasicInfo::find($id);
        $unlink = $this->path . $banner->banner;
        $unlink_card = $this->path . $banner->card;
        $unlink_thumb = $this->path . $banner->thumb;
        unlink($unlink);
        unlink($unlink_card);
        unlink($unlink_thumb);
        $banner->update(['banner' => $name,'card'=>$card,'thumb'=>$thumb]);
    }
    // Search View
    public function search_engine(Request $request)
    {
        MetaTag::set('title', $request->location);
        return view('sale.search', ['location' => $request->location]);
    }
    // Search Query
    public function search(Request $request)
    {
        $sales =  SaleBasicInfo::where('name', 'like', "$request->name%")
        ->where('location', 'like', "$request->location%")
        ->where('type', 'like',"$request->type%")
        ->whereBetween('price', [$request->price_min, $request->price_max])
        ->where('status', '=', '1')
        ->orderBy('created_at', 'desc')->paginate('10');
        return $sales->toArray($sales);
    }
}
