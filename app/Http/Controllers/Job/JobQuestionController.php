<?php

namespace App\Http\Controllers\Job;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Job\JobAnswerResource;
use App\Http\Resources\Job\JobBasicInfoResource;
use App\Http\Resources\Job\JobQuestionResource;
use App\Job\JobAnswer;
use App\Job\JobBasicInfo;
use App\Job\JobQuestion;
use App\User;
use Illuminate\Support\Facades\Auth;

class JobQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(JobBasicInfo $jobBasicInfo)
    {
        return $jobBasicInfo->job_questions()->paginate('1'); 
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
        // return $request;
        $question = JobQuestion::create([
            'user_id' => Auth::user()->id,
            'job_basic_info_id' => $request->job_basic_info_id,
            'question' => $request->question,
            'name' => $request->name,
            'avatar' => $request->avatar,
        ]);
        return $question;
    }
    // reply
    public function reply_store(Request $request){

        $reply = JobQuestion::create([
            'user_id' => Auth::user()->id,
            'job_basic_info_id' => $request->job_basic_info_id,
            'job_question_id' => $request->job_question_id,
            'question' => $request->reply,
            'name' => $request->name,
            'avatar' => $request->avatar,
        ]);
        return $reply;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(JobBasicInfo $jobBasicInfo)
    {
        return $jobBasicInfo->job_questions()->paginate('2');

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
        $question = JobQuestion::find($id);
        $question->update($request->all());
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
        $question = JobQuestion::find($id);
        // $unlink = public_path() . '/storage/Event/Banner/' . $event->banner;
        // unlink($unlink);
        $question->delete();
        // $restaurant->restaurant_comments()->delete();
    }

    // All comments
    public function view(JobQuestion $jobQuestion,$id){
        return $jobQuestion->replies;
    }
    // Questions
    public function question(JobBasicInfo $jobBasicInfo){
        return $jobBasicInfo->job_questions()->orderBy('created_at', 'desc')->paginate('5'); 
    }

    public function replies(JobQuestion $jobQuestion)
    {
        // return $jobQuestion;
        return $jobQuestion->replies()->orderBy('created_at', 'desc')->paginate('2'); 
    }


}
