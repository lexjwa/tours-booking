<?php

namespace App\Http\Controllers\API\v1;

use App\Contracts\v1\SettingInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function index(Request $request,SettingInterface $setting){
        if($request->wantsJson()){
            $result =   $setting->setting();
            if($result){
                return response()->json(['error'=>false,'message'=>'setting','data'=>$result],200);
            }else{
                return response()->json(['error'=>true,'message'=>'Oop something went wrong'],401);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'Check Header'],406);
        }
    }
    public function update(Request $request,SettingInterface $setting){
        if($request->wantsJson()){
            $result =   $setting->updateSetting($request->all());
            if($result){
                return response()->json(['error'=>false,'message'=>'setting updated','data'=>$result],201);
            }else{
                return response()->json(['error'=>true,'message'=>'Oop something went wrong'],401);
            }
        }else{
            return response()->json(['error'=>true,'message'=>'Check Header'],406);
        }
    }
}
