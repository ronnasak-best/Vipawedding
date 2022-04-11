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
      <h2 class="breadcrumb-item active" aria-current="page">Add Images</h2>
    </ol>
  </div>
</div>


  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <form class="forms-sample" method="post" action="{{route('Image-gallery.store')}}" enctype="multipart/form-data">
          {{csrf_field()}}
          <input type="hidden" name="products_id" value="{{$product['id']}}">
          <div class="form-group row ">
            <label class="col-sm-3 col-form-label">File upload :</label>
            <input type="file" name="image" id="image"class="file-upload-default" multiple>
            <div class="input-group col-sm-10">
              <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
              <span class="input-group-append">
                <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
              </span>
            </div>
            <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
          </div>

        </form><br><br>
      </div>
    </div>
  </div>
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <table class="table table-hover">
          <thead>
            <tr class="text-center">
              <th>ID</th>
              <th>image</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php $i=1;?>
            @foreach($imageGallery as $image)
            <tr class="text-center">
              <td>{{$i++}}</td>
              <td><img class="rounded" src="{{url('/')}}/products/{{$image['image']}}" style="width: 200px; height: 150px;"></td>
              <td><a href="delete-Imagegallery/{{$image['id']}}" class="delete-confirm btn btn-inverse-danger btn-sm">Delete</a></td>
            </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

@endsection
