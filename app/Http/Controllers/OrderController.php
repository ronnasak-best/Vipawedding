<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\OrdersProduct;
use App\Models\Products;
use App\Models\ProductAtrr;
use App\Models\Bank;

use Image;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(auth()->user()['id']);
      $orders = auth()->user()->orders()->orderBy('id', 'DESC')->get();
      //$orders=Orders::where('user_id',auth()->user()['id'])->get();
      $orders_product=OrdersProduct::all();
      //dd(json_decode($orders_product));
      //dd(json_decode($orders));
      $banks = Bank::all();
      return view('frontend.user.myorders',compact('orders','banks'));
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
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Orders $order)
    {
        $orderproduct = $order->ordersproduct ;
     // dd($orderproduct[0]->product);
     // $ordersproduct = OrdersProduct::where('order_id',$id)->first();

        return view('frontend.user.myorder',compact('orderproduct','order'));
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
        $order = Orders::where('id',$id)->first();
        $order->status = 2;
        $order->payment_slip = $request->image_slip;
        $order->bank_id = $request->bank_id;
        $order->save();
        return back();
    }

    public function upload_return(Request $request, $id)
    {
        $order = Orders::where('id',$id)->first();
        $order->status = 6;
        $order->image_return_slip = $request->image;
        $order->bank_name = $request->bank_name;
        $order->account_name = $request->account_name;
        $order->account_no = $request->account_no;
        $order->save();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function upload_image(Request $request){
        if($request->file('image')){
            $image=$request->file('image');
            $filename  = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('slipShipping/' . $filename);
        }elseif($request->file('image_slip')){
            $image=$request->file('image_slip');
            $filename  = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('slip/' . $filename);
        }
        if($image->isValid()){
            Image::make($image->getRealPath())->save($path);
          }
        return response($filename, 200);
    }
    public function delete_image(Request $request){
        $filename = request()->getContent();
        $filepath = public_path('slipShipping/'.$filename);
        unlink($filepath);
        return response('success', 200);
    }
    public function delete_image_slip(Request $request){
        $filename = request()->getContent();
        $filepath = public_path('slip/'.$filename);
        unlink($filepath);
        return response('success', 200);
    }
}
