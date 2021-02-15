<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Comment;
use App\Forum;
use View;

class ForumsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except'=>['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $forum = Post::whereType('not approved')->get();

        $type = 'approved';
        $condition = true;
        
        $forums = Forum::when($condition, function ($query) use ($type) {
            return $query->where('type', $type)->orderBy('id','desc');
        })
        ->paginate(6);

        return view('forums.index')->with('forums', $forums);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forums.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
            'cover_image'   =>  'image|nullable|max:1999'
        ]);

        # Ảnh bìa
        if($request->hasFile('cover_image')) {
            $file = $request->file('cover_image');
            # Name & Extension
            $filenamewithExt = $file->getClientOriginalName();

            # Name
            $filename = pathinfo($filenamewithExt,PATHINFO_FILENAME);
        
            # Ext
            $extension = $file->getClientOriginalExtension();
            
            # FileName to store
            $fileNameToStore = $filename.'_'.time().'_'.substr(md5(time()), 0, 24).'.'.$extension;

            # Upload Image
            $path = $file->storeAs('public/images/forum/'. auth()->user()->id . '/cover_image',$fileNameToStore);
        }else{
            $fileNameToStore = 'noImage.png';
        }

        # Ảnh mô tả
        $images = array();
        $item = 0;
        $json = NULL;

        if($request->hasFile('images')) {
            $files = $request->file('images');
            
            $allowedfileExtension=['jpg','png','jpeg'];
            
			foreach($files as $file) {
                if($item == 3){
                    break;
                }
                # Name & Extension
                $filenamewithExt = $file->getClientOriginalName();

                # Name
                $filename = pathinfo($filenamewithExt,PATHINFO_FILENAME);
            
                # Ext
                $extension = $file->getClientOriginalExtension();
                
                # FileName to store
                $fileNameToStore_Images = $filename.'_'.time().'_'.substr(md5(time()), 0, 24).'.'.$extension;

                # Save to array
                $images[$item] = $fileNameToStore_Images;
                $item++;
                
                # Upload Image
                $path = $file->storeAs('public/images/forum/'. auth()->user()->id . '/images',$fileNameToStore_Images);
            }

            # Chuyển mảng thành dạng JSON
            $json = json_encode($images);
        }else{
            $json = 'noImage.png';
        }

        # Tạo bài viết
        $forum = new Forum;
        $forum->title = $request->title;
        $forum->body = $request->body;
        $forum->user_id = auth()->user()->id;
        $forum->cover_image = $fileNameToStore;
        $forum->images = $json;

        $forum->save();
        
        return redirect()->back()->with('success', 'Đã tạo thành công bài viết. Đang chờ quản trị viên duyệt bài !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $forum = Forum::find($id);

        $comments = Comment::where('forum_id', $id)->paginate(10);   
        View::Share('comments',$comments);
        
        if($forum != NULL && $forum->type != 'not approved'){
            return view('forums.show')->with('forum', $forum);
        }
        if(auth()->user()->type == 'admin' && $forum != NULL){
            return view('forums.show')->with('forum', $forum);
        }

        return redirect()->back()->with('error', 'Không tìm thấy bài đăng này !');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $forum = Forum::find($id);

        if($forum == NULL){
            return redirect()->back()->with('error', 'Yêu cầu không được thực hiện !');
        }
        if(auth()->user()->id == $forum->user_id){
            return view('forums.edit')->with('forum', $forum);
        }else{
            return redirect()->back()->with('error', 'Lỗi thao tác... Bạn không có quyền thực hiện điều này...!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $forum = Forum::find($id);

        if(auth()->user()->type == 'admin'){
            $forum->created_at = time();
            $forum->type = 'approved';
            $forum->save();

            return redirect()->back()->with('success', 'Đã duyệt bài viết !');
        }else{

            $this->validate($request, [
                'title' => 'required',
                'body' => 'required',
                'cover_image'   =>  'image|nullable|max:1999'
            ]);
    
            
            # Ảnh bìa
            if($request->hasFile('cover_image')) {
                # Xóa ảnh bìa
                if($forum->cover_image != 'noImage.png'){
                    Storage::delete('public/images/forum/'.$forum->user_id.'/cover_image/'.$forum->cover_image);
                }

                $file = $request->file('cover_image');
                # Name & Extension
                $filenamewithExt = $file->getClientOriginalName();
    
                # Name
                $filename = pathinfo($filenamewithExt,PATHINFO_FILENAME);
            
                # Ext
                $extension = $file->getClientOriginalExtension();
                
                # FileName to store
                $fileNameToStore = $filename.'_'.time().'_'.substr(md5(time()), 0, 24).'.'.$extension;
    
                # Upload Image
                $path = $file->storeAs('public/images/forum/'. auth()->user()->id . '/cover_image',$fileNameToStore);
            }

            
            # Ảnh mô tả
            if($request->hasFile('images')) {
                # Xóa ảnh mô tả
                if($forum->images != NULL && $forum->images != 'noImage.png'){
                    $images = $forum->images;
                    # chuyen JSON thanh mang
                    $arrayImages = (json_decode($images, true));

                    foreach ($arrayImages as $image) {
                        Storage::delete('public/images/forum/'.$forum->user_id.'/images/'.$image);
                    }
                }
                
                $images = array();
                $item = 0;
                $json = NULL;
                $files = $request->file('images');
                
                $allowedfileExtension=['jpg','png','jpeg'];
                
                foreach($files as $file) {
                    if($item == 3){
                        break;
                    }
                    # Name & Extension
                    $filenamewithExt = $file->getClientOriginalName();
    
                    # Name
                    $filename = pathinfo($filenamewithExt,PATHINFO_FILENAME);
                
                    # Ext
                    $extension = $file->getClientOriginalExtension();
                    
                    # FileName to store
                    $fileNameToStore_Images = $filename.'_'.time().'_'.substr(md5(time()), 0, 24).'.'.$extension;
    
                    # Save to array
                    $images[$item] = $fileNameToStore_Images;
                    $item++;
                    
                    # Upload Image
                    $path = $file->storeAs('public/images/forum/'. auth()->user()->id . '/images',$fileNameToStore_Images);
                }
    
                # Chuyển mảng thành dạng JSON
                $json = json_encode($images);
            }else
    
            # Tạo bài viết
            $forum->title = $request->title;
            $forum->body = $request->body;

            if($request->hasFile('cover_image')){
                $forum->cover_image = $fileNameToStore;
            }
            if($request->hasFile('images')){
                $forum->images = $json;
            }
            $forum->save();
            return redirect()->back()->with('success', 'Thay đổi thành công !');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $forum = Forum::find($id);

        if(auth()->user()->id == $forum->user_id || auth()->user()->type == 'admin'){
            # Xóa ảnh bìa
            if($forum->cover_image != 'noImage.png'){
                Storage::delete('public/images/forum/'.$forum->user_id.'/cover_image/'.$forum->cover_image);
            }

            # Xóa ảnh mô tả
            if($forum->images != NULL && $forum->images != 'noImage.png'){
                $images = $forum->images;
                # chuyen JSON thanh mang
                $arrayImages = (json_decode($images, true));

                foreach ($arrayImages as $image) {
                    Storage::delete('public/images/forum/'.$forum->user_id.'/images/'.$image);
                }
            }
            $forum->delete();
            return redirect('/forums')->with('success', 'Đã xóa bài viết !');
        }else{
            return redirect()->back()->with('error', 'Lỗi thao tác... Bạn không có quyền thực hiện điều này !');
        }
    }
}
