<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MessageUser;
use App\FriendMessage;
use Auth;
use DB;

class FriendMessageController extends Controller
{
    function messages($friend_id){
        $user_id = Auth::user()->id;
        $to_user_id = $friend_id;

        # WHERE (a = 1 AND b =2 ) OR (a = 2 AND b = 1)
        $messages = FriendMessage::with(['user'])->where(function ($query) use ($user_id, $to_user_id) {
            $query->where(['user_id'=>$user_id,'to_user_id'=>$to_user_id]);
        })->orWhere(function ($query) use ($user_id, $to_user_id) {
            $query->where(['user_id'=>$to_user_id,'to_user_id'=>$user_id]);
        })->get();
        
        return $messages;
    }

    function send_user_message(Request $request){
        $user_message = new FriendMessage;
        $user_message->content    =  $request->content;
        $user_message->user_id    =  Auth::user()->id;
        $user_message->to_user_id =  $request->to_user_id;
        $user_message->save();

        # toOthers() gửi đến các user khác trong phòng TRỪ user tạo tin nhắn này
        broadcast(new MessageUser($user_message->load(['user'])))->toOthers();

        return ['status'=>'success', 'user_message'=>$user_message];
    }
}
