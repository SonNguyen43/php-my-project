<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GroupMessage;
use App\UserOfGroup;
use App\Group;
use Auth;
use DB;

class GroupController extends Controller
{
    function create(Request $request){
        $group = new Group;
        $group->name = $request->name;
        $group->user_id = Auth::user()->id;
        $group->save();

        # thêm user vừa tạo vào user_of_group luôn
        $user_of_group = new UserOfGroup;
        $user_of_group->user_id = Auth::user()->id;
        $user_of_group->group_id = $group->id;
        $user_of_group->save();

        return ['status'=>'success'];
    }

    function all_group_of_user(){
        $user_id = Auth::user()->id;
        $groups = DB::select("  SELECT groups.* FROM groups,user_of_groups
                                WHERE groups.id = user_of_groups.group_id
                                AND user_of_groups.user_id = $user_id ORDER BY id DESC");
        return $groups;
    }

    function info_group(Request $request){
        $group_id = $request->group_id;
        $group = Group::with(['user'])->where(['id'=>$group_id])->get();
        return $group;
    }

    function user_of_group(Request $request){
        $group_id = $request->group_id;
        $user_of_group = UserOfGroup::with(['user'])->where(['group_id'=>$group_id])->get();
        return $user_of_group;
    }

    function check_user_of_group(Request $request){
        $user_id = $request->user_id;
        $group_id = $request->group_id;

        $check = UserOfGroup::where(['user_id'=>$user_id, 'group_id'=>$group_id])->get();

        # thỏa điều kiện => có trong nhóm
        if(count($check) == 1){
            return ['result'=>'true'];
        }else{
            return ['result'=>'false'];
        }

    }

    function out_group(Request $request){
        $group_id = $request->group_id;
        $user_id = $request->user_id;

        ## rời nhóm
        $user_of_group_id = DB::select("DELETE FROM user_of_groups WHERE group_id = $group_id AND user_id = $user_id");

        ## khi thành viên cuối cùng rời nhóm => xóa nhóm
        $count_user_of_groups = DB::table('user_of_groups')->where(['group_id'=>$group_id])->count();

        ## chủ phòng rời nhóm thì chủ phòng thành người khác
        $group = Group::find($group_id);
        # đúng là thằng chủ phòng rời nhóm
        if($group->user_id == $user_id && $count_user_of_groups > 0){
            # tìm thằng user khác trong nhóm sử dụng limit (thằng được thêm vào thứ 2 sau chủ phòng)
            $user = DB::table('user_of_groups')->where(['group_id'=>$group_id])->limit(1)->get();
            # đổi chủ phòng
            $group->user_id = $user[0]->user_id;
            $group->save();
        }

        # nhóm này không còn ai
        if($count_user_of_groups == 0){
            # xóa nhóm luôn
            $user_of_group = DB::select("DELETE FROM user_of_groups WHERE group_id = $group_id");
            $group_message = DB::select("DELETE FROM group_messages WHERE group_id = $group_id");
            $group = Group::find($group_id);
            $group->delete();
        }

        return ['status'=>'success'];
    }   

    function delete_group(Request $request){
        $group_id = $request->group_id;

        # xóa user của group đó
        $user_of_group = DB::select("DELETE FROM user_of_groups WHERE group_id = $group_id");
        # xóa những tin nhắn của group đó
        $group_message = DB::select("DELETE FROM group_messages WHERE group_id = $group_id");

        $group = Group::find($group_id);
        $group->delete();

        return ['status'=>'success'];
    }

    function edit_name(Request $request){
        $group_id = $request->id;
        $group_name = $request->name;

        $group = Group::find($group_id);
        $group->name = $group_name;
        $group->save();

        return ['status'=>'success'];
    }
}
