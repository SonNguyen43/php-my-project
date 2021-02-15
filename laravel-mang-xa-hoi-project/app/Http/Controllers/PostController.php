<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\CommentsPostParent;
use App\TrackingUser;
use App\Post;
use App\User;
use App\Like;
use Auth;

class PostController extends Controller
{
    function detail_post(Request $request){
        $user_id = $request->user_id;
        $post_id = $request->post_id;

        $detail_post = Post::with(['user','like','comment_post_parent'])->where(['user_id'=>$user_id,'id'=>$post_id])->orderBy('id','DESC')->get();
        return $detail_post;
    }
    function my_post(){
        $user_id = Auth::user()->id;
        $post_of_user = Post::with(['user','like','comment_post_parent'])->where(['user_id'=>$user_id])->orderBy('id','DESC')->get();
        return $post_of_user;
    }
    
    function create_post(Request $request){
        $post = new Post;
        $post->content = $request->content;
       
        $images = array();
        $item = 0;
        $json = NULL;

        # xử lí ảnh
        if($request->hasFile('images')) {
            $files = $request->file('images');
            
			foreach($files as $file) {
                if($item == 3) break;
                # Ext
                $extension = $file->getClientOriginalExtension();
                # Đặt lại tên
                $fileNameToStore = str_random().time().'.'.$extension;
                # Đưa vào mảng
                $images[$item] = $fileNameToStore;
                $item++;
                # Upload Image
                $path = $file->storeAs('/public/posts/user_'. Auth::user()->id . '/images/',$fileNameToStore);
            }
            # Chuyển mảng thành dạng JSON
            $json_images = json_encode($images);
            $post->images = $json_images;
        }

        # xử lí video
        if($request->hasFile('video')) {
            $file = $request->file('video');
            # Ext
            $extension = $file->getClientOriginalExtension();
            # Đặt lại tên
            $fileNameToStore = str_random().time().'.'.$extension;
            # Upload video
            $path = $file->storeAs('/public/posts/user_'. Auth::user()->id . '/videos/',$fileNameToStore);
            $post->video = $fileNameToStore;
        }
        $post->user_id = Auth::user()->id;
        $post->save();

        // THEO DÕI 
        $tracking_user = new TrackingUser;
        $tracking_user->action = "Tạo mới bài viết";
        $tracking_user->user_id = Auth::user()->id;
        $tracking_user->post_id = $post->id;
        $tracking_user->device = $_SERVER['HTTP_USER_AGENT'];
        $tracking_user->ip_address = $_SERVER['REMOTE_ADDR'];
        $tracking_user->save();
        return ['status'=>'success'];
    }

    function like_the_article(Request $request){
        # kiểm tra xem user đó đã like bài viết này chưa
        $likes = Like::where(['user_id'=>Auth::user()->id, 'post_id'=>$request->post_id])->get();

        # đã like => hủy like
        if(count($likes) >= 1){
            $like = Like::find($likes[0]->id);
            $like->delete();

            // THEO DÕI 
            $tracking_user = new TrackingUser;
            $tracking_user->action = "Hủy thích bài viết";
            $tracking_user->user_id = Auth::user()->id;
            $tracking_user->post_id = $request->post_id;
            $tracking_user->device = $_SERVER['HTTP_USER_AGENT'];
            $tracking_user->ip_address = $_SERVER['REMOTE_ADDR'];
            $tracking_user->save();
            return ['status'=>'dislike'];

        }else{
            $like = new Like;
            $like->post_id = $request->post_id;
            $like->user_id = Auth::user()->id;
            $like->save();  

            // THEO DÕI 
            $tracking_user = new TrackingUser;
            $tracking_user->action = "Thích bài viết";
            $tracking_user->user_id = Auth::user()->id;
            $tracking_user->post_id = $request->post_id;
            $tracking_user->device = $_SERVER['HTTP_USER_AGENT'];
            $tracking_user->ip_address = $_SERVER['REMOTE_ADDR'];
            $tracking_user->save();
            return ['status'=>'liked'];
        }
    }

    function likes(Request $request){
        $post_id = $request->post_id;
        $likes = Like::with(['user'])->where(['post_id'=>$post_id])->orderBy('id','DESC')->get();
        return $likes;
    }

    function delete_post(Request $request){
       
    }

    function comments_post_parent(Request $request){
        $post_id = $request->post_id;
        
        $comments_post_parent = CommentsPostParent::with(['user'])->where(['post_id'=>$post_id])->orderBy('id','DESC')->get();

        return $comments_post_parent;
    }

