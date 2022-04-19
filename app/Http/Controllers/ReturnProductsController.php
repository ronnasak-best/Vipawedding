<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\OrdersProduct;
use App\Models\Products;
use App\Models\ProductAtrr;

class ReturnProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Orders::whereBetween('status',[5,8])->get();
        //  dd($orders);
          return view('backend.orders.return_pro',compact('orders'));
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
    public function show(Orders $orders_re)
    {
        $orderproduct = $orders_re->ordersproduct ;
        //$ordersproduct = OrdersProduct::where('order_id',$id)->first();
        //dd($orderss);
        return view('backend.orders.return_pro_details',compact('orderproduct','orders_re'));
    
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
        $fine = $request->late * 100;
        $order = Orders::find($id);
        $billing_deposit = $order->billing_deposit;
        if($order->status == 6){
            $order->billing_refund = ($billing_deposit - $fine) - $request->other_fine;
          }
        $order->other_fine = $request->other_fine;
        $order->late = $request->late;
        $order->status = 7;
        $order->save();

        $orders_product = OrdersProduct::where('order_id',$id)->get(); 

        foreach ($orders_product as $key => $value) {
            $product_atrr= ProductAtrr::where('products_id',$value->product_id)
                                              ->where('size',$value->size)
                                              ->first();                                        
            $product_atrr->stock = $product_atrr->stock + 1;
            $product_atrr->save();                                    
        }
        // foreach ($request->id as $key => $value) {
        //     $fine = $request->late[$key] * 500;
        //     $other_fine = $request->other_fine[$key];
        //     if($request->status[$key] == 5){
        //       $orders_product = OrdersProduct::find($value);
        //       $orders_product->status = 5;
        //       $orders_product->late = $request->late[$key];
        //       $orders_product->other_fine = $request->other_fine[$key];
        //       $orders_product->fine_detail = $request->fine_detail[$key];
        //       $orders_product->save();
        //       $product_atrr = ProductAtrr::where('products_id',$orders_product->product_id)
        //                                   ->where('size',$orders_product->size)
        //                                   ->first();
        //       $product_atrr->stock = $product_atrr->stock + $orders_product->quantity;
        //       $product_atrr->save();
        //       $order = Orders::find($id);
        //       $order->billing_refund = $order->billing_refund-$fine;
        //       $order->billing_refund = $order->billing_refund-$other_fine ;
        //       if($order->billing_refund <= 0){
        //         $order->billing_refund = 0 ;
        //         $order->save();
        //       }else {
        //         $order->save();
        //       }
  
        //     }
        //   }
        
        // $count = count($orders_product);
        // $num = 0;
        // foreach ($orders_product  as $order) {
        //   if($order->status == 5){
        //     $num++;
        //   }
        // }
        // if($count == $num){
        //   $order = Orders::find($id);
        //   $order->status = 2;
        //   $order->save();
        // }
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