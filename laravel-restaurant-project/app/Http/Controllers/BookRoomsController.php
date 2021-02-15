<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\BookRoom;
use App\Room;

class BookRoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $status = 'not approved';
        $condition = true;
        
        $bookrooms = BookRoom::when($condition, function ($query) use ($status) {
            return $query->where('status', $status)->orderBy('created_at','desc');
        })
        ->paginate(10);

        $rooms = Room::all();

        return view('home',['bookrooms'=>$bookrooms, 'rooms'=>$rooms]);
    }

    public function index2()
    {

        $status = 'approved';
        $condition = true;
        
        $bookeds = BookRoom::when($condition, function ($query) use ($status) {
            return $query->where('status', $status)->orderBy('created_at','desc');
        })
        ->paginate(10);

        return view('home',['bookeds'=>$bookeds]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'phone_number'   =>  'required',
            'kind_of_room'   =>  'required',
            'day'   =>  'required',
            'month'   =>  'required',
            'year'   =>  'required',
            'hour'   =>  'required',
            'people_number'   =>  'required',
        ]);

        $bookroom = new BookRoom;
        $bookroom->name = $request->name;
        $bookroom->phone_number = $request->phone_number;
        $bookroom->kind_of_room = $request->kind_of_room;
        $bookroom->time = $request->day . "/" . $request->month ."/". $request->year . " - " . $request->hour ;
        $bookroom->people_number = $request->people_number;
        $bookroom->save();

        return redirect()->back()->with('success', '<b>Hoàn tất đặt phòng</b>, Chúng tôi sẽ sớm liên lạc với bạn...!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bookroom = BookRoom::find($id);
        $bookroom->status = "approved";
        $bookroom->save();

        return redirect()->back()->with('success', '<b>Thành công</b> đã chấp nhận yêu cầu của khách hàng !');
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
        $bookroom = BookRoom::find($id);

        if (isset($request->name)) {
            $bookroom->name = $request->name;
        } 
        if (isset($request->phone_number)) {
            $bookroom->phone_number = $request->phone_number;
        } 
        if (isset($request->time)) {
            $bookroom->time = $request->time;
        } 
        if (isset($request->people_number)) {
            $bookroom->people_number = $request->people_number;
        } 
        if (isset($request->kind_of_room)) {
            $bookroom->kind_of_room = $request->kind_of_room;
        } 
        
        $bookroom->save();

        return redirect()->back()->with('success', '<b>Thành công</b> đã thay đổi !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bookroom = BookRoom::find($id);
        $bookroom->delete();

        return redirect()->back()->with('success', '<b>Đã hủy</b> yêu cầu này !');
    }

    public function search(){
        $q = input::get ('q');

        $bookrooms = BookRoom::where([
            ['name', 'LIKE', '%'.$q.'%'],
            ['status', '=', 'not approved'],
         ])->paginate(10);

        $rooms = Room::all();

        if(count($bookrooms) > 0) {
            if ($q != NULL) {
                $search_key = "Kết quả tìm kiếm cho: <b>" . $q . "</b>"; 
                return view('home',['bookrooms'=>$bookrooms,'search_key'=>$search_key, 'rooms'=>$rooms]);
            }else{
                return view('home',['bookrooms'=>$bookrooms, 'rooms'=>$rooms]);
            }
        }   
        else {
            $search_key = "<b>Không tìm thấy</b> kết quả nào cho từ khóa bạn vừa tìm: <b>" . $q. "</b>"; 
            $bookrooms = BookRoom::orderBy('created_at','asc')->paginate(10);
            return view('home',['bookrooms'=>$bookrooms,'search_key'=>$search_key, 'rooms'=>$rooms]);
        }
    }

    public function searched(){
        $q = input::get ('q');

        $bookeds = BookRoom::where([
            ['name', 'LIKE', '%'.$q.'%'],
            ['status', '=', 'approved'],
         ])->paginate(10);

        if(count($bookeds) > 0) {
            if ($q != NULL) {
                $search_key = "Kết quả tìm kiếm cho: <b>" . $q . "</b>"; 
                return view('home',['bookeds'=>$bookeds,'search_key'=>$search_key]);
            }else{
                return view('home',['bookeds'=>$bookeds]);
            }
        }   
        else {
            $search_key = "<b>Không tìm thấy</b> kết quả nào cho từ khóa bạn vừa tìm: <b>" . $q. "</b>"; 
            $bookeds = BookRoom::orderBy('created_at','asc')->paginate(10);
            return view('home',['bookeds'=>$bookeds,'search_key'=>$search_key]);
        }
    }
}
