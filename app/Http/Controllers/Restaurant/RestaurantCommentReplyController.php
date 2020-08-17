<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Restaurant\RestaurantComment;
use App\Restaurant\RestaurantCommentReply;
use Illuminate\Support\Facades\Auth;

class RestaurantCommentReplyController extends Controller
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
        // return $$request;
        $replies = RestaurantCommentReply::create([
            'user_id' => Auth::user()->id,
            'restaurant_comment_id' => $request->restaurant_comment_id,
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
        $reply = RestaurantCommentReply::find($id);
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
        $reply = RestaurantCommentReply::find($id);
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
        $reply = RestaurantCommentReply::find($id);
        $reply->delete();
    }
    // Reply
    public function reply(RestaurantComment $restaurantComment){
        return $restaurantComment->restaurant_comment_replies()->orderBy('created_at', 'desc')->paginate('2'); 
    }
}
