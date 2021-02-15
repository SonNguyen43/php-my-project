<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Friend;
use App\Post;
use Auth;
use DB;

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

    function posts_with_friend(){
        # tìm xem thằng nào là bạn
        $user_id = Auth::user()->id;
        $list_friends = DB::select("SELECT * FROM friends WHERE user_id = $user_id AND status = 'friended' OR to_user_id = $user_id AND status = 'friended'");

        $list_to_user_id = array();
        $list_user_id = array();

        # gán user_id và to_user_id vào 2 mảng với điều kiện là friended phía trên
        for ($i=0; $i < count($list_friends) ; $i++) { 
            $list_to_user_id[$i] = $list_friends[$i]->to_user_id;
            $list_user_id[$i] = $list_friends[$i]->user_id;
        }

        # gộp 2 mảng đó lại
        $list_friend_id = array_merge($list_to_user_id, $list_user_id);

        # loại bỏ các phần tử trùng nhau - lúc này đã có danh sách id bạn bè
        $finnal_list_friend_id = array_unique($list_friend_id);

        # những bài post có user_id nằm trong danh sách bạn bè
        $post_with_friend = Post::with(['user','like','comment_post_parent'])->whereIn('user_id', $finnal_list_friend_id)->orderBy('id','DESC')->get();
        return $post_with_friend;
    }
}
