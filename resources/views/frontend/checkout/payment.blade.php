@extends('frontend.layouts.master')
@section('title','List Categories')
@section('content')
<!--#f1cce0-->
<div class="row ">
    <div class="col-md-7 col-pad-0">
      <form class="" action="{{ route('check-out.store') }}" method="post">
        {{csrf_field()}}
        
          <div class="card" >
          <div class="card-header" >
            Featured
          </div>
          <div class=" pl-4 pr-4">
            <hr style="border-top: 1px solid #eee;">
            <h6>Shipping Address</h6>
            <hr style="border-top: 1px solid #eee;">
            <div class="table">
                <p>Name : {{$addr->name}} {{$addr->surname}}</p>
                <p>Address : {{$addr->address}} | {{$addr->sub_district}},{{$addr->district}},{{$addr->province}},{{$addr->pincode}}</p>
                <p>Mobile : {{$addr->mobile}}</p>
            </div>
            <input type="hidden" name="address_id" value="{{$addr->id}}">
          </div>

          <hr style="border-top: 2px solid #eee;">
          <div class="card-body">
            <div class="row mb-2">
              <div class=" row col-6">
                <div class="row_box">
                    <input type="radio" class="bank" name="bank" value="ktb">
                </div>
                <div class="row_box">
                  <img style="border-radius: 30%;"src="{{ asset('/images/ktb.jpg') }}" width="140" height="140"alt=""><br>
                  <label style="padding-top:15px">Krung Thai Bank</label>
                </div>

              </div>
              <div class=" row col-6">
                <div class="row_box">
                    <input type="radio" class="bank" name="bank" value="scb">
                </div>
                <div class="row_box">
                  <img style=" border-radius: 30%;" src="{{ asset('/images/scb.jpg') }}" width="140" height="140"alt=""><br>
                  <label style="padding-top:15px">Siam Commercial Bank</label>
                </div>
              </div>
            </div>
            <div class="ktb box" style="display: none";>
              <hr style="border-top: 2px solid #eee;">
                <h3>548-385739-2 <br>
 นางสาว ไพลิน เวียงสงค์
</h3>
            </div>
            <div class="scb box" style="display: none";>
              <hr style="border-top: 2px solid #eee;">
                <h3> 453-672846-3 <br>
นางสาวไพลิน เวียงสงค์</h3>
            </div>
          </div>
          </div>
          <input class="float-right" type="submit" name="" value="confirm order">
          </form>
        </div>
    <div class="col-md-5">
        <div class="card sm-6">
        <div class="card-header"style="background-color:#f1cce0;">
          Ordering information
        </div>
        <div class="card-body ">
            <div>
              <table>
               	<thead>
                   	<tr>
                        <th></th>
                       	<th style="text-align: center; vertical-align: middle; "></th>
                   	</tr>
               	</thead>

               	<tbody >
               		@foreach(Cart::content() as $row)
                   		<tr >
                       		<td style="width:500px; padding-bottom:20px;">
                            <img src="{{url('/')}}/products/{{$row->options->image}}" style="width: 50px; height:75px" class="rounded">
                            <div class="product-detail">
                              <spam>{{$row->name}}</spam><br>
                              <a>SIZE : {{$row->options->size}}</a><br>
                              <a>FROM : {{$row->options->startDate}}</a><br>
                              <a>TO : {{$row->options->endDate}}</a>
                            </div>
                          </td>

                       		<td style="text-align: center; vertical-align: middle;">{{$row->total}}</td>
                   		</tr>
            	   	@endforeach

               	</tbody>
              </table>
            </div>
            <hr style="border-top: 2px solid #eee;">
            <div class="" >
              <table>
                <tbody >
                      <tr >
                          <td style="width:500px; padding-bottom:20px;">ราคาค่าเช่า</td>
                          <td style="text-align: center; vertical-align: middle;">{{Cart::Subtotal()}}฿</td>
                      </tr>

                </tbody>
              </table>
            </div><hr style="border-top: 2px solid #eee;">
            <div class="" >
              <table>
                <tbody >
                      <tr >
                          <td style="width:500px; padding-bottom:20px;">ค่ามัดจำ</td>
                          <td style="text-align: center; vertical-align: middle;">{{Cart::Subtotal()}}฿</td>
                      </tr>

                </tbody>
              </table>
            </div>
            <hr style="border-top: 2px solid #eee;">
            <div class="" >
              <table>
                <tbody >
                      <tr >
                          <td style="width:500px; padding-bottom:20px;">Total</td>
                          <td style="text-align: center; vertical-align: middle;">{{Cart::Subtotal() *2.00}}฿</td>
                      </tr>

                </tbody>
              </table>
            </div>
        </div>
      </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $('.bank').click(function(){
        var inputValue = $(this).attr("value");
        var targetBox = $("." + inputValue);
        $(".box").not(targetBox).hide();
        $(targetBox).show();
    });
    $(".address").click(function(){
      if ($(this).is(":checked")){
      $(".address_box").css({"background-color":"#f7f7f7"})
      && $(this).closest(".address_box").css({"background-color":"rgb(233, 233, 233)"});
      }
   });
});
</script>
@endsection
