<?php

namespace App\Http\Controllers\API\v1;

use App\Contracts\v1\EmailsInterface;
use App\EmailTemplates;
use App\Http\Requests\EmailsRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmailsController extends Controller
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
    public function store(EmailsRequest $request, EmailsInterface $emails)
    {
        if($request->wantsJson()){
            //  return $request->all();
            $result =  $emails->storeEmails($request->all());
            if($result){
                return response()->json(['error'=>false,'message'=>'Email template created successfully '],200);
            }else{
                return response()->json(['error'=>true,'message'=>'Oop something went wrong'],500);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'Check Header'],406);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, EmailsInterface $emails)
    {
        if($request->wantsJson()){
            $result =   $emails->getEmailTemplates();
            if($result){
                return response()->json(['error'=>false,'message'=>'Emails templates found','data'=>$result],201);
            }else{
                return response()->json(['error'=>true,'message'=>"Oops something went wrong"],500);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'Check Header'],406);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id, EmailsInterface $emails)
    {
        if($request->wantsJson())
        {
            $result =   $emails->editEmail($id);
            if($result)
            {
                $data   =   [
                    'error'   => false,
                    'data'    => [
                        'emailEdited'    =>  $result
                    ]
                ];
                return response()->json($data, 200);

            }
            else
            {
                return response()->json(['error'=>true,'message'=>'Oops! something went Wrong'],400);
            }
        }
        else
        {
            return response()->json(['error'=>true,'message'=>'Accept Only JSON'],403);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmailsRequest $request, EmailsInterface $emails)
    {
        if($request->wantsJson()){
            $result =   $emails->updateEmailTemplate($request->all());
            if($result){
                return response()->json(['error'=>false,'message'=>'Email template updated','data'=>$result],201);
            }else{
                return response()->json(['error'=>true,'message'=>'Oop something went wrong'],401);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'Check Header'],406);
        }
    }
    public function generatePdf(Request $request,EmailsInterface $emails){
        if($request->wantsJson()){
            $result =   $emails->generatePdf($request->all());
            if($result){
                return response()->json(['error'=>false,'message'=>'Email template updated','data'=>$result],201);
            }else{
                return response()->json(['error'=>true,'message'=>'Oop something went wrong'],401);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'Check Header'],406);
        }
    }

}
