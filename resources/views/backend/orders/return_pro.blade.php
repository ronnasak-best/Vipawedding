@extends('backend.layouts.master')
@section('content')
<div class="page-header">
  <h3 class="page-title">
    <span class="page-title-icon bg-gradient-primary text-white mr-2">
      <i class="mdi mdi-library-books"></i>
    </span> Return Products </h3>
    <nav aria-label="breadcrumb">
        </nav>
</div>
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <table class="table "id="dynamic-row">
        <thead>
          <tr>
            <th style="text-align: center; vertical-align: middle;">Order</th>
            <th style="text-align: center; vertical-align: middle;">Date</th>
            <th style="text-align: center; vertical-align: middle;">Total</th>
            <th style="text-align: center; vertical-align: middle;">deposit</th>
            <th style="text-align: center; vertical-align: middle;">Refund</th>
            <th style="text-align: center; vertical-align: middle;">Delivery op</th>
            <th style="text-align: center; vertical-align: middle;">Status</th>
          </tr>
        </thead>
        <tbody>
          @foreach($orders as $order)
          <tr>
              <td style="text-align: center; vertical-align: middle;" > <a href="{{action('ReturnProductsController@show',$order['id'])}}">{{$order['id']}}</a> </td>
              <td style="text-align: center; vertical-align: middle;">{{$order['created_at']}}</td>
              <td style="text-align: center; vertical-align: middle;"> {{$order['billing_total']}} ฿</td>
              <td style="text-align: center; vertical-align: middle;"> {{$order['billing_deposit']}} ฿</td>
              <td style="text-align: center; vertical-align: middle;"> {{$order['billing_refund']}} ฿</td>
              <td style="text-align: center; vertical-align: middle;">{{$order['delivery_op']}}</td>
              <td style="text-align: center; vertical-align: middle;">
                @if($order['status']==1)
                  pending
                @elseif($order['status']==2)
                  Success
                @endif
              </td>

          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
<script >
    $('.cancel-confirm').on('click', function (event) {
        event.preventDefault();
        const url = $(this).attr('href');
        swal({
          title: "Are you sure?",
          text: "Your will cancel order :: {{$order['id']}}",
          buttons: true,
          dangerMode: true,
        }).then(function(value) {
            if (value) {
                swal("Poof! Your imaginary file has been deleted!", {
                icon: "success",
                });
                window.location.href = url;
            } else {
              swal("Your imaginary file is safe!");
            }
        });
      });
</script>
@endsection
