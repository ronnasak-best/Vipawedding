@extends('backend.layouts.master')
@section('content')
<div class="page-header">
  <div class="row  ">
    <h3 class="page-title col-sm-3">
      <span class="page-title-icon bg-gradient-primary text-white mr-2">
        <i class="mdi mdi-tshirt-crew"></i>
      </span>
    </h3>
    <ol class="breadcrumb col-sm-9">
      <h2 class="breadcrumb-item"><a href="{{route('products.index')}}">Product</a></h2>
      <h2 class="breadcrumb-item active" aria-current="page">Add Attributes</h2>
    </ol>
  </div>
</div>
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
    <form  class="forms-sample" method="post" role="form" action="{{route('product_atrr.update',$product['id'])}}">
      <input type="hidden" name="_method" value="PATCH"/>
      {{csrf_field()}}
    <table class="table table-hover">
      <thead>
        <tr class="text-center">
          <th>SKU</th>
          <th>Size</th>
          <th>Stock</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>

        @foreach($attributes as $att)
        <input type="hidden" name="id[]" value="{{$att['id']}}">
        <tr class="text-center">
        <td style="width: 200px">
          <input type="text" name="sku[]" id="sku" class="form-control" value="{{$att['sku']}}" required="required" ;>
        </td>
        <td style="width: 180px">
          <input type="text" name="size[]" id="size" class="form-control" value="{{$att['size']}}" required="required" ;>
        </td>
        <td style="width: 180px">
          <input type="number" min="0" name="stock[]" id="stock" class="form-control" value="{{$att['stock']}}" required="required" ;>
        </td>
        <td>
          <button type="submit" class="btn btn-inverse-info btn-sm">Edit</button>
        </td>
        @endforeach
      </tbody>
    </table>
  </form>
  </div>
</div>
</div>
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <form class="forms-sample" method="post" action="{{route('product_atrr.store')}}">
          {{csrf_field()}}
          <input type="hidden" name="products_id" value="{{$product['id']}}">
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">SKU :</label>
              <div class="col-sm-12">
                <input type="text" name="sku" class="form-control" id="coler" required="required">
             </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Size :</label>
              <div class="col-sm-12">
                <input type="text" name="size" class="form-control" id="coler" required="required">
             </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Stock :</label>
              <div class="col-sm-12">
                <input type="number"  min="0" name="stock" class="form-control" id="coler" required="required">
             </div>
          </div>
            <button type="submit" class="btn btn-gradient-primary mr-2">ADD</button>
        </form><br><br>
      </div>
    </div>
  </div>



@endsection
