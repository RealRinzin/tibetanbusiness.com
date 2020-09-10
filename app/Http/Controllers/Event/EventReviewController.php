<?php

namespace App\Http\Controllers\Event;

use App\Event\EventBasicInfo;
use App\Event\EventReview;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EventReviewController extends Controller
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
        $review = EventReview::create([
            'user_id' => Auth::user()->id,
            'event_basic_info_id' => $request->event_basic_info_id,
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
        //
        $review = EventReview::find($id);
        $review->update($request->all());
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
        $review = EventReview::find($id);
        // return $review;
        $review->delete();
    }
    /**
     * 
     * Custom api functions
     * 
     *  */
    public function review(EventBasicInfo $eventBasicInfo)
    {
        return $eventBasicInfo->event_reviews()->orderBy('created_at', 'desc')->paginate('2');
    }
}
