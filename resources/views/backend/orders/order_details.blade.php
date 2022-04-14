@extends('backend.layouts.master')
@section('content')
<div class="page-header">
  <div class="row">
    <h3 class="page-title col-sm-3">
      <span class="page-title-icon bg-gradient-primary text-white mr-2">
        <i class="mdi mdi-library-books"></i>
      </span></h3>
      <ol class="breadcrumb col-sm-9">
        <h2 class="breadcrumb-item"><a href="{{route('orderss.index')}}">Orders</a></h2>
        <h2 class="breadcrumb-item active" aria-current="page">order details</h2>
      </ol>
  </div>

</div>
<div class="row">
  <div class="col-lg-6 grid-margin stretch-card">
    <div class="card">
      <form action="">
        <div class="card-body">
          <div class="ordertitle">
              หมายเลขการเช่า : {{$orderss->id}}
          </div>
          <hr style="border-top: 2px solid #eee;">
          <div class="orderhead">           
              <table>
                <tbody>
                  <tr>
                    <td>วันที่เช่า : </td>
                    <td>&nbsp;&nbsp;{{$orderss->startDate}}</td>
                  </tr>
                  <tr>
                    <td>วันที่คืน : </td>
                    <td>&nbsp;&nbsp;{{$orderss->endDate}}</td>
                  </tr>
                  <tr>
                    <td>Phone : </td>
                    <td>&nbsp;&nbsp;{{$orderss->billing_phone}}</td>
                  </tr>
                </tbody>
              </table>
              <select class="form-control form-control-sm name" name="status[]">
                <option value="4" >Waiting Return</option>
                <option value="5" >Success</option>
              </select>
          </div>
          <br><hr style="border-top: 2px solid #eee;">
            <input class="btn btn-danger float-right"type="submit" name="" value="update"><br>
        </div>
      </form>  
    </div>
  </div>
  <div class="col-lg-4 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="ordertitle">
            ORDER NUMBER : {{$orderss->id}}
        </div>
        <hr style="border-top: 2px solid #eee;">
        <div class="orderhead row">
          <div class="col-sm-12">
            <table>
              <tbody>
                <tr>
                  <td>ชื่อ : </td>
                  <td>&nbsp;&nbsp;{{$orderss->billing_name}}</td>
                </tr>
                <tr>
                  <td>ที่อยู่จัดส่ง : </td>
                  <td>&nbsp;&nbsp;{{$orderss->billing_address}}</td>
                </tr>
                <tr>
                  <td>เบอร์โทร : </td>
                  <td>&nbsp;&nbsp;{{$orderss->billing_phone}}</td>
                </tr>
              </tbody>
            </table>
            <hr style="border-top: 2px solid #eee;">
          </div>
          
          <div class="col-sm-12">
            <h5> Account</h5>
            <table>
              <tbody>
                <tr>
                  <td>Bank Name : </td>
                  <td>&nbsp;&nbsp;{{$orderss->bank_name}}</td>
                </tr>
                <tr>
                  <td>Account Name : </td>
                  <td>&nbsp;&nbsp;{{$orderss->account_name}}</td>
                </tr>
                <tr>
                  <td>Account No.</td>
                  <td>&nbsp;&nbsp;{{$orderss->account_no}} </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
  
<div class="row">
  <div class="col-lg-10 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">รายการสินค้า</h4>
      <table class="table">
              <thead>
                <tr>
                  <th style="text-align: center; vertical-align: middle;">ภาพ</th>
                  <th style="text-align: center; vertical-align: middle;">รหัสชุด</th>
                  <th style="text-align: center; vertical-align: middle;">ขนาดชุด</th>
                  <th style="text-align: center; vertical-align: middle;">status</th>
                </tr>
              </thead>
              <tbody>
                  {{csrf_field()}}
                @foreach($orderproduct as $key => $value)
                    <tr>
                        <td style="width:100px;">
                            <img src="{{url('/')}}/products/{{$value->product['image']}}" style="width: 100px; height:150px" class="rounded">
                        </td>
                        <td style="text-align: center; vertical-align: middle;"><a>{{$value->product['p_code']}}</a></td>
                        <td style="text-align: center; vertical-align: middle;"><a>{{$value->size}}</a><br></td>
                        <td  style="text-align: center; vertical-align: middle;"></td>
                    </tr>
                @endforeach
              </tbody>
      </table>
      </div>
    </div>
  </div>
</div>
  

@endsection
