<?php

namespace App\Http\Controllers;
use App\User;
use Auth;
use Hash;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    function change_info_user(Request $request){
        $user = User::find(Auth::user()->id);
        # lấy sđt hiện tại của user
        $phone_number_present = $user->phone_number;

        # check xem số điện thoại đã tồn tại chưa
        $phone_number = $request->phone_number;
        $check_phone_number = User::where(['phone_number'=>$phone_number])->get();

        if(count($check_phone_number) > 0 && $phone_number_present != $phone_number){
            return ['result'=>'already_exist'];
        }else{
            $user->name         = $request->name;
            $user->address      = $request->address;
            $user->phone_number = $request->phone_number;
            $user->birthday     = $request->birthday;
            $user->save();
            return ['result'=>'success'];
        }
    }

    function change_password(Request $request){
        $old_password         = $request->old_password;
        $new_password         = $request->new_password;
        $confirm_new_password = $request->confirm_new_password;

        $user_info = Auth::user();
        
        # Nếu đúng mật khẩu cũ
        if (Auth::attempt(['email' => $user_info->email, 'password' => $old_password])) {
            $user = User::find($user_info->id);
            $user->password = Hash::make($new_password);
            $user->save();
            return response(['result'=>'success']);
        }else{
            return response(['result'=>'old_password_fail']);
        }
    }
}
