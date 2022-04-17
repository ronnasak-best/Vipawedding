@extends('backend.layouts.master')
@section('content')
<div class="page-header">
  <div class="row">
    <h3 class="page-title col-sm-2">
      <span class="page-title-icon bg-gradient-primary text-white mr-2">
        <i class="mdi mdi-library-books"></i>
      </span></h3>
      <ol class="breadcrumb col-sm-10">
        <h2 class="breadcrumb-item"><a href="{{route('orders_re.index')}}">Return products</a></h2>
        <h2 class="breadcrumb-item active" aria-current="page">order details</h2>
      </ol>
  </div>
</div>
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <form class="" action="{{route('orders_re.update',$orders_re->id)}}" method="post" enctype="multipart/form-data">
      <input type="hidden" name="_method" value="PATCH"/>
      {{csrf_field()}}
    <div class="card-body">
      <div class="ordertitle">
          ORDER NUMBER : {{$orders_re->id}}
      </div>
      <hr style="border-top: 2px solid #eee;">
      <div class="orderhead row">
        <div class="col-sm-7">
          <h5> Shipping address :: {{$orders_re->delivery_op}}</h5> <br>
          <table>
            <tbody>
              <tr>
                <td>Name : </td>
                <td>&nbsp;&nbsp;{{$orders_re->billing_name}} {{$orders_re->billing_surname}}</td>
              </tr>
              <tr>
                <td>Address : </td>
                <td>&nbsp;&nbsp;{{$orders_re->billing_address}} ต.{{$orders_re->billing_sub_district}}	อ.{{$orders_re->billing_district}}</td>
              </tr>
              <tr>
                <td></td>
                <td>&nbsp;&nbsp;จ.{{$orders_re->billing_province}} {{$orders_re->billing_pincode}}</td>
              </tr>
              <tr>
                <td>Phone : </td>
                <td>&nbsp;&nbsp;{{$orders_re->billing_phone}}</td>
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
                <td>&nbsp;&nbsp;{{$orders_re->bank_name}}</td>
              </tr>
              <tr>
                <td>Account Name : </td>
                <td>&nbsp;&nbsp;{{$orders_re->account_name}}</td>
              </tr>
              <tr>
                <td>Account No.</td>
                <td>&nbsp;&nbsp;{{$orders_re->account_no}} </td>
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
            <th style="text-align: center; vertical-align: middle;">Uplode Slip</th>
            <th style="text-align: center; vertical-align: middle;">status</th>
            <th style="text-align: center; vertical-align: middle;">Late</th>
              <th style="text-align: center; vertical-align: middle;">Other</th>

          </tr>
        </thead>
        <tbody>
            {{csrf_field()}}
          @foreach($orderproduct as $key => $value)

              <tr>
                  <td style="width:100px;">
                      <img src="{{url('/')}}/products/{{$value->product['image']}}" style="width: 80px; height:100px" class="rounded">
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
                  <td style="text-align: center; vertical-align: middle; ">
                    @if($value->image==true)
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#returnModal" data-whatever="" data-img_r="{{$value->image}}">
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
                  </td>


                  <td  style="text-align: center; vertical-align: middle;">
                    @if($value->status==5)
                      Success
                    @else
                      <input type="hidden" name="id[]" value="{{$value->id}}">
                      <select class="form-control form-control-sm name" name="status[]">
                          <option value="4" {{($value->status==4)?' selected':''}}>Waiting Return</option>
                          <option value="5" {{($value->status==5)?' selected':''}}>Success</option>
                      </select>
                    @endif


                  </td>
                  <td  style="text-align: center; vertical-align: middle;">
                  @if($value->status==5)
                    {{$value->late}}
                  @else
                    <select class="form-control form-control-sm num" name="late[]">

                    </select>
                  </td>
                  @endif
                  <td style="text-align: center; vertical-align: middle;">
                    @if($value->status==5)
                    {{$value->other_fine}}
                    @else
                    <input type="text" id="other_fine" class="form-control sm" name="other_fine[]"  size="5" value="" placeholder="฿">

                  </td>
                  @endif
                  <td style="text-align: center; vertical-align: middle;">
                    @if($value->status==5)
                    {{$value->fine_detail}}
                    @else
                    <textarea type="text" class="form-control" name="fine_detail[]" value="" rows="4"> </textarea>
                    @endif
                  </td>
              </tr>
          @endforeach
        </tbody>
      </table>
        <input class="btn btn-danger float-right"type="submit" name="" value="update" ><br>
    </div>
    </form>
  </div>
</div>
<script>
$(function(){
    var $select = $(".num");
    for (i=0;i<=31;i++){
        $select.append($('<option></option>').val(i).html(i))
    }
})
</script>

@endsection
