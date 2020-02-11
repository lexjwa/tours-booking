<?php

namespace App\Http\Controllers\API\v1;

use App\Contracts\v1\CampaignsInterface;
use App\Http\Requests\CampaignRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CampaignsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CampaignRequest $request,CampaignsInterface $campaigns)
    {

        if($request->wantsJson()){
            $result =   $campaigns->runCampaign($request->all());
            if($result){
                return response()->json(['error'=>false,'message'=>'Email sent'],200);
            }else{
                return response()->json(['error'=>true,'message'=>'Oop something went wrong'],500);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'Check Header'],406);
        }
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
    }
}
