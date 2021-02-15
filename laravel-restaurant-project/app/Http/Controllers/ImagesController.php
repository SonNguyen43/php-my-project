<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Images;
use DB;

class ImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Images::orderBy('created_at','asc')->paginate(10);
        return view('home')->with('images', $images);
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
            'image'   =>  'image|nullable|max:1999'
        ]);

        if($request->hasFile('image')) {
            $file = $request->file('image');
            
            # name & extension
            $filenamewithExt = $file->getClientOriginalName();

            #name
            $filename = pathinfo($filenamewithExt,PATHINFO_FILENAME);
        
            # ext
            $extension = $file->getClientOriginalExtension();
            
            # fileName to store
            $fileNameToStore = $filename.'_'.time().'_'.substr(md5(time()), 0, 24).'.'.$extension;
               
            # Upload Image
            $path = $file->storeAs('public/images/admin/images_hightlight/',$fileNameToStore);
              

            $images = new Images;
            $images->title = $request->title;
            $images->images = $fileNameToStore;
            $images->save();

		}else{
            return redirect()->back()->with('error', 'Chưa có ảnh được chọn');
        }

        return redirect()->back()->with('success', 'Tải lên thành công');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $idimg = $_REQUEST['idimg'];

        $image = Images::find($idimg);

        Storage::delete('public/images/admin/images_hightlight/'.$image->images);

        $image->delete();

        return redirect()->back()->with('success', 'Đã xóa !');
    }
}
