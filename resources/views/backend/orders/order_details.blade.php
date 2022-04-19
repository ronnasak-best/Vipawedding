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
                <h2 class="breadcrumb-item"><a href="{{ route('orderss.index') }}">Orders</a></h2>
                <h2 class="breadcrumb-item active" aria-current="page">order details</h2>
            </ol>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="ordertitle">
                        หมายเลขการเช่า : {{ $orderss->id }}
                    </div>
                    <hr style="border-top: 2px solid #eee;">
                    <div class="orderhead">
                        <div class="row mb-4">
                            <div class="col-sm-6">
                                <table>
                                    <tbody>
                                        <tr class="mb-2">
                                            <td>วันที่เช่า : </td>
                                            <td>&nbsp;&nbsp;{{ $orderss->startDate }}</td>
                                        </tr>
                                        <tr>
                                            <td>วันที่คืน : </td>
                                            <td>&nbsp;&nbsp;{{ $orderss->endDate }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="status">
                            <div style="align-items: center;" class=" row mb-4">
                                <label class="ml-4 mb-0">สถานะ :</label>
                                <div class="ml-4">
                                    @if ($orderss->status == 0)
                                    <span class="btn btn-rounded btn-sm"
                                            style="color: #ffffff; background-color: #6c757d;">ยกเลิก</span>
                                    @elseif ($orderss->status == 1)
                                        <span class="btn btn-rounded btn-sm"
                                            style="color: #212529; background-color: #ffc107;">รอชำระเงิน</span>
                                    @elseif($orderss->status == 2)
                                        <span class="btn btn-rounded btn-sm"
                                            style="color: #ffffff; background-color: #ff854a;">รอเช็คยอด</span>
                                    @elseif($orderss->status == 3)
                                        <span class="btn btn-rounded btn-sm"
                                            style="color: #ffffff; background-color: #17a2b8;">รอจัดส่ง</span>
                                    @elseif($orderss->status == 4)
                                        <span class="btn btn-rounded btn-sm"
                                            style="color: #ffffff; background-color: #28a745;">จัดส่งแล้ว</span>
                                    @elseif($orderss->status == 5)
                                        <span class="btn btn-rounded btn-sm"
                                            style="color: #ffffff; background-color: #963859;">รอการส่งคืน</span>
                                    @endif
                                </div>
                            </div>
                            <div class="payment_confirm row">
                                @if ($orderss['payment_slip'] == true && $orderss['status'] == 2)
                                    <button type="button" class="btn btn-outline-info btn-fw col-sm-5 ml-4"
                                        data-toggle="modal" data-target="#ShowModal" data-whatever="{{ $orderss['id'] }}">
                                        หลักฐานการโอนเงิน
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade bd-example-modal-lg" id="ShowModal" tabindex="-1" role="dialog"
                                        aria-labelledby="ShowModalLabel" aria-hidden="true">
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
                                                    <img class="img"
                                                        src="{{ url('/') }}/slip/{{ $orderss['payment_slip'] }}"
                                                        alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="payment_confirm/{{ $orderss['id'] }}"
                                        style="color: #28a745;border-color: #28a745;font-size:18px" type="button"
                                        class=" ml-5 btn btn-sm btn-icon-text">
                                        <i class="mdi mdi-check-circle mdi-20px btn-icon-prepend"></i> ยืนยัน </a>
                                    <a href="cancel/{{ $orderss['id'] }}"
                                        style="color: #dc3545;border-color: #dc3545;font-size:18px" type="button"
                                        class=" ml-2 btn btn-sm btn-icon-text">
                                        <i class="mdi mdi-close-box mdi-20px btn-icon-prepend"></i> ปฏิเสธ </a>
                                @endif
                            </div>
                            @if ($orderss['status'] == 3)
                                <form action="{{ route('orderss.ship_track', $orderss['id']) }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group row mt-3">
                                        <label class="ml-2 col-sm-2 col-form-label">เลขพัสดุ :</label>
                                        <input type="text" class="form-control col-sm-5" name="tracking_no_send">
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-sm-3">
                                            <button style="color: #28a745;border-color: #28a745;font-size:18px"
                                                type="submit" class="btn btn-sm btn-icon-text">
                                                <i class="mdi mdi-check-circle mdi-20px btn-icon-prepend"></i> ยืนยัน
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            @endif
                            @if ($orderss['status'] == 4)
                                <div class="form-group row mt-2">
                                    <label class="ml-2 col-sm-2 col-form-label">เลขพัสดุ :</label>
                                    <input type="text" class="form-control col-sm-5" name="tracking_no_send"
                                        value="{{ $orderss['tracking_no_send'] }}" disabled>
                                </div>
                                <a href="order_back/{{ $orderss['id'] }}"
                                    style="color: #28a745;border-color: #28a745;font-size:18px" type="button"
                                    class=" ml-2 btn btn-sm btn-icon-text">
                                    <i class="mdi mdi-close-box mdi-20px btn-icon-prepend"></i> สินค้าจัดส่งสำเร็จ
                                    รอการส่งกลับ </a>
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
                        ORDER NUMBER : {{ $orderss->id }}
                    </div>
                    <hr style="border-top: 2px solid #eee;">
                    <div class="orderhead row">
                        <div class="col-sm-12">
                            <table>
                                <tbody>
                                    <tr>
                                        <td>ชื่อ : </td>
                                        <td>&nbsp;&nbsp;{{ $orderss->billing_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>ที่อยู่จัดส่ง : </td>
                                        <td>&nbsp;&nbsp;{{ $orderss->billing_address }}</td>
                                    </tr>
                                    <tr>
                                        <td>เบอร์โทร : </td>
                                        <td>&nbsp;&nbsp;{{ $orderss->billing_phone }}</td>
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
                                        <td>&nbsp;&nbsp;{{ $orderss->bank_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Account Name : </td>
                                        <td>&nbsp;&nbsp;{{ $orderss->account_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Account No.</td>
                                        <td>&nbsp;&nbsp;{{ $orderss->account_no }} </td>
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
                            {{ csrf_field() }}
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
                                    <td style="text-align: center; vertical-align: middle;"></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
