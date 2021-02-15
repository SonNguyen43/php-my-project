<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GroupMessage;
use Auth;
use App\Events\MessageGroup;

class GroupMessageController extends Controller
{
    function messages($group_id){
        $messages = GroupMessage::with(['user'])->where(['group_id'=>$group_id])->get();
        return $messages;
    }

    function send_group_message(Request $request){
        $group_messages = new GroupMessage;
        $group_messages->content    =  $request->content;
        $group_messages->user_id    =  Auth::user()->id;
        $group_messages->group_id   =  $request->group_id;
        $group_messages->save();

        # toOthers() gửi đến các user khác trong phòng TRỪ user tạo tin nhắn này
        broadcast(new MessageGroup($group_messages->load(['user','group'])))->toOthers(); 

        return ['status'=>'success','group_messages'=>$group_messages];
    }
}
