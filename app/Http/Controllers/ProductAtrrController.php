<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\ProductAtrr;

class ProductAtrrController extends Controller
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
        $this->validate($request, [
            'sku' => 'required',
            'size' => 'required',
            'stock' => 'required|numeric'
        ]);

        ProductAtrr::create($request->all());
        return back()->with('message', 'บันทึกข้อมูลสำเร็จ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $attributes = ProductAtrr::where('products_id', $id)->get();
        $product = Products::findOrFail($id);
        return view('backend.products.product_atrr', compact('product', 'attributes'));
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
        $request_data = $request->all();
        foreach ($request_data['id'] as $key => $value) {
            $update_attr = ProductAtrr::where([['products_id', $id], ['id', $request_data['id'][$key]]])
                ->update([
                    'sku' => $request_data['sku'][$key],
                    'size' => $request_data['size'][$key],
                    'stock' => $request_data['stock'][$key]
                ]);
        }
        return back()->with('message', 'แก้ไขข้อมูลสำเร็จ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteAttr = ProductAtrr::findOrFail($id);
        $deleteAttr->delete();
        return back()->with('message', 'Deleted Success!');
    }
}
