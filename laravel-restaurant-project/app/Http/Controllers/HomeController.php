<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
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
            echo $fileNameToStore = $filename.'.'.$extension;

            # delete image
            Storage::delete('public/images/admin/'. auth()->user()->avatar);
                        
            # Upload Image
            $path = $file->storeAs('public/images/admin/', $fileNameToStore);

            $user->avatar = $fileNameToStore;
            $user->save();
        }else{
            return redirect()->back()->with('error', 'Không tìm thấy ảnh !');
        }

        return redirect()->back()->with('success', 'Thay đổi thành công !');
    }
}
