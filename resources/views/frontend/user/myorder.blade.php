@extends('frontend.user.user_layout.order_layout')
@section('title', 'List Categories')
@section('order-manage')
    <div class="card">
        <div class="card-order-header" style="background: #FAFAFA">
            <div class="order-header">
                <spam class="title-text">รายการเช่า <a href="">#{{ $order['id'] }}</a>
                </spam>
            </div>
            <div style="width: 300px;">
                @if ($order['payment_slip'] == false && $order['status'] == 1)
                    <div class="button-attached">
                        <button type="button" class="btn btn-primary button primary btn-block " data-toggle="modal"
                            data-target="#UploadModal" data-whatever="{{ $order['id'] }}">แนบหลักฐานการโอนเงิน</button>
                        <a class="btn btn-danger order-cancel" href="{{ route('orders.destroy', $order['id']) }}"
                            class="btn btn-danger">ยกเลิก</a>
                    </div>
                @elseif($order['status'] == 2)
                    <div class="button-attached">
                        <button type="button" class="btn btn-outline-secondary button primary btn-block " data-toggle="modal"
                            data-target="#ShowModal" data-whatever="{{ $order['id'] }}"
                            data-img="{{ $order->payment_slip }}">หลักฐานการโอนเงิน</button>
                    </div>
                @elseif($order['status'] == 5)
                    <div class="button-attached">
                        <button type="button" class="btn btn-danger button danger btn-block" data-toggle="modal"
                            data-target="#returnModal" data-whatever="{{ $order['id'] }}">แนบหลักฐานการจัดส่งคืน</button>
                    </div>
                @elseif($order['status'] == 6)
                    <div class="button-attached">
                        <button type="button" class="btn btn-outline-secondary button primary btn-block "
                            data-toggle="modal" data-target="#ShowReturnModal" data-whatever="{{ $order['id'] }}"
                            data-img_r="{{ $order->image_return_slip }}">หลักฐานการจัดส่งคืน</button>
                    </div>
                {{-- @elseif ($order['status'] == 8)
                    <div class="button-attached">
                        <a href="{{route('receipt.show',$order['id'])}}" type="button" class="btn btn-outline-secondary button primary btn-block">PDF</a>
                    </div> --}}
                @endif
            </div>
        </div>
        <div class="card-order-header" style="background: #f3f3f3">
            <div class="order-header">
                <spam class="title-text_detail">สถานะ
                    @if ($order['status'] == 0)
                        <span class="btn btn-rounded btn-sm"
                            style="color: #ffffff; background-color: #6c757d;">ยกเลิก</span>
                    @elseif ($order['status'] == 1 || $order['status'] == 2)
                        <span class="btn btn-rounded btn-sm"
                            style="color: #212529; background-color: #ffc107;">รอชำระเงิน</span>
                    @elseif($order['status'] == 3)
                        <span class="btn btn-rounded btn-sm"
                            style="color: #ffffff; background-color: #17a2b8;">รอจัดส่ง</span>
                    @elseif($order['status'] == 4)
                        <span class="btn btn-rounded btn-sm"
                            style="color: #ffffff; background-color: #28a745;">จัดส่งแล้ว</span>
                    @elseif($order['status'] == 5)
                        <span class="btn btn-rounded btn-sm"
                            style="color: #ffffff; background-color: #963859;">รอการส่งคืน</span>
                    @elseif($order['status'] == 6)
                        <span class="btn btn-rounded btn-sm"
                            style="color: #212529; background-color: #ffc107;">รอตรวจสอบชุด</span>
                    @elseif($order['status'] == 7)
                        <span class="btn btn-rounded btn-sm"
                            style="color: #ffffff; background-color: #17a2b8;">รอคืนเงิน</span>
                    @elseif($order['status'] == 8)
                        <span class="btn btn-rounded btn-sm"
                            style="color: #ffffff; background-color: #28a745;">เสร็จสิ้น</span>
                    @endif
                </spam>
            </div>
            <div class="order-header">
                <spam class="title-text_detail">การจัดส่ง {{ $order['tracking_no_send'] }}</spam>
            </div>
        </div>
        <div class="card-order-header">
            <div>
                <div class="text-858585">วันที่เช่า</div>
                <did class="text-black font-weight-bold">{{ $order['startDate'] }}</did>
                <div class="text-858585 mt-2">วันที่คืนชุด</div>
                <div class="text-black font-weight-bold">{{ $order['endDate'] }}</div>
            </div>
            <div class="mr-4 adadress_order_detail">
                <div class="adadress"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                        height="24">
                        <path d="M12 13.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z"></path>
                        <path fill-rule="evenodd"
                            d="M19.071 3.429C15.166-.476 8.834-.476 4.93 3.429c-3.905 3.905-3.905 10.237 0 14.142l.028.028 5.375 5.375a2.359 2.359 0 003.336 0l5.403-5.403c3.905-3.905 3.905-10.237 0-14.142zM5.99 4.489A8.5 8.5 0 0118.01 16.51l-5.403 5.404a.859.859 0 01-1.214 0l-5.378-5.378-.002-.002-.023-.024a8.5 8.5 0 010-12.02z">
                        </path>
                    </svg> ที่อยู่จัดส่งสินค้า</div>
                <div class="ml-4 mt-2 ">
                    <div class="address_head">{{ $order['billing_name'] }}</div>
                    <div class="address_head">{{ $order['billing_phone'] }}</div>
                    <div class="address-text">{{ $order['billing_address'] }}</div>

                </div>
            </div>


        </div>
        @if($order['status'] == 8)
        <div class="card-order-header">
            <div>
               รายละเอียดค่าปรับ
                <table>
                    <tbody>
                        <tr>
                            <td style="color: #ff0000;font-size: 18px;">เงินคืนค่ามัดจำ(หักค่าปรับ) :
                            </td>
                            <td style="color: #ff0000;font-size: 18px;">&nbsp;&nbsp;฿
                                {{ $order->billing_refund }}</td>
                        </tr>
                        <tr>
                            <td>จำนวนเกินกำหนด(฿100/วัน) : </td>
                            <td>&nbsp;&nbsp; {{ $order->late }} วัน</td>
                        </tr>
                        <tr>
                            <td>ค่าปรับชุดชำรุด : </td>
                            <td>&nbsp;&nbsp; ฿ {{ $order->other_fine }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="mr-4">
                <div class="adadress"><svg style="width:24px;height:24px" viewBox="0 0 24 24">
                    <path fill="currentColor" d="M11.5,1L2,6V8H21V6M16,10V17H19V10M2,22H21V19H2M10,10V17H13V10M4,10V17H7V10H4Z" />
                </svg> บัญชีคืนเงินค่ามัดจำ</div>

               <div class="ml-4 mt-2">
                <table>
                    <tbody>
                        <tr>
                            <td class="address_head">ธนาคาร : </td>
                            <td class="address-text">&nbsp;&nbsp;{{ $order->bank_name }}</td>
                        </tr>
                        <tr>
                            <td class="address_head">ชื่อบัญชี : </td>
                            <td class="address-text">&nbsp;&nbsp;{{ $order->account_name }}</td>
                        </tr>
                        <tr>
                            <td class="address_head">เลขที่บัญชี</td>
                            <td class="address-text">&nbsp;&nbsp;{{ $order->account_no }} </td>
                        </tr>
                    </tbody>
                </table>
               </div>
            </div>
        </div>
        @endif
    </div>
    <div class="card mt-3">
        <div class="card-body" id="card_order_detail">
            @foreach ($order->ordersproduct as $ordersproduct)
                <div class="d-flex-between" style=" padding: 15px;">
                    <div class="d-flex-between">
                        <img src="{{ url('/') }}/products/{{ $ordersproduct->product['image'] }}"
                            style="width: 100px; height:110px" class="rounded">
                        <div class="p-3  item-detail" style="width: 400px;">
                            <div class="font-weight-bold">{{ $ordersproduct->product['p_name'] }}</div>
                            <div style="font-size: 14px;" class="order-item-sub text-858585">
                                {{ $ordersproduct->product['p_code'] }}</div>
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

@endsection
