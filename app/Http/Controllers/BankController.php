<?php

namespace App\Http\Controllers;
use Image;
use Illuminate\Http\Request;
use App\Models\Bank;

class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banks = Bank::all();
        return view('backend.bank.index',compact('banks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.bank.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd( $request->file('logo'));
        $request->validate([
            'account_no' => 'required',
            'account_name' => 'required',
            'bank_name' => 'required',
            'bank_location' => 'required',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $formInput=$request->all();
            if($request->file('logo')){
              $image=$request->file('logo');
                if($image->isValid()){
                    $filename  = $image->getClientOriginalName();
                    $path = public_path('banks/' . $filename);
                    Image::make($image->getRealPath())->save($path);
                    $formInput['logo']=$filename;
                }
            }
        Bank::create($formInput);
        return redirect()->route('bank.index')->with('success','Bank created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bank = Bank::find($id);
        return view('backend.bank.edit',compact('bank'));
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
        $request->validate([
            'account_no' => 'required',
            'account_name' => 'required',
            'bank_name' => 'required',
            'bank_location' => 'required',
        ]);
        $bank = Bank::find($id);
        $old_filename = Bank::whereId($id)->first()->logo;
        if($request->file('logo')){
            $filepath = public_path('banks/'.$old_filename);
            unlink($filepath);
            $image=$request->file('logo');
              if($image->isValid()){
                  $filename  = $image->getClientOriginalName();
                  $path = public_path('banks/' . $filename);
                  Image::make($image->getRealPath())->save($path);
                  $bank['logo']=$filename;
              }
            }
        else{
            $bank['logo']=$old_filename;
        }
        $bank['account_no']=$request->account_no;
        $bank['account_name']=$request->account_name;
        $bank['bank_name']=$request->bank_name;
        $bank['bank_location']=$request->bank_location;
        $bank['status']=$request->status;
        $bank->save();
        return redirect()->route('bank.index')->with('success','Bank updated successfully');
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
