<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Gallery;
use Image;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          ]);
          $formInput=$request->all();
            if($request->file('image')){
              $image=$request->file('image');
                if($image->isValid()){
                  $filename  = time() . '.' . $image->getClientOriginalExtension();
                  $path = public_path('products/' . $filename);
                  Image::make($image->getRealPath())->save($path);

                  //$filename = $image->getClientOriginalName();
                //  $path=public_path('products/',$filename);
                //  Image::make($image)->resize(300,300)->save($path);
                //  $image->resize(300,300)->save($path,$filename);
                  $formInput['image']=$filename;
                }
            }
          Gallery::create($formInput);
          return back()->with('message','Add Images Successed');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product=Products::findOrFail($id);
        $imageGallery=Gallery::where('products_id',$id)->get();
        return view('backend.products.Image_gallery',compact('product','imageGallery'));
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
        $delete=Gallery::findOrFail($id);
      $image = public_path('products/' .$delete->image);
      if($delete->delete()){
          unlink($image);
      }
      return back()->with('message','Delete Success!');
    }
}
