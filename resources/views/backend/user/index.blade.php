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
          <td></td>
          <td></td>
          <td></td>
            <td>
              <a href="" class="btn btn-inverse-info btn-sm">Edit</a>
              <a href="" class="delete-confirm btn btn-inverse-danger btn-sm">Delete</a>

            </td>
          </tr>

        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection
