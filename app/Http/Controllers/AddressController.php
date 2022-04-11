<?php

namespace App\Http\Controllers;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $id=auth()->user()->id;
        //  dd($id);
        //$address_default = Address::where([['users_id',$id],['default',1]])->get();
        $address = Address::where('users_id',$id)->orderBy('default_address','desc')->get();
        //dd($address_default);
        return view('frontend.user.myaccount',compact('address'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $id=auth()->user()->id;
        $address = Address::where('users_id',$id)->orderBy('default_address','desc')->get();
        return $address;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->default_address==1){
            $address = Address::where('users_id',auth()->user()->id)->get();
            foreach ($address as $key => $value) {
              $value->default_address=0;
              $value->save();
            }
          }
          Address::create([
            'users_id' => auth()->user()->id,
            'name' => $request->address_name,
            'surname' => $request->address_name,
            'address' => $request->address,
            'province' => $request->province,
            'district' => $request->district,
            'sub_district' => $request->sub_district,
            'pincode' => $request->pincode,
            'default_address' => $request->default_address,
            'mobile' => $request->phone_number,
            // 'txtBank' => $request->txtBank,
            // 'account_name' => $request->account_name,
            // 'account_no' => $request->account_no
        ]);
        return response(['message'=>'Added Success!'], 200);
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
        $address = Address::find($id);
        return view('frontend.user.edit_address',compact('address'));
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
        if($request->default_address==1){
            $address = Address::where('users_id',auth()->user()->id)->get();
            foreach ($address as $key => $value) {
              $value->default_address=0;
              $value->save();
            }
          }
              $address = Address::find($id);        
              $address->name = $request->get('address_name');
              $address->surname = $request->get('address_name');
              $address->address = $request->get('address');
              $address->province = $request->get('province');
              $address->district = $request->get('district');
              $address->sub_district = $request->get('sub_district');
              $address->pincode = $request->get('pincode');
              $address->mobile = $request->get('phone_number');
              $address->default_address = $request->get('default_address');
              // $address->txtBank = $request->get('txtBank');
              // $address->account_name = $request->get('account_name');
              // $address->account_no = $request->get('account_no');
              $address->save();
              return response(['message'=>'Update Success!'], 200);
              // return redirect()->route('myaccount.index')->with('message','Added Success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Address::find($id)->delete();
        return response(['message'=>'=Delete Success!'], 200);
    }
}
