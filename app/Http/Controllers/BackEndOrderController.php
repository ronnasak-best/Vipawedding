<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\OrdersProduct;
use App\Models\Products;
use App\Models\ProductAtrr;

class BackEndOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Orders::whereBetween('status',[0,4])->get();
        return view('backend.orders.index',compact('orders'));
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
        $order = Orders::find($request->id);
        $order->status = $request->status;
        $order->save();
        return back();

        // foreach ($request->id as $key => $value) {
        //     $OrdersProduct = OrdersProduct::find($value);
        //     if($request->status[$key] == 2){
        //         if($request->tracking_no[$key] !='' ){
        //             $OrdersProduct->tracking_no = $request->tracking_no[$key];
        //             $OrdersProduct->status = 3;
        //         }elseif($request->tracking_no[$key] =="") {
        //           $OrdersProduct->status = 2;
        //           $OrdersProduct->tracking_no = $request->tracking_no[$key];
        //         }
        //     }elseif ($request->status[$key] == 3) {
        //         if($request->tracking_no[$key] =='' ){
        //             $OrdersProduct->tracking_no = $request->tracking_no[$key];
        //             $OrdersProduct->status = 2;
        //         }else {
        //           $OrdersProduct->tracking_no = $request->tracking_no[$key];
        //           $OrdersProduct->status = 3;
        //         }
        //   }
        //   $OrdersProduct->save();
        //   }



        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Orders $orderss)
    {
        $orderproduct = $orderss->ordersproduct ;
        //$ordersproduct = OrdersProduct::where('order_id',$id)->first();
        //dd($orderss);
        return view('backend.orders.order_details',compact('orderproduct','orderss'));
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $orders_product = OrdersProduct::where('order_id',$id)->get();
        foreach ($orders_product as $key => $value) {
            $product_atrr= ProductAtrr::where('products_id',$value->product_id)
                                              ->where('size',$value->size)
                                              ->first();
            $product_atrr->stock = $product_atrr->stock + 1;
            $product_atrr->save();
        }
        $order = Orders::find($id);
        $order->status = 0;
        $order->save();
        return back();
    }
    public function payment_confirm($id)
    {
        $order = Orders::find($id);
        $order->status = 3;
        $order->save();
        return back();
    }
    public function disPayment($id)
    {
        $order = Orders::find($id);
        $order->payment_slip = '';
        $order->status = 1;
        $order->save();
        return back();
    }
    public function ship_track(Request $request, $id)
    {
        if($request->tracking_no_send !=''){
            $order = Orders::find($id);
            $order->tracking_no_send = $request->tracking_no_send;
            $order->status = 4;
            $order->save();
        }
        return back();
    }
    public function order_back($id)
    {
        $order = Orders::find($id);
        $order->status = 5;
        $order->save();
        return back();
    }
}
