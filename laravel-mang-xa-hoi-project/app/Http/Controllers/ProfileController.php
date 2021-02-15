<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Auth;
use App\User;

class ProfileController extends Controller
{
    function user_loggin(){
        $user = User::find(Auth::user()->id);
        return $user;
    }

    function change_avatar(Request $request){
        $user_id = Auth::user()->id;
       
        # nhận từ ô input
        if($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            # Đuôi ảnh
            $extension = $file->getClientOriginalExtension();
            # Đặt lại tên
            $fileNameToStore = str_random().time().'.'.$extension;
            # Upload Image
            $path = $file->storeAs('/public/images/avatars/user_'. $user_id,$fileNameToStore);

            # update csdl
            $user = User::find($user_id);
            if($user->avatar != 'noImage.png'){
                Storage::delete('/public/images/avatars/user_'.$user_id.'/'.$user->avatar);
            }
            $user->avatar = $fileNameToStore;
            $user->save();

            return ['result'=>'success','user_id'=>$user_id,'file_name'=>$fileNameToStore,'type'=>'file'];
        }else{
            # nhận hình ảnh bằng base64
            $exploded = explode(',', $request->avatar);
            $decoded = base64_decode($exploded[1]);

            if(str_contains($exploded[0], 'jpeg')){
                $extension = 'jpg';
            }else{
                $extension = 'png';
            }

            # Đặt lại tên
            $fileNameToStore = str_random().time().'.'.$extension;
            # Upload Image
            $path = public_path() . '/storage/images/avatars/user_'.$user_id.'/'.$fileNameToStore;

            file_put_contents($path,$decoded);

            # update csdl
            $user = User::find($user_id);
            if($user->avatar != 'noImage.png'){
                Storage::delete('/public/images/avatars/user_'.$user_id.'/'.$user->avatar);
            }
            $user->avatar = $fileNameToStore;
            $user->save();

            return ['result'=>'success','user_id'=>$user_id,'file_name'=>$fileNameToStore,'type'=>'base64'];
        }
    }

    function change_cover_image(Request $request){
        $user_id = Auth::user()->id;
        
        # nhận từ ô input
        if($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            # Đuôi ảnh
            $extension = $file->getClientOriginalExtension();
            # Đặt lại tên
            $fileNameToStore = str_random().time().'.'.$extension;
            # Upload Image
            $path = $file->storeAs('/public/images/cover_images/user_'. $user_id,$fileNameToStore);

            # update csdl
            $user = User::find($user_id);
            if($user->cover_image != 'noImage'){
                Storage::delete('/public/images/cover_images/user_'.$user_id.'/'.$user->cover_image);
            }
            $user->cover_image = $fileNameToStore;
            $user->save();

            return ['result'=>'success','user_id'=>$user_id,'file_name'=>$fileNameToStore];
        }else{
            return['result'=>'false'];
        }
    }
}
