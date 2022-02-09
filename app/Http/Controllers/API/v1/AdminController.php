<?php

namespace App\Http\Controllers\API\v1;

use App\Contracts\v1\AdminInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\participantRequest;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, AdminInterface $admin)
    {
        if ($request->wantsJson()) {
            $result = $admin->getUsers();
            if ($result) {
                return response()->json(['error'=>false, 'message'=>'User List', 'data'=>$result], 200);
            } else {
                return response()->json(['error'=>true, 'message'=>'Un-Authenticated Access'], 403);
            }
        } else {
            return response()->json(['error'=>true, 'message'=>'Check Header'], 406);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(participantRequest $request, AdminInterface $admin)
    {
        if ($request->wantsJson()) {
            $result = $admin->createParticipant($request->all());
            if ($result) {
                return response()->json(['error'=>false, 'message'=>'participant created', 'data'=>$result], 201);
            } else {
                return response()->json(['error'=>true, 'message'=>'oop something went wrong'], 403);
            }
        } else {
            return response()->json(['error'=>true, 'message'=>'check header'], 406);
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
