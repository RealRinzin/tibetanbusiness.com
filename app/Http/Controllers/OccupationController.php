<?php

namespace App\Http\Controllers;

use App\Occupation;
use Illuminate\Http\Request;

class OccupationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $occupations =  Occupation::orderBy('name', 'asc')->get();
        return $occupations->toArray($occupations);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Occupation  $occupation
     * @return \Illuminate\Http\Response
     */
    public function show(Occupation $occupation)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Occupation  $occupation
     * @return \Illuminate\Http\Response
     */
    public function edit(Occupation $occupation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Occupation  $occupation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Occupation $occupation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Occupation  $occupation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Occupation $occupation)
    {
        //
    }

    public function map(){
        error_reporting(0);
        $query = json_decode($_GET['query']);
        // return str_replace(' ','%2B',$query);
        // return $query;
        $token_url = "https://outpost.mapmyindia.com/api/security/oauth/token?grant_type=client_credentials";

        $access_token="";
        $token_type="";

        $curl_token = curl_init();
        curl_setopt($curl_token, CURLOPT_URL, $token_url);
        curl_setopt($curl_token, CURLOPT_POST, 1);
        curl_setopt($curl_token, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_token, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl_token, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl_token, CURLOPT_POSTFIELDS,
                    "client_id=Seqfg8twlRBo-3pSEMBvET4v8zcKrowBhTIaM6v9_QvyzFsDTZ1zOtItc9WmBWGBShpZmoAnspxMOXarLUeC-g==&client_secret=oGQdcwUsRjMuSIta137V70c3Vme0qoHR0UCEPkdUaiV9qNmuxO6T_f_YZDfaG-nqvzG-s9rVlwL4S41yx5DWF0TjnqSYvOJJ");
        $result_token = curl_exec($curl_token);
        $json = json_decode($result_token, true);
        $access_token = $json['access_token'];
        $token_type = $json['token_type'];
        curl_close($curl_token);
        // Fetching the data
        $url="https://atlas.mapmyindia.com/api/places/search/json?query=".str_replace(' ', '%2B', $query);
        $header = array();
        $header[] = 'Content-length: 0';
        $header[] = 'Content-type: application/json';
        $header[] = 'Authorization: '.$token_type.' '.$access_token.'';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_VERBOSE, 1);
        curl_setopt($curl, CURLOPT_HEADER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        $result = curl_exec($curl);
        $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $response_header[] =explode("\r\n", substr($result, 0, $header_size));
        $body[] = substr($result, $header_size);

        curl_close($curl);
        if($http_status=='200')
        {
            $res['status']='success';
            $res['data']=$body;
            echo json_encode($res);
        }
        elseif($http_status=='400')
        {
            $res['status']='fail';
            $res['data']="No result found";
            echo json_encode($res);
        }
        else{
            $res['status']='fail';
            $res['data']=str_replace("message:", "", $response_header[0][5]);
            echo json_encode($res);
        }
    }
}
