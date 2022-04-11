<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\District;

class DistrictController extends Controller
{
    public function provinces()
    {
      $provinces = District::groupBy('province')
        ->get();
      return response()->json($provinces);
    }
    public function amphoes($province)
    {
      $amphoes = District::where('province',$province)
        ->groupBy('amphoe')
        ->get();
      return response()->json($amphoes);
    }
    public function districts($province,$amphoe)
    {
      $districts = District::where('province',$province)
        ->where('amphoe',$amphoe)
        ->groupBy('district')
        ->get();
      return response()->json($districts);
    }
    public function detail($province,$amphoe,$district)
    {
      $districts = District::where('province',$province)
        ->where('amphoe',$amphoe)
        ->where('district',$district)
        ->get();
      return response()->json($districts);
    }  //
}
