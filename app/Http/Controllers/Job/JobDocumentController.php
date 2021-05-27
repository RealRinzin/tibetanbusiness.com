<?php

namespace App\Http\Controllers\Job;

use App\Job\JobDocument;
use App\Job\JobBasicInfo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class JobDocumentController extends Controller
{
    protected $path = '../public/storage/Job/Documents/';

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function file(Request $request){
        $file_name = explode('.',$request->file_name);
        $file_extension = $file_name[sizeof($file_name) - 1];

        // File Upload;
        $diir = '';
        if ($request->cv) {
            $cv = explode(";base64,", $request->cv);
            $cv_base64 = base64_decode($cv[1]);
            $diir = uniqid() .'.'.$file_extension;
            file_put_contents(($this->path) . $diir, $cv_base64);
        }
        $apply = JobDocument::create([
            'job_basic_info_id' => $request->job_basic_info_id,
            'user_id' => Auth::user()->id,
            'path' => $diir,
            'extension' => $file_extension,
        ]);
        return $apply;
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
        // Counting the photos
        $countPhotos = count($_FILES['images']['name']);
        // Looping the files
        for ($i = 0; $i < $countPhotos; $i++) {
            // File Loop
            $file_name = $_FILES['images']["tmp_name"][$i];
            // image extension extraction
            $extension = explode("/", $_FILES["images"]["type"][$i]);
            $name = time() . $i . '.' . $extension[1];
            $thumb = time() . $i . '-thumb.' . $extension[1];
            // Original
            \Image::make($file_name)->save($this->path . $name);
            $Original =  \Image::make($file_name)->save($this->path . $name);
            // thumb
            $Original->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            \Image::make($Original)->save($this->path . $thumb);
            // Inserting
            // Recording in Database
            $jobDocument = JobDocument::create([
                'job_basic_info_id' => $request->id,
                'path' => $name,
                'thumb' => $thumb,
                'extension' => 'image',
                'user_id' => Auth::user()->id,
            ]);
        }
        return response()->json([
            "message" => "Done"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Job\JobDocument  $jobDocument
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $document = JobDocument::find($id);
        // return $photo->path;
        $unlink = $this->path . $document->path;
        // $thumb = $this->path . $document->thumb;
        // Unlinking all the photos
        unlink($unlink);
        // unlink($thumb);
        // Deleting records
        $document->delete();
    }

    // Documents
    public function document(JobBasicInfo $jobBasicInfo){
        return $jobBasicInfo->job_documents()->orderBy('created_at', 'desc')->get(); 
    }
}
