<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\OrdersProduct;
use App\Models\Products;
use App\Models\ProductAtrr;
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
      return view('frontend.user.myorders',compact('orders'));
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
        //
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
     
        //$order_update = Orders::where('id_or',$id)->first();
        $this->validate($request,[
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          ]);
          //$formInput=$request->all();
            if($request->file('image')){
              $image=$request->file('image');
                if($image->isValid()){
                  $filename  = time() . '.' . $image->getClientOriginalExtension();
                  $path = public_path('slip/' . $filename);
                  Image::make($image->getRealPath())->save($path);
  
                  //$filename = $image->getClientOriginalName();
                //  $path=public_path('products/',$filename);
                //  Image::make($image)->resize(300,300)->save($path);
                //  $image->resize(300,300)->save($path,$filename);
  
                //  $image->save();
                }
  
            }
  
            Orders::where('id',$id)->update(['payment_slip'=>$filename,'status'=>2]);
  
  
          return redirect()->route('orders.index')->with('Thank you! Your payment has been successfully accepted!');
    }
    public function upload_return(Request $request)
    {
      $id = $request->id;
      //dd($id);

        //$order_update = Orders::where('id_or',$id)->first();
        $this->validate($request,[
          'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        //$formInput=$request->all();
          if($request->file('image')){
            $image=$request->file('image');
              if($image->isValid()){
                $filename  = time() . '.' . $image->getClientOriginalExtension();
                $path = public_path('slipShipping/' . $filename);
                Image::make($image->getRealPath())->save($path);

                //$filename = $image->getClientOriginalName();
              //  $path=public_path('products/',$filename);
              //  Image::make($image)->resize(300,300)->save($path);
              //  $image->resize(300,300)->save($path,$filename);

              //  $image->save();
              }

          }
          $status = 4;
          OrdersProduct::where('id',$id)->update(['image'=>$filename,'status'=>$status]);


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
}
