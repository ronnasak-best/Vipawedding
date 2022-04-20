@extends('backend.layouts.master')
@section('content')
<div class="page-header">
  <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white mr-2">
      <i class="mdi mdi-package"></i>
    </span> Bank </h3>
    <nav aria-label="breadcrumb">
      <a href="{{route('bank.create')}}" class="btn btn-info btn-md mdi mdi-plus-circle">ADD</a>
    </nav>
</div>
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <table class="table"id="dynamic-row">
        <thead>
          <tr>
            <th>รูป</th>
            <th>ชื่อธนาคาร</th>
            <th>เลขบัญชี</th>
            <th>ชื่อ-นามสุกล</th>
            <th>สาขา</th>
            <th>สถานะ</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($banks as $bank)
          <tr>
            <td>
                <img class="rounded" src="{{url('/')}}/banks/{{$bank['logo']}}" style="width:  50px; height: 50px;">
            </td>
            <td>{{$bank['bank_name']}}</td>
            <td>{{$bank['account_no']}} </td>
            <td>{{$bank['account_name']}} </td>
            <td>{{$bank['bank_location']}} </td>
            <td>{{$bank['status']}} </td>
            <td>
              <a href="{{route('bank.edit',$bank['id'])}}" class="btn btn-inverse-info btn-sm">Edit</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection
