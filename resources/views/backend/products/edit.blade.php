@extends('backend.layouts.master')
@section('content')
<div class="page-header">
  <div class="row  ">
    <h3 class="page-title col-sm-3">
      <span class="page-title-icon bg-gradient-primary text-white mr-2">
        <i class="mdi mdi-tshirt-crew"></i>

      </span>
    </h3>
    <ol class="breadcrumb col-sm-8">
      <h2 class="breadcrumb-item"><a href="{{route('products.index')}}">Product</a></h2>
      <h2 class="breadcrumb-item active" aria-current="page">edit</h2>
    </ol>
  </div>
</div>
<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <form class="forms-sample" method="post" action="{{action('ProductsController@update',$pro['id'])}}" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PATCH"/>
        {{csrf_field()}}
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Product Name :</label>
            <div class="col-sm-12">
              <input type="text" name="p_name" class="form-control" id="exampleInputUsername2" value="{{$pro['p_name']}}">
           </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Category Lavel :</label>
            <div class="col-sm-12 " >
                <select class="form-control form-control-lg" name="categories_id" id="categories_id" value="{{$pro['categories_id']}}">
                        @foreach($cate_levels as $key=>$value)
                            <option value="{{$key}}" {{($pro->categories_id==$key)?' selected':''}}>{{$value}}</option>

                            <?php
                              if($key!=0){
                                $sub_categories=DB::table('categories')->select('id','name')->where('parent_id',$key)->get();
                                    if(count($sub_categories)>0){
                                       foreach ($sub_categories as $sub_category){?>
                                            <option value="{{$sub_category->id}}"{{$pro->categories_id==$sub_category->id?' selected':''}}>&nbsp;&nbsp;--{{$sub_category->name}}</option>
                                        <?php }
                                    }
                                }
                            ?>
                        @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Product Code :</label>
            <div class="col-sm-12">
              <input type="text" name="p_code" class="form-control" id="exampleInputUsername2"value="{{$pro['p_code']}}" >
           </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Color :</label>
            <div class="col-sm-12">
              <input type="text" name="p_color" class="form-control" id="coler" value="{{$pro['p_color']}}">
           </div>
        </div>
        <div class="form-group row">
          <label  class="col-sm-3 col-form-label">Description :</label>
            <div class="col-sm-12">
              <textarea name="description" id="summernote">{{$pro['description']}}</textarea>
           </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-10 col-form-label">Price:</label>
          <div class="input-group col-sm-4">
            <input type="number" min="0" name="price" class="form-control" value="{{$pro['price']}}">
            <div class="input-group-prepend">
              <span class="input-group-text bg-gradient-primary text-white">฿</span>
            </div>

          </div>
        </div>

        <div class="form-group row ">
          <label class="col-sm-3 col-form-label">File upload :</label>
          <input type="file" name="image" id="image"class="file-upload-default">
          <div class="input-group col-sm-12">
            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
            <span class="input-group-append">
              <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
            </span>
          </div>
        </div>



        <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
      </form>
    </div>
  </div>
</div>
<script>
      $('#summernote').summernote({
        //placeholder: 'Hello Bootstrap 4',
        tabsize: 3,
        height: 100
      });
    </script>
    <script>
       var msg = '{{Session::get('message')}}';
       var exist = '{{Session::has('message')}}';
       if(exist){
         alert(msg);
       }
     </script>

@endsection
