<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TrackingUser;
use App\User;
use Auth;

class TrackingUserController extends Controller
{
    public function all_tracking(){
        $tracking_user = TrackingUser::with(['user','post'])->orderBy('id','DESC')->get();

        return $tracking_user;
    }

    public function add_tracking(Request $request)
    {
        $action = $request->action;

        if (Auth::user()->type != 'admin') {
            $tracking_user = new TrackingUser;
            $tracking_user->action = $action;
            $tracking_user->user_id = Auth::user()->id;
            $tracking_user->device = $_SERVER['HTTP_USER_AGENT'];
            $tracking_user->ip_address = $_SERVER['REMOTE_ADDR'];
            $tracking_user->save();

            return ['status'=>'success'];
        }
    }

    public function find_user(Request $request){
        $created_at = $request->created_at;
        $action = $request->action;
        # lấy tên kiểm tra với bảng user
        $name = $request->name;
        $users = User::where('name', 'like', '%' .$name. '%')->get();

        $stt = 0;
        $arrUser = array();

        # lấy id của user lấy được vào mảng
        foreach($users as $user){
            $arrUser[$stt++] = $user->id;
        }

        # dùng whereIn để lấy user đang tìm (tìm bằng user_id nên phải lấy id của user trước)
        $tracking_user = TrackingUser::with(['user','post'])
                        ->where('created_at', 'like', '%' .$created_at. '%')
                        ->Where('action', 'like', '%' .$action. '%')
                        ->whereIn('user_id', $arrUser)->orderBy('id','DESC')->get();

        return $tracking_user;
    }
}
