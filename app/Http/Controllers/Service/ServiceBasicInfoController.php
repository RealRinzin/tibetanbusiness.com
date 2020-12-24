<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Service\ServiceBasicInfoResource;
use App\Service\ServiceBasicInfo;
use App\Service\ServicePhoto;
use App\Service\ServiceReviewReply;
use Illuminate\Support\Facades\Auth;

class ServiceBasicInfoController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
            \Image::make($request->banner)->save(public_path('/storage/Service/Banner/') . $name);
            $Original = \Image::make($request->banner)->save(public_path('/storage/Sale/Banner/') . $name);
        // Card 500 X
            $Original->resize(420, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            \Image::make($Original)->save(public_path('/storage/Service/Banner/') . $card);
        // Thumbnail 240 X 
            $Original->resize(220, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            \Image::make($Original)->save(public_path('/storage/Service/Banner/') . $thumb);
        }
        // return $name;
        $service = ServiceBasicInfo::create([
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'banner' => $name,
            'card' => $card,
            'thumb' => $thumb,
            'rate'=>0,
            'email' => $request->email,
            'location' => $request->location,
            'type' => $request->type,
            'opening_hour' => $request->opening_hour,
            'closing_hour' => $request->closing_hour,
            'address' => $request->address,
            'mobile_no' => $request->mobile_no,
            'description' => $request->description,
            'status' => true,
            'featured_ad' => false,
            'sidebar_ad' => false,
            'home_ad' => false,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
        ]);
        return $service;
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
        $service = ServiceBasicInfo::find($id);
        return $service->toArray($service);
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
        $service = ServiceBasicInfo::find($id);
        $service->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $service = ServiceBasicInfo::find($id);
        $unlink = public_path() . '/storage/Service/Banner/' . $service->banner;
        $unlink_card = public_path() . '/storage/Service/Banner/' . $service->card;
        $unlink_thumb = public_path() . '/storage/Service/Banner/' . $service->thumb;
        unlink($unlink);
        unlink($unlink_card);
        unlink($unlink_thumb);
        // Photos Delete
        $photos = ServicePhoto::where('service_basic_info_id', $id)->get();
        for ($i = 0; $i < $photos->count(); $i++) {
            $photos[$i]->delete();
            $photos_detach = public_path() . '/storage/Service/Photos/' . $photos[$i]->path;
            $photos_thumb = public_path() . '/storage/Service/Photos/' . $photos[$i]->thumb;
            unlink($photos_detach);
            unlink($photos_thumb);
        }
        // Delete
        $service->delete();
        $service->service_photos()->delete();
        $service->service_reviews()->delete();
        $service->service_working_days()->delete();
    }
    /**
     *  Updating Star rating
     * Restaurant
     * Star Rate
     * 
     *  */
    public function update_rate(Request $request, $id)
    {
        // return $request;
        $rate = ServiceBasicInfo::find($id);
        $rate->update($request->all());
    }
    // CUSTOM API
    public function view(ServiceBasicInfo $serviceBasicInfo, $id)
    {
        return view('service.show', ['id' => ServiceBasicInfo::find($id)]);
    }
    // Dashboard Edit
    public function service_edit(ServiceBasicInfo $serviceBasicInfo, $id)
    {
        if (Auth::user()->id === ServiceBasicInfo::find($id)->user_id) {
            return view('dashboard.service.edit', ['id' => ServiceBasicInfo::find($id)]);
        } else {
            // $this->authorize('rent_auth', $rentBasicInfo);
            // return redirect('/');
        }
    }
    public function all()
    {
        $service =  ServiceBasicInfo::where('status', '=', true)
            ->inRandomOrder()
            // ->limit('1')
            ->orderBy('created_at', 'desc')->get();
        return $service->toArray($service);
    }
    public function featured_ad()
    {
        $service =  ServiceBasicInfo::where('featured_ad', '=', true)
            ->inRandomOrder()
            ->limit('4')
            ->orderBy('created_at', 'desc')->get();
        return $service->toArray($service);
    }
    // Front
    public function home_ad()
    {
        $services =  ServiceBasicInfo::where('home_ad', '=', true)
            ->inRandomOrder()
            // ->limit('1')
            ->orderBy('created_at', 'desc')->get();
        return $services->toArray($services);
    }
    // Sidebar
    public function sidebar_ad()
    {
        $sales =  ServiceBasicInfo::where('sidebar_ad', '=', true)
            ->inRandomOrder()
            // ->limit('1')
            ->orderBy('created_at', 'desc')->get();
        return $sales->toArray($sales);
    }
    // sidebar
    public function sidebar(Request $request,$location){
        $services =  ServiceBasicInfo::where('location', 'like', "$location%")
        ->inRandomOrder()
        ->orderBy('created_at', 'desc')->paginate('4');
        return $services->toArray($services);

    }
    // user service
    public function user_service()
    {
        $service = Auth::user()->service_basic_infos;
        return $service->toArray($service);
    }
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
            \Image::make($request->banner)->save(public_path('/storage/Service/Banner/') . $name);
            $Original = \Image::make($request->banner)->save(public_path('/storage/Service/Banner/') . $name);
            // Card 500 X
            $Original->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            \Image::make($Original)->save(public_path('/storage/Service/Banner/') . $card);
            // Thumbnail 240 X 
            $Original->resize(240, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            \Image::make($Original)->save(public_path('/storage/Service/Banner/') . $thumb);
        }
        // upate
        $banner = ServiceBasicInfo::find($id);
        $unlink = public_path() . '/storage/Service/Banner/' . $banner->banner;
        $unlink_card = public_path() . '/storage/Service/Banner/' . $banner->card;
        $unlink_thumb = public_path() . '/storage/Service/Banner/' . $banner->thumb;
        unlink($unlink);
        unlink($unlink_card);
        unlink($unlink_thumb);
        $banner->update(['banner' => $name,'card'=>$card,'thumb'=>$thumb]);
    }
    // Status update
    public function status_update(Request $request, $id)
    {
        $status = ServiceBasicInfo::find($id);
        // update
        $status->update($request->all());
    }
    public function display($id)
    {
        return new ServiceBasicInfoResource(ServiceBasicInfo::find($id));
    }

    // Search View
    public function search_engine(Request $request)
    {
        return view('service.search', ['location' => $request->location]);
    }
    // Search Query
    public function search(Request $request)
    {
        $services = ServiceBasicInfo::where('name', 'like', "$request->name%")
        ->where('location', 'like', "%$request->location%")
        ->where('rate', 'like', "$request->rate%")
        ->where('type', 'like', "$request->type%")
        ->where('status', '=', '1')
            ->orderBy('created_at', 'desc')->paginate('3');
        return $services->toArray($services);
    }
}
