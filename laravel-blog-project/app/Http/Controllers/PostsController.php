<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;

class PostsController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        $posts = Post::orderBy('created_at','desc')->paginate(3);
        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->type == 'admin'){
            return view('posts.create');
        }

        return redirect()->back()->with('error', 'Lỗi thao tác... Bạn không có quyền thực hiện điều này...!');
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
            'body' => 'required'
        ]);

        # Tạo bài viết
        $post = new Post;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->user_id = Auth::user()->id;
        $post->save();
        
        return redirect()->back()->with('success', 'Đã tạo thành công bài viết...!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        if($post != NULL && $post->type != 'not approved'){
            return view('posts.show')->with('post', $post);
        }else if($post != NULL && $post->type == 'not approved' && Auth::user()->type == "admin"){
            return view('posts.show')->with('post', $post);
        }
        return redirect('../public/posts')->with('error', 'Không tìm thấy trang này...!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        if($post == NULL){
            return redirect()->back()->with('error', 'Yêu cầu không được thực hiện !');
        }
        if(auth()->user()->id == $post->user_id ){
            return view('posts.edit')->with('post', $post); 
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
        $this->validate($request,[
            'title' => 'required',
        ]);
        
        $post = Post::find($id);
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();

        return redirect()->back()->with('success', 'Thay đổi thành công...!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        if(auth()->user()->id == $post->user_id ){
            $post->delete();
            return redirect('../public/posts')->with('success', 'Đã xóa bài viết');
        }else{
            return redirect()->back()->with('error', 'Lỗi thao tác... Bạn không có quyền thực hiện điều này...!');
        }
    }
}
