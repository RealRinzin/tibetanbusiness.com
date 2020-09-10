<?php

namespace App\Http\Controllers\Job;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Job\JobQuestion;
use App\Job\JobQuestionReply;
use Illuminate\Contracts\Queue\Job;
use Illuminate\Support\Facades\Auth;

class JobQuestionReplyController extends Controller
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
        $replies = JobQuestionReply::create([
            'user_id' => Auth::user()->id,
            'job_question_id' => $request->job_question_id,
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
        $reply = JobQuestionReply::find($id);
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
        $reply = JobQuestionReply::find($id);
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
        $reply = JobQuestionReply::find($id);
        $reply->delete();
    }
    // Check
    public function reply(JobQuestion $jobQuestion)
    {
        return $jobQuestion->job_question_replies()->orderBy('created_at', 'desc')->paginate('2');
    }
}
