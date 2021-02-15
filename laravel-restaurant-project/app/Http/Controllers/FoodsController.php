<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Categorie;
use App\Food;
use App\Room;
use Auth;

class FoodsController extends Controller
{

    public function all(){

        $highlights = 'true';
        $condition = true;
        $categories_all =  Categorie::orderBy('created_at','desc')->paginate();

        $foods_hightlight_all = Food::when($condition, function ($query) use ($highlights) {
            return $query->where('highlights', $highlights)->orderBy('created_at','desc');
        })
        ->paginate(9);

        $foods = Food::orderBy('created_at','asc')->paginate(10);
        $rooms = Room::orderBy('created_at','asc')->paginate(10);

        return view('welcome.content.allfood', ['rooms'=>$rooms, 'foods'=>$foods, 'categories_all'=>$categories_all, 'foods_hightlight_all'=>$foods_hightlight_all]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::guest()) {
            $foods = Food::orderBy('created_at','asc')->paginate(10);
            return view('home')->with('foods',$foods);
        }else{
            return redirect('/');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::guest()) {
            $create_food = Categorie::all();
            return view('home')->with('create_food', $create_food);
        }else{
            return redirect('/');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!Auth::guest()) {
            $this->validate($request, [
                'name' => 'required',
                'description' => 'required',
                'categories_id' => 'required',
                'image'   =>  'image|nullable|max:1999|required'
            ]);

            # Ảnh mô tả
            if($request->hasFile('image')) {
                $file = $request->file('image');
                # Name & Extension
                $filenamewithExt = $file->getClientOriginalName();

                # Name
                $filename = pathinfo($filenamewithExt,PATHINFO_FILENAME);
            
                # Ext
                $extension = $file->getClientOriginalExtension();
                
                # FileName to store
                $fileNameToStore = $filename.'_'.time().'.'.$extension;

                # Upload Image
                $path = $file->storeAs('public/images/admin/food',$fileNameToStore);
            }else{
                $fileNameToStore = 'noImage.png';
            }

            # Tạo bài viết
            $food = new Food;
            $food->name = $request->name;
            $food->description = $request->description;
            $food->categories_id = $request->categories_id;
            $food->image = $fileNameToStore;

            $food->save();
            
            return redirect()->back()->with('success', 'Đã tạo mới !');
        }else{
            return redirect('/');
        }
  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $food = Food::find($id);

        $highlights = 'true';
        $condition = true;
        $categories_all =  Categorie::orderBy('created_at','desc')->paginate();

        $foods_hightlight_all = Food::when($condition, function ($query) use ($highlights) {
            return $query->where('highlights', $highlights)->orderBy('created_at','desc');
        })
        ->paginate(9);
        $rooms = Room::orderBy('created_at','asc')->paginate(10);

        return view('welcome.content.detailfood', ['rooms'=>$rooms,'food'=>$food, 'categories_all'=>$categories_all, 'foods_hightlight_all'=>$foods_hightlight_all]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::guest()) {
            $edit_food = Food::find($id);
            $categories_edit = Categorie::all();;
            return view('home',['edit_food'=>$edit_food,'categories_edit'=>$categories_edit]);
        }else{
            return redirect('/');
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
        if (!Auth::guest()) {
            $this->validate($request, [
                'name' => 'required',
                'description' => 'required',
                'categories_id' => 'required',
                'image'   =>  'image|nullable|max:1999',
                'highlights' => 'required'
            ]);

            $food = Food::find($id);
            $food->name = $request->name;
            $food->description = $request->description;
            $food->categories_id = $request->categories_id;
            $food->highlights = $request->highlights;

            # Ảnh mô tả
            if($request->hasFile('image')) {
                $file = $request->file('image');
                # Name & Extension
                $filenamewithExt = $file->getClientOriginalName();

                # Name
                $filename = pathinfo($filenamewithExt,PATHINFO_FILENAME);
            
                # Ext
                $extension = $file->getClientOriginalExtension();
                
                # FileName to store
                $fileNameToStore = $filename.'_'.time().'.'.$extension;

                # delete image
                Storage::delete('public/images/admin/food/'.$food->image);
                
                # Upload Image
                $path = $file->storeAs('public/images/admin/food',$fileNameToStore);

                $food->image = $fileNameToStore;
            }

            $food->save();
            
            return redirect()->back()->with('success', 'Đã chỉnh sửa !');
        }else{
            return redirect('/');
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
        if (!Auth::guest()) {
            $food = Food::find($id);

            Storage::delete('public/images/admin/food/'.$food->image);
            
            $food->delete();

            return redirect()->back()->with('success', 'Đã xóa !');
        }else{
            return redirect('/');
        }
    }

    public function search(){
        if (!Auth::guest()) {
            $q = input::get ('q');
            $foods = Food::where('name', 'LIKE', '%'.$q.'%')->paginate(10);;
            if(count($foods) > 0) {
                if ($q != NULL) {
                    $search_key = "Kết quả tìm kiếm cho: <b>" . $q . "</b>"; 
                    return view('home',['foods'=>$foods,'search_key'=>$search_key]);
                }else{
                    return view('home',['foods'=>$foods]);
                }
            }   
            else {
                $search_key = "<b>Không tìm thấy</b> kết quả nào cho từ khóa bạn vừa tìm: <b>" . $q. "</b>"; 
                $foods = Food::orderBy('created_at','asc')->paginate(10);
                return view('home',['foods'=>$foods,'search_key'=>$search_key]);
            }
        }else{
            return redirect('/');
        }
    }
}
