<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\User;
use App\Forum;
use View;

class HomeController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function welcome(){

        $type = 'approved';
        $condition = true;
        
        $forums = Forum::when($condition, function ($query) use ($type) {
            return $query->where('type', $type)->orderBy('created_at','desc');
        })
        ->paginate(3);
        View::Share('forums',$forums);

        $posts = Post::orderBy('created_at','desc')->paginate(3);
        return view('welcome')->with('posts', $posts);
    }

    public function personal()
    {
        $user = auth()->user();
        return view('home')->with('user',$user);
    }

    public function posts(){
        $posts = Post::orderBy('created_at','desc')->paginate(10);
        return view('admin.posts.posts')->with('posts', $posts);
    }

    public function forum(){
        if(auth()->user()->type == 'admin'){
            $type = 'not approved';
            $condition = true;
            
            $forums = Forum::when($condition, function ($query) use ($type) {
                return $query->where('type', $type)->orderBy('created_at','desc');
            })
            ->paginate(3);
    
            return view('admin.forum.forum')->with('forums', $forums);
        }else{
            $user_id = auth()->user()->id;
            $user = User::find($user_id);

            return view('admin.forum.forum')->with('forums', $user->forums);
        }
    }

    public function updateavatar(Request $request){
        $this->validate($request, [
            'avatar' => 'image|nullable|max:1999'
        ]);

        $user = User::find($request->id);

        if($request->hasFile('avatar')) {
            $file = $request->file('avatar');
			
            # Name & Extension
            $filenamewithExt = $file->getClientOriginalName();

            # Name
            $filename = pathinfo($filenamewithExt,PATHINFO_FILENAME);
        
            # Ext
            $extension = $file->getClientOriginalExtension();
            
            # FileName to store
            $fileNameToStore = $filename.'.'.$extension;

            if(auth()->user()->type == 'admin'){
                # delete image
                Storage::delete('public/images/admin/'.auth()->user()->id.'/'. auth()->user()->avatar);
                            
                # Upload Image
                $path = $file->storeAs('public/images/admin/'.auth()->user()->id, $fileNameToStore);
            }
            if(auth()->user()->type == 'user'){
                # delete image
                Storage::delete('public/images/user/'.auth()->user()->id.'/'. auth()->user()->avatar);
                                            
                # Upload Image
                $path = $file->storeAs('public/images/user/'.auth()->user()->id, $fileNameToStore);
            }

            $user->avatar = $fileNameToStore;
            $user->save();
        }else{
            return redirect()->back()->with('error', 'Không tìm thấy ảnh !');
        }

        return redirect()->back()->with('success', 'Thay đổi thành công !');
    }
    
    public function updateinfo(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
        ]);
        
        $check = $request->check;
        $id = $request->id;

        $user = User::find($id);
        $user->name = $request->name;

        # sửa mật khẩu
        if($check){
            $this->validate($request, [
                'password' => 'required',
                'newpassword' => 'required',
                'passwordconfirm' => 'required',
            ]);
            # Kiểm tra mật khẩu cũ có đúng không
            $password = $request->password;

            # Nếu đúng mật khẩu cũ
            if (Auth::attempt(['email' => $user->email, 'password' => $password])) {
                if(strlen($password) < 7){
                    return redirect()->back()->with('error', 'Độ dài mật khẩu phải lớn hơn 7 !')->withInput();;
                }
                # Trùng nhau
                else if(strcmp($request->newpassword, $request->passwordconfirm) == 0){
                    # Mã hóa và update vào csld
                    $user->password = Hash::make($request->newpassword);
                }else{
                    return redirect()->back()->with('error', 'Mật khẩu mới và mật khẩu nhập lại không giống nhau !')->withInput();
                }
            }else{
                return redirect()->back()->with('error', 'Không đúng mật khẩu cũ !')->withInput();;     
            }
        }
        $user->save();

        return redirect()->back()->with('success', 'Thay đổi thành công !');
    }

}
