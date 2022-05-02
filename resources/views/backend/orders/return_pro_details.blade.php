@extends('backend.layouts.master')
@section('content')
    <div class="page-header">
        <div class="row">
            <h3 class="page-title col-sm-3">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                    <i class="mdi mdi-library-books"></i>
                </span>
            </h3>
            <ol class="breadcrumb col-sm-9">
                <h2 class="breadcrumb-item"><a href="{{ route('orders_re.index') }}">Orders</a></h2>
                <h2 class="breadcrumb-item active" aria-current="page">order details</h2>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="ordertitle">
                        หมายเลขการเช่า : {{ $orders_re->id }}
                    </div>
                    <hr style="border-top: 2px solid #eee;">
                    <div class="orderhead">
                        <div class="row mb-4">
                            <div class="col-sm-5">
                                <table>
                                    <tbody>
                                        <tr class="mb-2">
                                            <td>วันที่เช่า : </td>
                                            <td>&nbsp;&nbsp;{{ $orders_re->startDate }}</td>
                                        </tr>
                                        <tr>
                                            <td>วันที่คืน : </td>
                                            <td>&nbsp;&nbsp;{{ $orders_re->endDate }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-sm-6">
                                <table>
                                    <tbody>
                                        <tr class="mb-2">
                                            <td>ค่าเช่า : </td>
                                            <td>&nbsp;&nbsp;฿ {{ $orders_re->billing_subtotal }}</td>
                                        </tr>
                                        @if ($orders_re['status'] == 7 || $orders_re['status'] == 8)
                                            <tr>
                                                <td style="color: #ff0000;font-size: 18px;">เงินคืนค่ามัดจำ(หักค่าปรับ) :
                                                </td>
                                                <td style="color: #ff0000;font-size: 18px;">&nbsp;&nbsp;฿
                                                    {{ $orders_re->billing_refund }}</td>
                                            </tr>
                                            <tr>
                                                <td>จำนวนเกินกำหนด(฿100/วัน) : </td>
                                                <td>&nbsp;&nbsp; {{ $orders_re->late }} วัน</td>
                                            </tr>
                                            <tr>
                                                <td>ค่าปรับชุดชำรุด : </td>
                                                <td>&nbsp;&nbsp; ฿ {{ $orders_re->other_fine }}</td>
                                            </tr>
                                        @elseif($orders_re['status'] == 6)
                                            <tr>
                                                <td style="color: #ff0000;font-size: 18px;">เงินค่ามัดจำ : </td>
                                                <td style="color: #ff0000;font-size: 18px;">&nbsp;&nbsp;฿
                                                    {{ $orders_re->billing_deposit }}</td>
                                            </tr>
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="status">
                            <div style="align-items: center;" class=" row mb-4">
                                <label class="ml-4 mb-0">สถานะ :</label>
                                <div class="ml-4 col-sm-4">
                                    @if ($orders_re['status'] == 5)
                                        <span class="btn btn-rounded btn-sm"
                                            style="color: #ffffff; background-color: #dc3545;">รอการส่งคืน</span>
                                    @elseif($orders_re['status'] == 6)
                                        <span class="btn btn-rounded btn-sm"
                                            style="color: #212529; background-color: #ffc107;">รอตรวจสอบชุด</span>
                                    @elseif($orders_re['status'] == 7)
                                        <span class="btn btn-rounded btn-sm"
                                            style="color: #ffffff; background-color: #17a2b8;">รอคืนเงิน</span>
                                    @elseif($orders_re['status'] == 8)
                                        <span class="btn btn-rounded btn-sm"
                                            style="color: #ffffff; background-color: #28a745;">เสร็จสิ้น</span>
                                    @endif
                                </div>
                                @if ($orders_re['image_return_slip'] == true && $orders_re['status'] == 6)
                                    <div class="col-sm-5">
                                        <button type="button" class="btn btn-outline-info btn-fw " data-toggle="modal"
                                            data-target="#ShowreturnModal" data-whatever="{{ $orders_re['id'] }}">
                                            หลักฐานการจัดส่ง
                                        </button>
                                    </div>
                                @elseif ($orders_re['status'] == 7)
                                    <div class="col-sm-5">
                                        <a href="{{ route('orders_re.succeed', $orders_re['id']) }}"
                                            class="btn btn-outline-info btn-fw confirm_success ">
                                            ยืนยันการโอนเงินคืน
                                        </a>
                                    </div>
                                @endif

                            </div>
                            @if ($orders_re['image_return_slip'] == true && $orders_re['status'] == 6)
                                <div class="payment_confirm row">
                                    <form action="{{ route('orders_re.update', $orders_re['id']) }}" method="post">
                                        {{ method_field('PATCH') }}
                                        @csrf
                                        <!-- Modal -->
                                        <div class="modal fade bd-example-modal-lg" id="ShowreturnModal" tabindex="-1"
                                            role="dialog" aria-labelledby="ShowModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h6 class="modal-title" id="ShowModalLabel"></h6>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img class="img" style="width:50%; height: 50%;"
                                                            src="{{ url('/') }}/slipShipping/{{ $orders_re['image_return_slip'] }}"
                                                            alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- END Modal -->
                                </div> <!-- payment_confirm -->
                                <div class="form-group row mt-2">
                                    <label class="ml-2 col-sm-3 col-form-label">จำนวนวันคืนล่าช้า :</label>
                                    <div class="col-sm-2 pl-0">
                                        <select class="form-control" name="late">
                                            @for ($i = 0; $i <= 31; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label class="ml-2 col-sm-3 col-form-label">ค่าปรับชุดชำรุด:</label>
                                    <input type="number" class="form-control col-sm-5" name="other_fine">
                                </div>
                                <div class=" row justify-content-end">
                                    <button style="color: #28a745;border-color: #28a745;font-size:18px" type="submit"
                                        class=" mr-5 btn btn-sm btn-icon-text">
                                        <i class="mdi mdi-check-circle mdi-20px btn-icon-prepend"></i> ยืนยัน </button>
                                </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="ordertitle">
                        รายละเอือดการจัดส่ง
                    </div>
                    <hr style="border-top: 2px solid #eee;">
                    <div class="orderhead row">
                        <div class="col-sm-12">
                            <table>
                                <tbody>
                                    <tr>
                                        <td>ชื่อ : </td>
                                        <td>&nbsp;&nbsp;{{ $orders_re->billing_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>ที่อยู่จัดส่ง : </td>
                                        <td>&nbsp;&nbsp;{{ $orders_re->billing_address }}</td>
                                    </tr>
                                    <tr>
                                        <td>เบอร์โทร : </td>
                                        <td>&nbsp;&nbsp;{{ $orders_re->billing_phone }}</td>
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
                                        <td>ธนาคาร : </td>
                                        <td>&nbsp;&nbsp;{{ $orders_re->bank_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>ชื่อบัญชี : </td>
                                        <td>&nbsp;&nbsp;{{ $orders_re->account_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>เลขที่บัญชี.</td>
                                        <td>&nbsp;&nbsp;{{ $orders_re->account_no }} </td>
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
                                <th style="text-align: center; vertical-align: middle;">รายละเอียดชุดชำรุด</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderproduct as $key => $value)
                                <tr>
                                    <td style="width:100px;">
                                        <img src="{{ url('/') }}/products/{{ $value->product['image'] }}"
                                            style="width: 100px; height:150px" class="rounded">
                                    </td>
                                    <td style="text-align: center; vertical-align: middle;">
                                        <a>{{ $value->product['p_code'] }}</a>
                                    </td>
                                    <td style="text-align: center; vertical-align: middle;"><a>{{ $value->size }}</a><br>
                                    </td>
                                    <td style="text-align: center; vertical-align: middle;">
                                        <textarea class="form-control" id="detail_fine" rows="4"></textarea>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
