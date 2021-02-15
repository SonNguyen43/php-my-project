<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use App\Categorie;
use App\Food;
use App\Room;
use DB;
use Auth;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::guest()) {
            $categories = Categorie::orderBy('created_at','asc')->paginate(10);
            return view('home')->with('categories',$categories);
        }
        else{
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
           
        }
        else{
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
            $this->validate($request,[
                'name' => 'required',
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
                $path = $file->storeAs('public/images/admin/categorie',$fileNameToStore);
            }

            $categorie = new Categorie;
            $categorie->name = $request->name;
            $categorie->image = $fileNameToStore;
            $categorie->save();

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
        $categories_id = $id;
        $condition = true;
        
        $foods = Food::when($condition, function ($query) use ($categories_id) {
            return $query->where('categories_id', $categories_id)->orderBy('created_at','desc');
        })
        ->paginate(1000);

        $highlights = 'true';
        $condition = true;
        $categories_all =  Categorie::orderBy('created_at','desc')->paginate();
        $rooms = Room::orderBy('created_at','asc')->paginate(10);

        $foods_hightlight_all = Food::when($condition, function ($query) use ($highlights) {
            return $query->where('highlights', $highlights)->orderBy('created_at','desc');
        })
        ->paginate(9);

        return view('welcome.content.foodsbyid', ['rooms'=>$rooms, 'foods'=>$foods, 'categories_all'=>$categories_all, 'foods_hightlight_all'=>$foods_hightlight_all ]);
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
            $edit_categorie = Categorie::find($id);
            return view('home',['edit_categorie'=>$edit_categorie]);
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
            $this->validate($request,[
                'name' => 'required',
                'image'   =>  'image|nullable|max:1999'
            ]);

            $categorie = Categorie::find($id); 
            $categorie->name = $request->name;

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

                Storage::delete('public/images/admin/categorie/'.$categorie->image);
                
                # Upload Image
                $path = $file->storeAs('public/images/admin/categorie',$fileNameToStore);

                $categorie->image = $fileNameToStore;
            }
        
            $categorie->save();

            return redirect()->back()->with('success', 'Thay đổi thành công !');
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
            
        }else{
            return redirect('/');
        }
    }

    public function search(){
        if (!Auth::guest()) {
            $q = input::get ('q');
            $categories = Categorie::where('name', 'LIKE', '%'.$q.'%')->paginate(10);
            if(count($categories) > 0) {
                if ($q != NULL) {
                    $search_key = "Kết quả tìm kiếm cho: <b>" . $q . "</b>"; 
                    return view('home',['categories'=>$categories,'search_key'=>$search_key]);
                }else{
                    return view('home',['categories'=>$categories]);
                }
            }   
            else {
                $search_key = "<b>Không tìm thấy</b> kết quả nào cho từ khóa bạn vừa tìm: <b>" . $q. "</b>"; 
                $categories = Categorie::orderBy('created_at','asc')->paginate(10);
                return view('home',['categories'=>$categories,'search_key'=>$search_key]);
            }
        }else{
            return redirect('/');
        }
    }
}
