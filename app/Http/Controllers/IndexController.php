<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\ProductAtrr;

class IndexController extends Controller
{
    public function index()
    {
  //  $id = IdGenerator::generate(['table' => 'test', 'length' => 6, 'prefix' => date('y')]);

      $products = Products::paginate(6);
      return view('frontend.product',compact('products'));
    }
    public function detialpro($id)
    {
      $detail_product=Products::findOrFail($id);
      $imagesGalleries=Gallery::where('products_id',$id)->get();
      $totalStock=ProductAtrr::where('products_id',$id)->sum('stock');
      return view('frontend.product_details',compact('detail_product','imagesGalleries','totalStock'));
    }
    public function getAttrs(Request $request){
        $all_attrs=$request->all();
        //print_r($all_attrs);die();
        $attr=explode('-',$all_attrs['size']);
        //echo $attr[0].' <=> '. $attr[1];
        $result_select=ProductAtrr::where(['products_id'=>$attr[0],'size'=>$attr[1]])->first();
        echo $result_select->price."#".$result_select->stock;
    }
    public function listByCat($id,$ss){

      if($ss==1){

        $products = DB::table('products')
              ->join('categories','products.categories_id', '=', 'categories.id')
              ->where('categories.parent_id', '=', $id)
              ->select('products.*')
             ->paginate(6);
             //dd($products);
      //  $products=Products::where('parent_id',$id)->paginate(6);
      }elseif ($ss==0) {
        $products=Products::where('categories_id',$id)->paginate(6);
      }

      // dd($products);
      // $byCate=Category_model::select('name')->where('id',$id)->first();
       return view('frontend.product',compact('products'));
    }
    public function howitwork(){

       return view('frontend.how_it_works');
    }
    public function test(){

       return 'test';
    }
}
