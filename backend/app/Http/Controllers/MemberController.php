<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class MemberController extends Controller
{
    //
    public function index()
    {
        $users = User::all();

        return response()->json([
            'status'     => 200,
            'users'      => $users,
        ]);
    }
}