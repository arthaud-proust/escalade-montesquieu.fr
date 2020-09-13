<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Http\Request;
use Validator;
use Response;

class AdminController extends Controller
{
    public function getPanel(Request $request)
    {
        $users = User::where('level', '1')->get();
        $modos = User::where('level', '2')->get();
        $admins = User::where('level', '3')->get();
        return view('admin.panel', compact('users', 'modos', 'admins'));
    }

    public function getUsers(Request $request)
    {
        $users = User::where('level', '1')->get();
        $modos = User::where('level', '2')->get();
        $admins = User::where('level', '3')->get();
        return view('admin.users', compact('users', 'modos', 'admins'));
    }

    public function modifyUser(Request $request, $uuid)
    {
        if(!$user = User::where('uuid', $uuid)->first()) {
            return response('not found')->status(404);
        }
        $user->level = request('level', $user->level);
        $user->save();
        return response()->json($user);
    }

    public function destroyUser(Request $request, $uuid)
    {
        if(!$user = User::where('uuid', $uuid)->first()) {
            return response('not found')->status(404);
        }
        $user->delete();
        return response('ok')->status(200);

    }
    
    

}

