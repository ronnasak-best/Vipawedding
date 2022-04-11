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
      <h2 class="breadcrumb-item"><a href="{{route('category.index')}}">Category</a></h2>
      <h2 class="breadcrumb-item active" aria-current="page">edit</h2>
    </ol>
  </div>
</div>
<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <form class="forms-sample" method="post" action="{{action('CategoryController@update',$cat['id'])}}">
        <input type="hidden" name="_method" value="PATCH"/>
        {{csrf_field()}}
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Category Name :</label>
            <div class="col-sm-10">
              <input type="text" name="name" class="form-control" id="exampleInputUsername2" value="{{$cat['name']}}" >
           </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Category Lavel :</label>
            <div class="col-sm-10 " >
                <select class="form-control form-control-lg" name="parent_id" id="parent_id" value="{{$cat['parent_id']}}">
                        @foreach($cate_levels as $key=>$value)
                            <option value="{{$key}}" {{($cat->parent_id==$key)?' selected':''}}>{{$value}}</option>
                            <?php
                                if($key!=0){
                                    $subCategory=DB::table('categories')->select('id','name')->where('parent_id',$key)->get();
                                    if(count($subCategory)>0){
                                        foreach ($subCategory as $subCate){
                                            echo '<option value="'.$subCate->id.'">&nbsp;&nbsp;--'.$subCate->name.'</option>';
                                        }
                                    }
                                }
                            ?>
                        @endforeach
                </select>
            </div>

        </div>
        <div class="form-group row">
          <label  class="col-sm-3 col-form-label">Description :</label>
            <div class="col-sm-10">
              <textarea name="description" id="editor">{{$cat['description']}}</textarea>
           </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Status :</label>
          <div class="col-sm-3">
            <div class="form-check" >
              <input type="radio" class="form-check-input" name="status" id="membershipRadios1" value="1" {{($cat->status==0)?'':'checked'}}> Enabled
            </div>
          </div>
          <div class="col-sm-2.5">
            <div class="form-check">
              <input type="radio" class="form-check-input" name="status" id="membershipRadios2" value="0" {{($cat->status==1)?'':'checked'}}> Disabled
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
      </form>
    </div>
  </div>
</div>
@endsection
