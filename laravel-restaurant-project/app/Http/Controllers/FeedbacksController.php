<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Feedback;

class FeedbacksController extends Controller
{
    public function feedback(Request $request){
        $name = $_REQUEST['name'];
        $phone_number = $_REQUEST['phone_number'];
        $content = $_REQUEST['content'];

        # tinker    
        $feedback = new Feedback;
        $feedback->name = $name;
        $feedback->phone_number = $phone_number;
        $feedback->content = $content;
        $feedback->save();

        return redirect()->back()->with('success','Nội dung của bạn đã được gửi đi');
    }

    public function show(){
        $feedbacks = Feedback::orderBy('created_at','desc')->paginate(2);
        # SELECT * FROM Feedback ORDER BY created_at desc
        return view('home')->with('feedbacks',$feedbacks);
    }

    public function destroy(){
        $id = $_REQUEST['id'];
        $feedback = Feedback::find($id);
        $feedback->delete();
        return redirect()->back()->with('success','<b>Đã Xóa</b> thành công');

    }
}
