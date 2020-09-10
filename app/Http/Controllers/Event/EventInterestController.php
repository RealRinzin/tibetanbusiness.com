<?php

namespace App\Http\Controllers\Event;

use App\Event\EventInterest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;

class EventInterestController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $interest = EventInterest::create([
            'user_id' => Auth::user()->id,
            'event_basic_info_id' => $request->id,
        ]);
        return $interest;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $use, $id)
    {
        //
        $interest = EventInterest::find($id);
        $interest->delete();
    }
}