    function comment_to_post_parent(Request $request){
         
        # mục đích để cắt <p> và </p> mặc định
        $content = str_replace('<p>', '', $request->content);
        $finnal_content = str_replace('</p>', '', $content);

        $user_id = Auth::user()->id;
        $post_id = $request->post_id;
        $content = $finnal_content;

        $comments_post_parent = new CommentsPostParent;
        $comments_post_parent->content = $content;
        $comments_post_parent->post_id = $post_id;
        $comments_post_parent->user_id = $user_id;
        $comments_post_parent->save();

        // THEO DÕI 
        $tracking_user = new TrackingUser;
        $tracking_user->action = "Comment bài viết";
        $tracking_user->user_id = Auth::user()->id;
        $tracking_user->post_id = $request->post_id;
        $tracking_user->content = $content;
        $tracking_user->device = $_SERVER['HTTP_USER_AGENT'];
        $tracking_user->ip_address = $_SERVER['REMOTE_ADDR'];
        $tracking_user->save();
        
        return ['status'=>'success'];
    }

    function delete_comment_post_parent(Request $request){
        $post_id = $request->post_id;
        $comment_post_parent_id = $request->comment_post_parent_id;

        $tracking_user = new TrackingUser;
        $tracking_user->action = "Xóa comment";
        $tracking_user->user_id = Auth::user()->id;
        $tracking_user->post_id = $request->post_id;
        $tracking_user->device = $_SERVER['HTTP_USER_AGENT'];
        $tracking_user->ip_address = $_SERVER['REMOTE_ADDR'];
        $tracking_user->save();

        $comment = CommentsPostParent::find($comment_post_parent_id);
        $comment->delete();
        return ['status'=>'success'];
    }

    function top_comments(Request $request){
        $post_id = $request->post_id; 
        $top_comments = CommentsPostParent::with(['user'])->where(['post_id'=>$post_id])->limit(3)->orderBy('id','DESC')->get();
        
        return $top_comments;
    }

    function delete_post_with_id(Request $request){
        $post_id = $request->post_id;
        $post = Post::find($post_id);
        
        # xóa like
        $like = Like::where(['post_id'=>$post_id])->delete();
        # xóa cmt
        $comment_post_parent = CommentsPostParent::where(['post_id'=>$post_id])->delete();
        # xóa hình ảnh
        if($post->images != NULL){
            $images = $post->images;
            # chuyen JSON thanh mang
            $arrayImages = (json_decode($images, true));

            foreach ($arrayImages as $image) {
                Storage::delete('/public/posts/user_'. Auth::user()->id . '/images/'.$image);
            }
        }
        # xóa video
        if($post->video != NULL){
            Storage::delete('/public/posts/user_'. Auth::user()->id . '/videos/'.$post->video);
        }
        # xóa bài viết
        $post->delete();

        # THEO DÕI 
        $tracking_user = new TrackingUser;
        $tracking_user->action = "Xóa bài viết";
        $tracking_user->user_id = Auth::user()->id;
        $tracking_user->device = $_SERVER['HTTP_USER_AGENT'];
        $tracking_user->ip_address = $_SERVER['REMOTE_ADDR'];
        $tracking_user->save();
        return ['status'=>'success'];
    }

    function user_likes(Request $request){
        $post_id = $request->post_id;

        # xem thằng đang đăng nhập có like hay chưa
        $check = Like::where(['user_id'=>Auth::user()->id, 'post_id'=> $post_id])->get();

        # đã liek
        if(count($check) > 0){
            return ['result'=>'liked'];
        }else{
            return ['result'=>'not_like'];
        }
    }

    function edit_post(Request $request){
        $post_id = $request->id;
        $content = $request->content;

        $post = Post::Find($post_id);
        $post->content = $content;
        $post->save();

        return ['result'=>'success'];
    }

    function delete_img_in_post(Request $request){
        $name_img = $request->name_img;
        $post_id = $request->post_id;

        $post = Post::Find($post_id);
        # lấy chuỗi json từ csdl
        $json_img =  $post->images;
        # chuyển chuỗi đó thành mảng
        $arr_img = json_decode($json_img, true);
        # tìm phần tử trong mảng 
        $key = array_search($name_img, $arr_img);
        # loại bỏ phần tử (ảnh) ra khỏi mảng
        unset($arr_img[$key]);
        # chuyển mảng về json và update vào csdl
        $post->images = json_encode($arr_img);
        $post->save();

        return ['result'=>'success'];
    }
}
