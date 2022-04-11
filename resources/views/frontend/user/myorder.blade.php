@extends('frontend.layouts.master')
@section('title','List Categories')
@section('content')
<div class="container">
<div class="ordertitle">
    ORDER NUMBER : {{$order->id}}
</div>
<hr style="border-top: 2px solid #eee;">
<div class=" row">
  <div class=" orderhead col-sm-7">
    <h5> Shipping address :: {{$order->delivery_op}}</h5> <br>
    <table>
      <tbody>
        <tr>
          <td>Name : </td>
          <td>&nbsp;&nbsp;{{$order->billing_name}} {{$order->billing_surname}}</td>
        </tr>
        <tr>
          <td>Address : </td>
          <td>&nbsp;&nbsp;{{$order->billing_address}} ต.{{$order->billing_sub_district}}	อ.{{$order->billing_district}}</td>
        </tr>
        <tr>
          <td></td>
          <td>&nbsp;&nbsp;จ.{{$order->billing_province}} {{$order->billing_pincode}}</td>
        </tr>
        <tr>
          <td>Phone : </td>
          <td>&nbsp;&nbsp;{{$order->billing_phone}}</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class=" orderhead col-sm-5">
    <h5> Account</h5> <br>
    <table>
      <tbody>
        <tr>
          <td>Bank Name : </td>
          <td>&nbsp;&nbsp;{{$order->bank_name}}</td>
        </tr>
        <tr>
          <td>Account Name : </td>
          <td>&nbsp;&nbsp;{{$order->account_name}}</td>
        </tr>
        <tr>
          <td>Account No.</td>
          <td>&nbsp;&nbsp;{{$order->account_no}} </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
<br><hr style="border-top: 2px solid #eee;">
        <table class="table table-bordered tablecart" >
         	<thead class="thead-primary">
             	<tr>
                  <th>&nbsp;</th>
                  <th style="text-align: center; vertical-align: middle;">Product</th>
                 	<th style="text-align: center; vertical-align: middle; ">start date</th>
                 	<th style="text-align: center; vertical-align: middle;">return date</th>
                  <th style="text-align: center; vertical-align: middle;">status</th>
                  <th style="text-align: center; vertical-align: middle;">แจ้งคืนสินค้า</th>
             	</tr>
         	</thead>

         	<tbody >
         		@foreach($orderproduct as $key => $value)
             		<tr>
                 		<td style="width:100px;">
                        <img src="{{url('/')}}/products/{{$value->product['image']}}" style="width: 100px; height:110px" class="rounded">
                    </td>
                    <td>
                      <div class="product-detail" style="text-align: left;">
                        <h5>{{$value->product['p_name']}}</h5>
                        <a>SIZE : {{$value->size}}</a><br>
                      </div>
                    </td>
                 		<td style="text-align: center; vertical-align: middle; ">{{$value->startDate}}</td>
                 		<td style="text-align: center; vertical-align: middle;">{{$value->endDate}}</td>
                    <td style="text-align: center; vertical-align: middle;">
                      @if($value->tracking_no == false)
                          @if($value->status == 1)
                            Waiting payment
                          @elseif($value->status == 2)
                            Confirm Order
                          @elseif($value->status == 3)
                            Shipping
                          @elseif($value->status == 4)
                            Waiting Return
                          @else
                            Cancel
                          @endif
                      @else
                          {{$value->tracking_no}}
                      @endif
                  </td>
                  <td style="text-align: center; vertical-align: middle;">
                    @if($value->status==0)
                      Cancel
                    @elseif($value->tracking_no == true)
                        @if($value->image == false)
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#UploadModal" data-whatever="">
                            Upload
                        </button>
                        <!-- Modal -->
                        <div class="modal fade bd-example-modal-lg" id="UploadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h6 class="modal-title" id="UploadModalLabel"></h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form  method="post" action="{{ url('/order_return')}}" enctype="multipart/form-data">
                                  {{csrf_field()}}

                                  <input type="hidden" name="id" value="{{$value->id}}">
                                  <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Add file:</label>
                                    <div class="">
                                      <input type="file" name="image" class="form-control">
                                    </div>
                                    <button type="submit" class="btn btn-primary sm-8">upload</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        @else
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#returnModal" data-whatever="" data-img_r="{{$value->image}}">
                            View file
                        </button>
                        <!-- Modal -->
                        <div class="modal fade bd-example-modal-lg" id="returnModal" tabindex="-1" role="dialog" aria-labelledby="returnModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h6 class="modal-title" id="returnModalLabel"></h6>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body img">
                                <img src="" style="width: 80%; height:80%"  alt="" >
                              </div>
                            </div>
                          </div>
                        </div>
                        @endif
                      @endif
                </td>
             		</tr>
      	   	@endforeach

         	</tbody>
        </table>
</dive>
@endsection
