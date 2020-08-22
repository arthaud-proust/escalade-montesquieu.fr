<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Message;
use Validator;
use Response;

class MessageController extends Controller
{
    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'forum' => 'required|string|max:255',
            'content' => 'required|string'
        ]);

        $message = Message::create([
            'forum' => request('forum'),
            'author' => Auth::user()->name,
            'author_uuid' => Auth::user()->uuid,
            'content' => request('content')
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return response()->json(Message::all());
    }
}
