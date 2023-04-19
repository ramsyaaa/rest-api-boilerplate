<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function fetchAllUser()
    {
        try {
            $users = User::get();

            return response()->json([
                'success' => true,
                'message' => 'Successfully fetched all users',
                'data' => $users
            ]);
        } catch(\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function userDetail() {
        $userId = Auth::user()->id;
        try {
            $user = User::where('id', $userId)->select('name', 'email')->first();

            return response()->json([
                'success' => true,
                'message' => 'Successfully get user detail',
                'data' => $user
            ]);

        } catch(\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
