<?php

namespace App\Http\Controllers\Rent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rent\RentComment;
use Illuminate\Support\Facades\Auth;

class RentCommentController extends Controller
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
        // return $request;
        $comments = RentComment::create([
            'user_id' => Auth::user()->id,
            'rent_basic_info_id' => $request->rent_basic_info_id,
            'rate' => $request->rate,
            'comment' => $request->comment,
            'name' => $request->name,
            'avatar' => $request->avatar,
        ]);
        return $comments;
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
        $comment = RentComment::find($id);
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
        $comment = RentComment::find($id);
        $comment->delete();
    }

    /**
     * 
     * Custom
     *  */
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function comment(Request $request, $id)
    {
        // $comments = RestaurantComment::all();
        $comments = RentComment::where('rent_basic_info_id', '=', "$id")
            ->orderBy('created_at', 'desc')->paginate(3);
        return $comments->toArray($comments);
    }

}
