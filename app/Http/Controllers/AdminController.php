<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Member;
use App\Info;
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




    public function getMembers(Request $request)
    {
        $members = Member::select('name', 'class')->get();
        return view('admin.members', compact('members'));
    }

    public function addMember(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:members,name',
            'classroom' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages());
        }
        if(Member::where('name', request('name'))->count() > 0) {
            return response('already exist')->status(400);
        } else {
            Member::create([
                'name' => request('name'),
                'class' => request('classroom'),
            ]);
            return response('ok')->status(200);
        }
    }

    public function destroyMember(Request $request, $name)
    {
        if(!$member = Member::where('name', $name)->first()) {
            return response('not found')->status(404);
        }
        if($member->name !== Auth::User()->name) {
            $member->delete();
            return response('ok')->status(200);
        } else {
            return response('it is you')->status(400);
        }

    }


    
    
    public function getInfos(Request $request)
    {
        $infos = Info::all();
        return view('admin.infos', compact('infos'));
    }

    public function addInfo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:info,title',
            'content' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->messages());
        }
        $info = Info::create([
            'title' => request('title'),
            'content' => request('content'),
        ]);
        return response()->json('ok', 200);

    }

    public function modifyInfo(Request $request, $id)
    {
        if(!$info = Info::where('id', $id)->first()) {
            return response()->json('not found', 404);
        }
        $info->title = request('title');
        $info->content = request('content');
        $info->save();
        return response()->json('ok',200);
    }

    public function destroyInfo(Request $request, $id)
    {
        if(!$info = Info::where('id', $id)->first()) {
            return response()->json('not found', 404);
        }
        $info->delete();
        return response()->json('ok',200);
    }

}

