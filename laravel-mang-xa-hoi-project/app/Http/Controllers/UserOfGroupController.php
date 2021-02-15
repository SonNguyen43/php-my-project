<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserOfGroup;

class UserOfGroupController extends Controller
{
    function add(Request $request){
        $group_id = $request->group_id;
        $friend_id = $request->friend_id;

        $count_user_of_group = UserOfGroup::where(['user_id'=>$friend_id,'group_id'=>$group_id])->count();

        # đã trong nhóm và không thêm vào nữa
        if($count_user_of_group > 0){
            return ['status'=>'exist'];
        }else{
            $user_of_group = new UserOfGroup;
            $user_of_group->user_id = $friend_id;
            $user_of_group->group_id = $group_id;
            $user_of_group->save();

            return ['status'=>'success'];
        }
    }
}
