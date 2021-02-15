<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Room;
use Auth;

class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::orderBy('created_at','asc')->paginate(10);
        return view('home')->with('rooms', $rooms);
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
        $this->validate($request, [
            'kind_of_room' => 'required'
        ]);

        $room = new Room;
        $room->kind_of_room = $request->kind_of_room;
        $room->save();

        return redirect()->back()->with('success', 'Đã tạo mới !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
            'kind_of_room' => 'required'
        ]);

        $room = Room::find($id); 
        $room->kind_of_room = $request->kind_of_room;
        $room->save();

        return redirect()->back()->with('success', 'Thay đổi thành công !');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Auth::guest()) {
            $room = Room::find($id);
            
            $room->delete();

            return redirect()->back()->with('success', 'Đã xóa !');
        }else{
            return redirect('/');
        }
    }

    public function search(){
        $q = input::get ('q');
        $rooms = Room::where('kind_of_room', 'LIKE', '%'.$q.'%')->paginate(10);
        if(count($rooms) > 0) {
            if ($q != NULL) {
                $search_key = "Kết quả tìm kiếm cho: <b>" . $q . "</b>"; 
                return view('home',['rooms'=>$rooms,'search_key'=>$search_key]);
            }else{
                return view('home',['rooms'=>$rooms]);
            }
        }   
        else {
            $search_key = "<b>Không tìm thấy</b> kết quả nào cho từ khóa bạn vừa tìm: <b>" . $q. "</b>"; 
            $rooms = Room::orderBy('created_at','asc')->paginate(10);
            return view('home',['rooms'=>$rooms,'search_key'=>$search_key]);
        }
    }
}
