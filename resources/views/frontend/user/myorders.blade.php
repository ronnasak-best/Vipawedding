@extends('frontend.user.user_layout.master')
@section('title','List Categories')
@section('user-manage')
@foreach($orders as $order)
<div class="card p-2 mb-4" id="card_order">
    <div class="card-order-header">
        <div class="order-header">
            <spam class="title-text">รายการเช่า <a
                    href="{{route('orders.show',$order['id'])}}">#{{$order['id']}}</a></spam>
        </div>
        <div>
            @if($order['status']==1)
            <span class="btn-status status-waiting"> รอการชำระเงิน</span>
            @else
            <span class="btn-status status-done"> อยู่ระหว่างดำเนินงาน</span>
            @endif
        </div>
    </div>
    <div class="card-order-header">
        <div>
            <div class="text-858585">วันที่เช่า</div>
            <did class="text-black font-weight-bold">{{$order['startDate']}}</did>
            <div class="text-858585 mt-2">วันที่คืนชุด</div>
            <div class="text-black font-weight-bold">{{$order['endDate']}}</div>
        </div>
        <div style="width: 300px;">
            <div class="d-flex-between">
                <div>
                    <div class="font-weight-bold">ยอดสุทธิ</div>
                    <div style="font-size: 12px;">(รวมภาษีมูลค่าเพิ่ม)</div>
                </div>
                <div>
                    <div class="font-weight-bold" style="color: #0066DD;font-size: 22px;">
                        ฿{{$order['billing_total']}}
                    </div>
                </div>
            </div>
            @if($order['status'] == 1)
            @if($order['image_payment_return'] == false)
            <div class="button-attached">
                <button type="button" class="btn btn-primary button primary btn-block mt-3" data-toggle="modal"
                    data-target="#UploadModal" data-whatever="{{$order['id']}}">แนบหลักฐานการโอนเงิน</button>
            </div>
            @else
            <div class="button-attached">
                <button type="button" class="btn btn-outline-secondary button primary btn-block mt-3"
                    data-toggle="modal" data-target="#ShowModal" data-whatever="{{$order['id']}}"
                    data-img="{{$order->image_payment_return}}">หลักฐานการโอนเงิน</button>
            </div>
            @endif
            @endif
        </div>
    </div>
    <div class="bg-white order-list">
        @foreach($order->ordersproduct as $ordersproduct)
        <div class="d-flex-between" style=" padding: 15px;">
            <div class="d-flex-between">
                <img src="{{url('/')}}/products/{{$ordersproduct->product['image']}}" style="width: 100px; height:110px"
                    class="rounded">
                <div class="p-3  item-detail" style="width: 400px;">
                    <div class="font-weight-bold">{{$ordersproduct->product['p_name']}}</div>
                    <div style="font-size: 14px;" class="order-item-sub text-858585">SIZE :
                        {{$ordersproduct->size}}</div>
                </div>
            </div>
            <div>
                <div class="font-weight-bold">฿{{$ordersproduct->product->price}}</div>
            </div>
        </div>

        @endforeach
    </div>
</div>
@endforeach

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="UploadModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="UploadModalLabel"></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('orders.update',$order['id'])}}"
                    enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="PATCH" />
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
<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="ShowModal" tabindex="-1" role="dialog" aria-labelledby="ShowModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="ShowModalLabel"></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="" style="width: 80%; height:80%" alt="">
            </div>
        </div>
    </div>
</div>
@endsection