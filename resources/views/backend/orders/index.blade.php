@extends('backend.layouts.master')
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-library-books"></i>
            </span> Orders
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
                            <th style="text-align: center; vertical-align: middle;">จำนวนเงิน</th>
                            <th style="text-align: center; vertical-align: middle;">Uplode Slip</th>
                            <th style="text-align: center; vertical-align: middle;">status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td style="text-align: center; vertical-align: middle;">
                                    @if ($order['status'] == 1)
                                        <span class="btn btn-rounded btn-sm"
                                            style="color: #212529; background-color: #ffc107;">รอชำระเงิน</span>
                                    @elseif($order['status'] == 2)
                                        <span class="btn btn-rounded btn-sm"
                                            style="color: #ffffff; background-color: #ff854a;">รอเช็คยอด</span>
                                    @elseif($order['status'] == 3)
                                        <span class="btn btn-rounded btn-sm"
                                            style="color: #ffffff; background-color: #17a2b8;">รอจัดส่ง</span>
                                    @endif
                                </td>
                                <td style="text-align: center; vertical-align: middle;"> <a
                                        href="{{ route('orderss.show', $order['id']) }}">{{ $order['id'] }}</a> </td>
                                <td style="text-align: center; vertical-align: middle;">{{ $order['created_at'] }}</td>
                                <td style="text-align: center; vertical-align: middle;"> {{ $order['billing_total'] }}
                                </td>
                                <td style="text-align: center; vertical-align: middle;">
                                    @if ($order['payment_slip'] == true)
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                                            data-target="#ShowModal" data-whatever="{{ $order['id'] }}"
                                            data-img="{{ $order['payment_slip'] }}">
                                            View file
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade bd-example-modal-lg" id="ShowModal" tabindex="-1"
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
                                                        <img class="img"
                                                            src="{{ url('/') }}/slip/{{ $order['payment_slip'] }}"
                                                            alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
