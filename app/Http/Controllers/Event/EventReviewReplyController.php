<?php

namespace App\Http\Controllers\Event;

use App\Event\EventReview;
use App\Event\EventReviewReply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EventReviewReplyController extends Controller
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
        $replies = EventReviewReply::create([
            'user_id' => Auth::user()->id,
            'event_review_id' => $request->event_review_id,
            'reply' => $request->reply,
            'name' => $request->name,
            'avatar' => $request->avatar,
        ]);
        return $replies;
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
        $reply = EventReviewReply::find($id);
        return $reply->toArray($reply);
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
    }
    // Reply
    public function reply(EventReview $eventReview)
    {
        return $eventReview->event_review_replies()->orderBy('created_at', 'desc')->paginate('2');
    }
}
