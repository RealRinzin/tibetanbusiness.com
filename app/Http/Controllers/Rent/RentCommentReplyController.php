<?php

namespace App\Http\Controllers\Rent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rent\RentComment;
use App\Rent\RentCommentReply;
use Illuminate\Support\Facades\Auth;

class RentCommentReplyController extends Controller
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
        // return $$request;
        $replies = RentCommentReply::create([
            'user_id' => Auth::user()->id,
            'rent_comment_id' => $request->rent_comment_id,
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
        $reply = RentCommentReply::find($id);
        return $reply->toArray($reply);
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
        $reply = RentCommentReply::find($id);
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
        $reply = RentCommentReply::find($id);
        $reply->delete();
    }
    // Reply
    public function reply(RentComment $rentComment)
    {
        return $rentComment->rent_comment_replies()->orderBy('created_at', 'desc')->paginate('2');
    }
}
