<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\ServiceBasicInfo;
use App\Service\ServiceReview;
use Illuminate\Support\Facades\Auth;

class ServiceReviewController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        //
        $review = ServiceReview::create([
            'user_id' => Auth::user()->id,
            'service_basic_info_id' => $request->service_basic_info_id,
            'rate' => $request->rate,
            'review' => $request->review,
            'name' => $request->name,
            'avatar' => $request->avatar,
        ]);
        return $review;
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

        $service = ServiceReview::find($id);
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
        $review = ServiceReview::find($id);
        $review->delete();
    }
    public function review(ServiceBasicInfo $serviceBasicInfo)
    {
        return $serviceBasicInfo->service_reviews()->orderBy('created_at', 'desc')->paginate('2');

    }
}
