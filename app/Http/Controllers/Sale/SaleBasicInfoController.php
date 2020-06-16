<?php

namespace App\Http\Controllers\Sale;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Sale\SaleBasicInfoResource;
use App\Sale\SaleBasicInfo;
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
        //
        //
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
            \Image::make($request->banner)->save(public_path('/storage/Sale/Banner/') . $name);
        }
        // return $name;
        $sale = SaleBasicInfo::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'banner' => $name,
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
        //
        $sale = SaleBasicInfo::find($id);
        // $unlink = public_path() . '/storage/Event/Banner/' . $event->banner;
        // unlink($unlink);
        $sale->delete();
    }

    // CUSTOM API
    public function all()
    {
        $sales =  SaleBasicInfo::where('status', '=', true)
            ->orderBy('created_at', 'desc')->get();
        return $sales->toArray($sales);
    }
    public function featured_ad()
    {
        $sales =  SaleBasicInfo::where('featured_ad', '=', true)
            ->orderBy('created_at', 'desc')->get();
        return $sales->toArray($sales);
    }
    // Front
    public function home_ad()
    {
        $sales =  SaleBasicInfo::where('home_ad', '=', true)
            ->orderBy('created_at', 'desc')->get();
        return $sales->toArray($sales);
    }
    // Sidebar
    public function sidebar_ad()
    {
        $sales =  SaleBasicInfo::where('sidebar_ad', '=', true)
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
            \Image::make($request->banner)->save(public_path('/storage/Sale/Banner/') . $name);
        }
        // upate
        $banner = SaleBasicInfo::find($id);
        // $unlink = public_path() . '/storage/Sale/Banner/' . $banner->banner;
        // unlink($unlink);
        $banner->update(['banner' => $name]);
    }
}
