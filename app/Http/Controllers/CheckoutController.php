<?php

namespace App\Http\Controllers;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use App\Models\Address;
use App\Models\Products;
use App\Models\Orders;
use App\Models\OrdersProduct;
use App\Models\ProductAtrr;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addr = Address::where('users_id',auth()->user()->id)->orderBy('default_address','desc')->get();
        return view('frontend.checkout.checkout',compact('addr'));
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

        if($request->daterange==""){
          return back()->with('message','กรุณาเลือกวันที่เช่า');
        }else if($request->address==""){
          return back()->with('message','กรุณาเลือกที่อยู่จัดส่ง');
        }else if(Cart::content()->count() <= 0){
            return redirect()->route('cart.index');
        }else if(Cart::content()->count()>0){
            $address = Address::find($request->address);
            //$total = Cart::Subtotal() *2;
            $subtotal = (int)filter_var(Cart::Subtotal(), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $total = 2 *(float)filter_var(Cart::Subtotal(), FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            //dd((double)$total);
            $id = IdGenerator::generate(['table' => 'orders', 'length' => 10, 'prefix' => 'WD']);
            //$id = IdGenerator::generate(['table' => 'orders', 'length' => 10, 'prefix' =>'WD']);
                // Insert into order_product table
                foreach (Cart::content() as $item) {
                    $product_atrr = ProductAtrr::where('products_id',$item->id)
                                                ->where('size',$item->options->size)
                                                ->first();
                    if($product_atrr->stock < $item->qty){
                        return back()->with('message','สินค้าหมด');
                    }
                    $product_atrr->stock = $product_atrr->stock - $item->qty;
                    $product_atrr->save();
                    OrdersProduct::create([
                        'order_id' => $id,
                        'product_id' => $item->id,
                        'size' => $item->options->size,
                        'quantity' => $item->qty,
                    ]);
                }
                Cart::destroy();
                $order = Orders::create([
                    'id' => $id,
                    'user_id' => auth()->user()->id ,
                    'billing_name' => "$address->name",
                    'billing_address' => "$address->address $address->subdistrict $address->district $address->province $address->pincode",
                    'billing_phone' => $address->mobile,
                    'startDate' => $request->startdate,
                    'endDate' => $request->enddate,
                    'bank_name' => $address->txtBank,
                    'account_name' => $address->account_name,
                    'account_no' => $address->account_no,
                    'billing_subtotal' => $subtotal,
                    'billing_deposit'=> $subtotal,
                    'billing_refund' => $subtotal,
                    'billing_total' => $total,
                ]);

                return redirect()->route('orders.index')->with('Thank you! Your payment has been successfully accepted!');
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
        //
    }
}
