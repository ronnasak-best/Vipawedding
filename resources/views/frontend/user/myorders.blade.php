@extends('frontend.user.user_layout.order_layout')
@section('title', 'List Categories')
@section('order-manage')
    @foreach ($orders as $order)
        <div class="card p-2 mb-4" id="card_order">
            <div class="card-order-header">
                <div class="order-header">
                    <spam class="title-text">รายการเช่า <a
                            href="{{ route('orders.show', $order['id']) }}">#{{ $order['id'] }}</a></spam>
                </div>
                <div>
                    @if ($order['status'] == 0)
                        <span class="btn-status" style="color: #ffffff; background-color: #6c757d;"> ยกเลิก</span>
                    @elseif ($order['status'] == 1 || $order['status'] == 2)
                        <span class="btn-status status-waiting"> รอการชำระเงิน</span>
                    @elseif ($order['status'] == 3 || $order['status'] == 4)
                        <span class="btn-status status-done"> อยู่ระหว่างการจัดส่ง</span>
                    @elseif ($order['status'] == 5)
                        <span class="btn-status status-return"> รอการส่งกลับ</span>
                    @elseif ($order['status'] == 6 || $order['status'] == 7)
                        <span class="btn-status status-waiting"> รอการตรวจสอบ</span>
                    @endif
                </div>
            </div>
            <div class="card-order-header">
                <div>
                    <div class="text-858585">วันที่เช่า</div>
                    <did class="text-black font-weight-bold">{{ $order['startDate'] }}</did>
                    <div class="text-858585 mt-2">วันที่คืนชุด</div>
                    <div class="text-black font-weight-bold">{{ $order['endDate'] }}</div>
                </div>
                <div style="width: 300px;">
                    <div class="d-flex-between">
                        <div>
                            <div class="font-weight-bold">ยอดสุทธิ</div>
                            <div style="font-size: 12px;">(รวมภาษีมูลค่าเพิ่ม)</div>
                        </div>
                        <div>
                            <div class="font-weight-bold" style="color: #0066DD;font-size: 22px;">
                                ฿{{ $order['billing_total'] }}
                            </div>
                        </div>
                    </div>

                    @if ($order['payment_slip'] == false && $order['status'] == 1)
                        <div class="button-attached">
                            <button type="button" class="btn btn-primary button primary btn-block mt-3" data-toggle="modal"
                                data-target="#UploadModal"
                                data-whatever="{{ $order['id'] }}">แนบหลักฐานการโอนเงิน</button>
                        </div>
                    @elseif($order['status'] == 2)
                        <div class="button-attached">
                            <button type="button" class="btn btn-outline-secondary button primary btn-block mt-3"
                                data-toggle="modal" data-target="#ShowModal" data-whatever="{{ $order['id'] }}"
                                data-img="{{ $order->payment_slip }}">หลักฐานการโอนเงิน</button>
                        </div>
                    @elseif($order['status'] == 5)
                        <div class="button-attached">
                            <button type="button" class="btn btn-danger button danger btn-block mt-3" data-toggle="modal"
                                data-target="#returnModal" data-whatever="{{ $order['id'] }}">แนบหลักฐานการจัดส่ง</button>
                        </div>
                    @elseif($order['status'] == 6)
                        <div class="button-attached">
                            <button type="button" class="btn btn-outline-secondary button primary btn-block mt-3"
                                data-toggle="modal" data-target="#ShowReturnModal" data-whatever="{{ $order['id'] }}"
                                data-img_r="{{ $order->image_return_slip }}">หลักฐานการจัดส่ง</button>
                        </div>
                    @endif
                </div>
            </div>
            <div class="bg-white order-list">
                @foreach ($order->ordersproduct as $ordersproduct)
                    <div class="d-flex-between" style=" padding: 15px;">
                        <div class="d-flex-between">
                            <img src="{{ url('/') }}/products/{{ $ordersproduct->product['image'] }}"
                                style="width: 100px; height:110px" class="rounded">
                            <div class="p-3  item-detail" style="width: 400px;">
                                <div class="font-weight-bold">{{ $ordersproduct->product['p_name'] }}</div>
                                <div style="font-size: 14px;" class="order-item-sub text-858585">SIZE :
                                    {{ $ordersproduct->size }}</div>
                            </div>
                        </div>
                        <div>
                            <div class="font-weight-bold">฿{{ $ordersproduct->product->price }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach

@endsection
