<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Message;
use Validator;
use Response;
use GuzzleHttp;
use Carbon;

class MessageController extends Controller
{
    public function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'forum' => 'required|string|max:255',
            'content' => 'required|string'
        ]);

        if ($validator->fails()) {
            return abort(400);
        }

        date_default_timezone_set('Europe/Paris');


        $message = Message::create([
            'forum' => request('forum'),
            'author' => Auth::user()->name,
            'author_uuid' => Auth::user()->uuid,
            'content' => request('content')
        ]);

        $client = new GuzzleHttp\Client();
        // $res = $client->request('POST', 'localhost:8001/post', [
        $res = $client->request('POST', config('services.pusher.domain'), [
            'multipart' => [
                [
                    'name'     => 'key',
                    'contents' => config('services.pusher.key')
                ],
                [
                    'name'     => 'forum',
                    'contents' => $message->forum
                ],
                [
                    'name'     => 'id',
                    'contents' => $message->id
                ],
                [
                    'name'     => 'author',
                    'contents' => $message->author
                ],
                [
                    'name'     => 'author_uuid',
                    'contents' => $message->author_uuid
                ],
                [
                    'name'     => 'content',
                    'contents' => $message->content
                ],
                [
                    'name'     => 'created_at',
                    'contents' => now()
                ],
            ]
        ]);

        return response()->json(compact('message'));
    }
}
