<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Friend;
use App\User;
use Auth;
use DB;

class FriendController extends Controller
{
    function list_friend(){
        $user_id = Auth::user()->id;

        $list_friends = DB::select("SELECT * FROM friends WHERE user_id = $user_id AND status = 'friended' OR to_user_id = $user_id AND status = 'friended'");
        
        $list= array();
        for ($i=0; $i < count($list_friends); $i++) { 
            # to_user_id là bản thân => không lấy
            if($list_friends[$i]->to_user_id == $user_id){
                $list[$i] = User::find($list_friends[$i]->user_id);
            }else{
                $list[$i] = User::find($list_friends[$i]->to_user_id);
            }
        }

        return $list;
    }

    function find_user(Request $request){
        $key = $request->key;
        $user_id = Auth::user()->id;

        # lấy thằng user được tìm bằng key được gửi qua
        $user = User::where('phone_number', 'like', '%' .$key. '%')->orWhere('email', 'like', '%' .$key. '%')->get();

        #
        $list_find = array();
        $stt = 0;

        foreach ($user as $us) {
            # tìm xem thằng đó đã là bạn chưa
            $friended_form = Friend::where(['to_user_id'=>$us->id,'user_id'=>$user_id,'status'=>'friended'])->get();
            $friended_to = Friend::where(['to_user_id'=>$user_id,'user_id'=>$us->id,'status'=>'friended'])->get();

            # kiểm tra xem thằng user được tìm đó đã gửi lời mời kết bạn chưa (> 0 đã gửi rồi (not_friend) nhưng chưa đồng ý)
            $friend_send_invitation = Friend::where(['to_user_id'=>$us->id,'user_id'=>$user_id,'status'=>'not_friend'])->get();

            if(count($friended_form) > 0 || count($friended_to) > 0){
                $list_find[$stt] = [$us,'friended'];
            }else if(count($friend_send_invitation) > 0){
                $list_find[$stt] = [$us,'friend_requested'];
            }else{
                # chưa kết bạn
                $list_find[$stt] = [$us,'not_friend_request'];
            }

            $stt++;
        }

        # mỗi thằng được thấy và hiện ra thì chứa trong 1 mảng gồm 2 thông tin [user nào, trạng thái là gì]
        return $list_find;


        // $friend = 0;
        // # mục đích tránh bị lỗi do keyup liên tục - khi không tìm thấy user thì cx ko thể lấy id
        // if (count($user) > 0) {
        
        //     # đã là bạn bè chưa
        //     # to_user_id: 2 || user_id: 1
        //     # to_user_id: 1 || user_id: 2
        //     $friended_form = Friend::where(['to_user_id'=>$user[0]->id,'user_id'=>$user_id,'status'=>'friended'])->get();
        //     $friended_to = Friend::where(['to_user_id'=>$user_id,'user_id'=>$user[0]->id,'status'=>'friended'])->get();

        //     # kiểm tra xem thằng user được tìm đó đã gửi lời mời kết bạn chưa (> 0 đã gửi rồi (not_friend) nhưng chưa đồng ý)
        //     $friend_send_invitation = Friend::where(['to_user_id'=>$user[0]->id,'user_id'=>$user_id,'status'=>'not_friend'])->get();
           
        //     # đã kết bạn trước đó
        //     if(count($friended_form) > 0 || count($friended_to) > 0){
        //         return [$user,'friended'];
        //     }
        //     if(count($friend_send_invitation) > 0){
        //         return [$user,'friend_requested'];
        //     }else{
        //         # chưa kết bạn
        //         return [$user,'not_friend_request'];
        //     }
        // }
    }

    function add_friend(Request $request){
        $user_id = Auth::user()->id;
        $to_user_id = $request->to_user_id;

        # đã gửi lời mời nhưng chưa đồng ý || kiểm tra xem đã tồn tại lời mời chưa  || cho trường hợp đã gửi và người gửi vẫn tìm
        $friended_form = Friend::where(['to_user_id'=>$to_user_id,'user_id'=>$user_id,'status'=>'not_friend'])->get();
        $friended_to = Friend::where(['to_user_id'=>$user_id,'user_id'=>$to_user_id,'status'=>'not_friend'])->get();

        # đã tồn tại lời mời chỉ cần update thành friended (agrre đồng ý)
        if(count($friended_form) > 0 || count($friended_to) > 0){
            if(count($friended_form) > 0)   $friend_id = $friended_form[0]->id;
            if(count($friended_to) > 0)     $friend_id = $friended_to[0]->id;

            $friend = Friend::find($friend_id);
            $friend->status = 'friended';
            $friend->save();
        }else{
            # chưa tồn tại lời mời => tạo lời mời
            $friend = new Friend;
            $friend->to_user_id = $to_user_id;
            $friend->user_id = $user_id;
            $friend->save();
    
            return ['status'=>'success'];
        }
    }

    function list_invitation(){
        $user_id = Auth::user()->id;
        # chính mình user_id (thằng gửi) được người khác kết bạn là to_user_id (thằng nhận) của người khác
        $list_invitation = Friend::with(['user'])->where(['to_user_id'=>$user_id, 'status'=>'not_friend'])->orderBy('id','DESC')->get();
        return $list_invitation;
    }

    function agree(Request $request){
        $friend_id = $request->friend_id;

        $friend = Friend::find($friend_id);
        $friend->status = 'friended';
        $friend->save();

        return ['status'=>'success'];
    }

    function destroy(Request $request){
        $friend_id = $request->friend_id;

        $friend = Friend::find($friend_id);
        $friend->delete();
        return ['status'=>'success'];
    }

    function delete_friend(Request $request){
        $user_id = Auth::user()->id;
        $friend_id = $request->friend_id;

        $friend = DB::select("SELECT * FROM friends WHERE user_id = $user_id AND to_user_id = $friend_id AND status = 'friended' OR user_id = $friend_id AND to_user_id = $user_id AND status = 'friended' LIMIT 1");

        # id của bảng friend
        $id = $friend[0]->id;

        $delete = Friend::find($id);
        $delete->delete();
        return ['status'=>'success'];
    }

    function info_friend(Request $request){
        $friend_id = $request->friend_id;
        $friend = User::find($friend_id);
        return $friend;
    }   

    function check_friend(Request $request){
        $user_id = Auth::user()->id;
        $to_user_id = $request->friend_id;

        # WHERE (a = 1 AND b =2 ) OR (a = 2 AND b = 1)
        $friend = Friend::where(function ($query) use ($user_id, $to_user_id) {
            $query->where(['user_id'=>$user_id,'to_user_id'=>$to_user_id]);
        })->orWhere(function ($query) use ($user_id, $to_user_id) {
            $query->where(['user_id'=>$to_user_id,'to_user_id'=>$user_id]);
        })->get();

        // thằng này là bạn
        if(count($friend) == 1){
            return ['result'=>'true'];
        }else{
            return ['result'=>'false'];
        }
    }
}
