<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     * @group Message
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $other_users = User::where('id' , '!=' , $user->id)->withCount('noread_messages')->get();
        return response()->json(array(
            'data' => $other_users
        ) , 200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * @group Message
     * @bodyParam to_user_id Example:1
     * @bodyParam body string Example:hello
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $new_message = new Message();
        $new_message->from_user_id = $user->id;
        $new_message->to_user_id = $request->to_user_id;
        $new_message->body = $request->body;
        $new_message->save();
        return response('Message sended' , 200);
    }

    /**
     * Display the specified resource.
     * @group Message
     *
     * @param  id Example:1
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $user2 = User::find($id);
        if ($user2){
            $noread_messages = Message::where('from_user_id' , $user2->id)->where('to_user_id' , $user->id)->where('status' , 0)->get();
            foreach ($noread_messages as $noread_message) {
                $noread_message->status = 1;
                $noread_message->update();
            }
            $all_messages = Message::
            where(function ($query) use ($user , $user2){
                $query->where('from_user_id' , $user2->id);
                $query->where('to_user_id' , $user->id);
            })
                ->orWhere(function ($query) use ($user , $user2){
                $query->where('to_user_id' , $user2->id);
                $query->where('from_user_id' , $user->id);
            })->get();
            return response()->json(array(
                'data' => $all_messages
            ));
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
