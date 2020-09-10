<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Restaurant\RestaurantComment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RestaurantCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments =  RestaurantComment::all();
        return $comments->toArray($comments);
        // return "message comments";
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function comment(Request $request,$id){
        // return $id;
        // $comments = RestaurantComment::all();
        $comments = RestaurantComment::where('restaurant_basic_info_id','=',"$id")
            ->orderBy('created_at', 'desc')->paginate(3);
        return $comments->toArray($comments);

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
        // $comments = RestaurantComment::create($request->all());

        $comments = RestaurantComment::create([
            'user_id' => Auth::user()->id,
            'restaurant_basic_info_id' => $request->restaurant_basic_info_id,
            'rate' => $request->rate,
            'comment' => $request->comment,
            'name' => $request->name,
            'avatar' => $request->avatar,
        ]);
        return $comments;
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
        $comment = RestaurantComment::find($id);
        $comment->update($request->all());
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
        $comment = RestaurantComment::find($id);
        $comment->delete();
        $comment->restaurant_comment_replies()->delete();

    }
}
