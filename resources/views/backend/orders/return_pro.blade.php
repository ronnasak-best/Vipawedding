@extends('backend.layouts.master')
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-library-books"></i>
            </span> ข้อมูลการคืน ||
            <a href="{{ route('orders_re.index') }}" class="btn btn-rounded btn-sm"
                style="color: #ffffff; background-color: #007bff;">ทั้งหมด</a>
            <a href="{{ route('orders_re.search', $status = 5) }}" class="btn btn-rounded btn-sm"
                style="color: #ffffff; background-color: #dc3545;">รอการส่งคืน</a>
            <a href="{{ route('orders_re.search', $status = 6) }}" class="btn btn-rounded btn-sm"
                style="color: #212529; background-color: #ffc107;">รอตรวจสอบชุด</a>
            <a href="{{ route('orders_re.search', $status = 7) }}" class="btn btn-rounded btn-sm"
                style="color: #ffffff; background-color: #17a2b8;">รอจัดส่ง</a>
            <a href="{{ route('orders_re.search', $status = 8) }}" class="btn btn-rounded btn-sm"
                style="color: #ffffff; background-color: #28a745;">เสร็จสิ้น</a>
        </h3>
        <nav aria-label="breadcrumb">
        </nav>
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <table class="table " id="dynamic-row">
                    <thead>
                        <tr>
                            <th style="text-align: center; vertical-align: middle;">สถานะ</th>
                            <th style="text-align: center; vertical-align: middle;">เลขที่</th>
                            <th style="text-align: center; vertical-align: middle;">วันที่สั่งเช่า</th>
                            <th style="text-align: center; vertical-align: middle;">จำนวนเงิน/บาท</th>
                            <th style="text-align: center; vertical-align: middle;">ค่ามัดจำ/บาท</th>
                            <th style="text-align: center; vertical-align: middle;">ใบเสร็จส่งของ</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td style="text-align: center; vertical-align: middle;">
                                    @if ($order['status'] == 5)
                                        <span class="btn btn-rounded btn-sm"
                                            style="color: #ffffff; background-color: #dc3545;">รอการส่งคืน</span>
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
                                </td>
                                <td style="text-align: center; vertical-align: middle;"> <a
                                        href="{{ route('orders_re.show', $order['id']) }}">{{ $order['id'] }}</a> </td>
                                <td style="text-align: center; vertical-align: middle;">{{ $order['created_at'] }}</td>
                                <td style="text-align: center; vertical-align: middle;"> {{ number_format($order['billing_total'] )}}
                                <td style="text-align: center; vertical-align: middle;"> {{ number_format($order['billing_deposit']) }}
                                </td>
                                <td style="text-align: center; vertical-align: middle;">
                                    @if ($order['image_return_slip'] == true)
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#returnModal" data-whatever="{{ $order['id'] }}"
                                            data-img_r="{{ $order['image_return_slip'] }}">
                                            View file
                                        </button>
                                    @endif
                                </td>
                                <td style="text-align: center; vertical-align: middle;">
                                    @if ($order['payment_slip'] != true)
                                        <a class=" btn btn-danger btn-sm cancel-confirm"
                                            href="orderss/cancel/{{ $order['id'] }}">Cancel</a>
                                    @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="returnModal" tabindex="-1" role="dialog" aria-labelledby="returnModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="returnModalLabel"></h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <img style="width:50%; height: 50%;" class="img" src="" alt="">
                </div>
            </div>
        </div>
    </div>
    <script>
        $('.cancel-confirm').on('click', function(event) {
            event.preventDefault();
            const url = $(this).attr('href');
            swal({
                title: "Are you sure?",
                text: "Your will cancel order :: {{ $order['id'] }}",
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
