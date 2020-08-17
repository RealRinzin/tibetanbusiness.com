<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service\ServiceReview;
use App\Service\ServiceReviewReply;
use Illuminate\Support\Facades\Auth;

class ServiceReviewReplyController extends Controller
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
        $replies = ServiceReviewReply::create([
            'user_id' => Auth::user()->id,
            'service_review_id' => $request->service_review_id,
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
        $reply = ServiceReviewReply::find($id);
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
        $reply = ServiceReviewReply::find($id);
        $reply->update($request->all());
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
        $reply = ServiceReviewReply::find($id);
        $reply->delete();
    }
    // Reply
    public function reply(ServiceReview $serviceReview)
    {
        return $serviceReview->service_review_replies()->orderBy('created_at', 'desc')->paginate('2');
    }
}
