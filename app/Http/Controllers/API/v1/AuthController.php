<?php

namespace App\Http\Controllers\API\v1;

use App\Contracts\v1\AuthInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\CreateAdminUser;
use App\Http\Requests\editUserRequest;
use App\Http\Requests\resetPassword;
use App\Http\Requests\validatForgetEmail;
use App\Mail\InvitationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login(AuthRequest $request, AuthInterface $auth)
    {
        if ($request->wantsJson()) {
            $result = $auth->authentcateUser($request->all());
            if ($result) {
                $data = ['token'=>$result, 'user_detail'=>Auth::user()];

                return response()->json(['error'=>false, 'message'=>'User Authenticated', 'data'=>$data, 'userInfo'=>Auth::user()], 200);
            } else {
                return response()->json(['error'=>true, 'message'=>'Un-Authenticated Access'], 403);
            }
        } else {
            return response()->json(['error'=>true, 'message'=>'Check Header'], 406);
        }
    }

    public function create(CreateAdminUser $request, AuthInterface $auth)
    {
        if ($request->wantsJson()) {
            $result = $auth->createUser($request->all());
            if ($result) {
                Mail::to($result[0]->email)->send(new InvitationMail($result));

                return response()->json(['error'=>false, 'message'=>'User Created', 'data'=>$result], 201);
            } else {
                return response()->json(['error'=>true, 'message'=>'Un-Authenticated Access'], 403);
            }
        } else {
            return response()->json(['error'=>true, 'message'=>'Check Header'], 406);
        }
    }

    public function allUser(Request $request, AuthInterface $auth)
    {
        if ($request->wantsJson()) {
            $result = $auth->allUser();
            if ($result) {
                return response()->json(['error' => false, 'message' => 'User Created', 'data' => $result], 201);
            } else {
                return response()->json(['error' => true, 'message' => 'Un-Authenticated Access'], 403);
            }
        } else {
            return response()->json(['error'=>true, 'message'=>'Check header'], 406);
        }
    }

    public function allDetails(Request $request, $email, AuthInterface $auth)
    {
        //dd($email);
        if ($request->wantsJson()) {
            $result = $auth->allDetails($email);
            if ($result) {
                return response()->json(['error' => false, 'message' => 'User Created', 'data' => $result], 201);
            } else {
                return response()->json(['error' => true, 'message' => 'Un-Authenticated Access'], 403);
            }
        } else {
            return response()->json(['error'=>true, 'message'=>'Check header'], 406);
        }
    }

    public function eventPatricipents(Request $request, AuthInterface $auth)
    {
        if ($request->wantsJson()) {
            $result = $auth->eventPatricipents($request->id);
            if ($result) {
                return response()->json(['error' => false, 'message' => 'User Created', 'data' => $result], 201);
            } else {
                return response()->json(['error' => true, 'message' => 'Un-Authenticated Access'], 403);
            }
        } else {
            return response()->json(['error'=>true, 'message'=>'Check header'], 406);
        }
    }

    public function suspend(Request $request, AuthInterface $auth)
    {
        if ($request->wantsJson()) {
            $result = $auth->suspendAdmin($request->all());
            if ($result) {
                return response()->json(['error'=>false, 'message'=>'User Suspended', 'data'=>$result], 200);
            } else {
                return response()->json(['error'=>true, 'message'=>'Can not suspend'], 422);
            }
        } else {
            return response()->json(['error'=>true, 'message'=>'Check Header'], 406);
        }
    }

    public function restore(Request $request, AuthInterface $auth)
    {
        if ($request->wantsJson()) {
            $result = $auth->restoreAdmin($request->all());
            if ($result) {
                return response()->json(['error'=>false, 'message'=>'User Suspended', 'data'=>$result], 200);
            } else {
                return response()->json(['error'=>true, 'message'=>'Can not restore'], 422);
            }
        } else {
            return response()->json(['error'=>true, 'message'=>'Check Header'], 406);
        }
    }

    public function delete(Request $request, AuthInterface $auth)
    {
        if ($request->wantsJson()) {
            $result = $auth->deleteAdmin($request->all());
            if ($result) {
                return response()->json(['error'=>false, 'message'=>'User Suspended', 'data'=>$result], 200);
            } else {
                return response()->json(['error'=>true, 'message'=>'Can not delete'], 422);
            }
        } else {
            return response()->json(['error'=>true, 'message'=>'Check Header'], 406);
        }
    }

    public function editProfile(editUserRequest $request, AuthInterface $auth)
    {
        if ($request->wantsJson()) {
            $result = $auth->editProfile($request->all());
            if ($result) {
                return response()->json(['error'=>false, 'message'=>'Update Profile', 'data'=>$result], 200);
            } else {
                return response()->json(['error'=>true, 'message'=>"You can't delete this Event.Event has booking."], 422);
            }
        } else {
            return response()->json(['error'=>true, 'message'=>'Check Header'], 406);
        }
    }

    public function forgetPassword(validatForgetEmail $request, AuthInterface $auth)
    {
        if ($request->wantsJson()) {
            $result = $auth->forgetPassword($request->all());
            if ($result) {
                return response()->json(['error'=>false, 'message'=>'Forget Password'], 200);
            } else {
                return response()->json(['error'=>true, 'message'=>"You can't delete this Event.Event has booking."], 422);
            }
        } else {
            return response()->json(['error'=>true, 'message'=>'Check Header'], 406);
        }
    }

    public function resetPassword(resetPassword $request, AuthInterface $auth)
    {
        if ($request->wantsJson()) {
            $result = $auth->resetPassword($request->all());
            if ($result) {
                return response()->json(['error'=>false, 'message'=>'Password Reset'], 200);
            } else {
                return response()->json(['error'=>true, 'message'=>"You can't delete this Event.Event has booking."], 422);
            }
        } else {
            return response()->json(['error'=>true, 'message'=>'Check Header'], 406);
        }
    }
}
