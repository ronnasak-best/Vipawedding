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
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <form class="" action="{{ route('orderss.store')}}" method="post">
    <div class="card-body">
      <div class="ordertitle">
          ORDER NUMBER : {{$orderss->id}}
      </div>
      <hr style="border-top: 2px solid #eee;">
      <div class="orderhead row">
        <div class="col-sm-7">
          <h5> Shipping address :: {{$orderss->delivery_op}}</h5> <br>
          <table>
            <tbody>
              <tr>
                <td>Name : </td>
                <td>&nbsp;&nbsp;{{$orderss->billing_name}} {{$orderss->billing_surname}}</td>
              </tr>
              <tr>
                <td>Address : </td>
                <td>&nbsp;&nbsp;{{$orderss->billing_address}} ต.{{$orderss->billing_sub_district}}	อ.{{$orderss->billing_district}}</td>
              </tr>
              <tr>
                <td></td>
                <td>&nbsp;&nbsp;จ.{{$orderss->billing_province}} {{$orderss->billing_pincode}}</td>
              </tr>
              <tr>
                <td>Phone : </td>
                <td>&nbsp;&nbsp;{{$orderss->billing_phone}}</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-sm-5">
          <h5> Account</h5> <br>
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
      <br><hr style="border-top: 2px solid #eee;">
      <table class="table">
        <thead>
          <tr>
            <th style="text-align: center; vertical-align: middle;">Order</th>
            <th style="text-align: center; vertical-align: middle;">details</th>
            <th style="text-align: center; vertical-align: middle;">tracking number</th>
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
                  <td>
                    <div class="product-detail" style="text-align: left;">
                      <spam>{{$value->product['p_name']}}</spam><br>
                        <a>CODE : {{$value->product['p_code']}}</a><br>
                      <a>SIZE : {{$value->size}}</a><br>
                      <a>FROM : {{$value->startDate}}</a><br>
                      <a>TO : {{$value->endDate}}</a>
                    </div>

                  </td>

                  <td style="text-align: center; vertical-align: middle;">
                    @if($value->status == 4)
                    {{$value->tracking_no}}
                    @else
                      <input type="hidden" name="id[]" value="{{$value->id}}">
                    <input  class="form-control" type="text" name="tracking_no[]" value="{{$value->tracking_no}}">

                    @endif
                  </td>

                  <td  style="text-align: center; vertical-align: middle;">
                    @if($value->status == 4)
                    Waiting return
                    @else
                    <select class="form-control form-control-sm name" name="status[]">
                        <option value="1" {{($value->status==1)?' selected':''}}>Waiting Payment</option>
                        <option value="2" {{($value->status==2)?' selected':''}}>Confirm Order</option>
                        <option value="3" {{($value->status==3)?' selected':''}}>Shipping</option>
                    </select>

                    @endif
                  </td>
              </tr>
          @endforeach
        </tbody>
      </table>
        <input class="btn btn-danger float-right"type="submit" name="" value="update"><br>
    </div>
    </form>
  </div>
</div>

@endsection
