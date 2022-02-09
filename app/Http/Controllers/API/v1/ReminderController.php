<?php

namespace App\Http\Controllers\API\v1;

use App\Contracts\v1\ReminderInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReminderRequest;
use Illuminate\Http\Request;

class ReminderController extends Controller
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
    public function setReminders(ReminderRequest $request, ReminderInterface $reminder)
    {
        if ($request->wantsJson()) {
            //  return $request->all();
            $result = $reminder->setReminder($request->all());
            if ($result) {
                return response()->json(['error'=>false, 'message'=>'reminder set '], 200);
            } else {
                return response()->json(['error'=>true, 'message'=>'Oop something went wrong'], 500);
            }
        } else {
            return response()->json(['error'=>true, 'message'=>'Check Header'], 406);
        }
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
