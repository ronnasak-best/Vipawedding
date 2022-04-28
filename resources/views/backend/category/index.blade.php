@extends('backend.layouts.master')
@section('content')
<div class="page-header">
  <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white mr-2">
      <i class="mdi mdi-package"></i>
    </span> Category </h3>
    <nav aria-label="breadcrumb">
      <a href="{{route('category.create')}}" class="btn btn-info btn-md mdi mdi-plus-circle">ADD</a>
    </nav>
</div>
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <table class="table"id="dynamic-row">
        <thead>
          <tr>
            <th>Category Name</th>
            <th>Parent Name</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($categoty as $cat)
            <?php
              $parent_cates = DB::table('categories')->select('name')->where('id',$cat['parent_id'])->get();
            ?>
          <tr>
            <td>{{$cat['name']}}</td>
            <td>
              @foreach($parent_cates as $parent_cate)
                {{$parent_cate->name}}
              @endforeach
            </td>
            <td>
              @if($cat['status']==0)
                  <label class="badge badge-danger">DISABLED</label>
              @else
                  <label class="badge badge-success">ENABLED</label>
              @endif
            </td>
            <td>
              <a href="{{route('category.edit',$cat['id'])}}" class="btn btn-inverse-info btn-sm">Edit</a>
              
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection
