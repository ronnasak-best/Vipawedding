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
      <h2 class="breadcrumb-item"><a href="{{route('bank.index')}}">Bank</a></h2>
      <h2 class="breadcrumb-item active" aria-current="page">create</h2>
    </ol>
  </div>
</div>
<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <form class="forms-sample" method="post" action="{{route('bank.update',$bank->id)}}" enctype="multipart/form-data">
       @csrf
       @method('PATCH')
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">ธนาคาร</label>
            <div class="col-sm-12">
              <input type="text" name="bank_name" class="form-control" value="{{$bank->bank_name}}">
           </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">ชื่อบัญชี:</label>
              <div class="col-sm-12">
                <input type="text" name="account_name" class="form-control" value="{{$bank->account_name}}">
             </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">เลขบัญชี:</label>
              <div class="col-sm-12">
                <input type="number" name="account_no" class="form-control"
                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                maxlength = "10"
                                required="" value="{{$bank->account_no}}">
             </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">สาขา:</label>
              <div class="col-sm-12">
                <input type="text" name="bank_location" class="form-control" value="{{$bank->bank_location}}">
             </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-3 col-form-label">logo:</label>
              <div class="col-sm-12">
                <input type="file" name="logo" class="form-control" >
             </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">สถานะ :</label>
            <div class="col-sm-3">
              <div class="form-check" >
                <input type="radio" class="form-check-input" name="status" id="membershipRadios1" value="1" {{($bank->status==0)?'':'checked'}}> Enabled
              </div>
            </div>
            <div class="col-sm-2.5">
              <div class="form-check">
                <input type="radio" class="form-check-input" name="status" id="membershipRadios2" value="0" {{($bank->status==1)?'':'checked'}}> Disabled
              </div>
            </div>
          </div>
        <button type="submit" class="btn btn-gradient-primary mr-2">Submit</button>
      </form>
    </div>
  </div>
</div>
@endsection
