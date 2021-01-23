<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class GetUserController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function __invoke(Request $request, $user_id = NULL)
    {
        if(!empty($user_id)) {
            $get_user_id = $user_id;
        } else {
            $get_user_id = $request->user()->id;
        }
        $user = User::find($get_user_id);
        if($user) {
            return new UserResource($user);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'user not found',
                'data' => ''
            ], 401);
        }
    }

    public function get_user_for_project()
    {
        $user = User::whereIn('user_level_id', [102, 103])->get();
        return UserResource::collection($user);
    }
}
