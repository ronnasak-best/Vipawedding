@extends('backend.layouts.master')
@section('content')
<div class="page-header">
  <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white mr-2">
      <i class="mdi mdi-tshirt-crew"></i>
    </span> Product </h3>
    <nav aria-label="breadcrumb">
      <a href="{{route('products.create')}}" class="btn btn-info btn-md mdi mdi-plus-circle">ADD</a>
    </nav>
</div>
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <table class="table" id="dynamic-row">
        <thead>
          <tr class="text-center">
            <th>ID</th>
            <th>Image</th>
            <th>Product Name</th>
            <th>Category</th>
            <th>Code</th>
            <th>Color</th>
            <th>Price</th>
            <th>Image gallery</th>
            <th>Add attribute</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($products as $product)
            <?php
              $parent_cates = DB::table('categories')->select('name')->where('id',$product['categories_id'])->get();
            ?>
          <tr class="text-center">
            <td>{{$product['id']}}</td>
            <td><img class="rounded" src="{{url('/')}}/products/{{$product['image']}}" style="width:  50px; height: 50px;"> </td>
            <td>{{$product['p_name']}}</td>
            <td>
                @foreach($parent_cates as $parent_cate)
                  {{$parent_cate->name}}
                @endforeach
            </td>
            <td>{{$product['p_code']}}</td>
            <td>{{$product['p_color']}}</td>
            <td>{{$product['price']}}</td>
            <td>
              <a href="{{route('Image-gallery.show',$product['id'])}}" class="btn btn-inverse-primary btn-sm">Images</a>
            </td>
            <td>
              <a href="{{route('product_atrr.show',$product['id'])}}" class="btn btn-inverse-success btn-sm">Add Attr</a>
            </td>
            <td>
              <a href="{{route('products.edit',$product['id'])}}" class="btn btn-inverse-info btn-sm">Edit</a>
              
            </td>
          </tr>

          @endforeach
        </tbody>
      </table>

    </div>
  </div>
</div>



@endsection
