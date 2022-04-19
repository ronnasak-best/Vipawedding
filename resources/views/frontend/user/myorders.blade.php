@extends('frontend.user.user_layout.master')
@section('title', 'List Categories')
@section('user-manage')
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
    <!-- Modal Slip upload -->
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
                    <form id="form_id" method="post" action="" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Add file:</label>
                            <div class="">
                                <input type="file" name="image" class="form-control">
                            </div>

                        </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary sm-8">upload</button>
                </div>
                </form>
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
    <!-- Modal return-->
    <div class="modal fade bd-example-modal-lg" id="returnModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="returnModalLabel"></h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form_return" method="post" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body px-4">
                        <div class="form-row">
                            <div class="col-sm-6 px-4">
                                <label style="margin-bottom: 0.5px;">ธนาคาร</label>
                                <select name="txtBank" class="form-control">
                                    <option value="พร้อมเพย์">พร้อมเพย์</option>
                                    <option value="ธนาคารกรุงเทพ">ธนาคารกรุงเทพ</option>
                                    <option value="ธนาคารกรุงไทย">ธนาคารกรุงไทย</option>
                                    <option value="ธนาคารกรุงศรี">ธนาคารกรุงศรี</option>
                                    <option value="ธนาคารทหารไทย">ธนาคารทหารไทย</option>
                                    <option value="ธนาคารกสิกรไทย">ธนาคารกสิกรไทย</option>
                                    <option value="ธนาคารไทยพานิชย์">ธนาคารไทยพานิชย์</option>
                                    <option value="ธนาคารยูโอบี">ธนาคารยูโอบี</option>
                                    <option value="ธนาคารออมสิน">ธนาคารออมสิน</option>
                                    <option value="ธนาคาร ธ.ก.ส">ธนาคาร ธ.ก.ส</option>
                                    <option value="ธนาคารธนชาต">ธนาคารธนชาต</option>
                                    <option value="ธนาคารอาคารสงเคราะห์">ธนาคารอาคารสงเคราะห์</option>
                                    <option value="ธนาคารซีไอเอ็มบี">ธนาคารซีไอเอ็มบี</option>
                                    <option value="ธนาคารซิตี้แบงค์">ธนาคารซิตี้แบงค</option>
                                    <option value="ธนาคารดอยซ์แบงก์">ธนาคารดอยซ์แบงก์</option>
                                    <option value="ธนาคารเอชเอสบีซี">ธนาคารเอชเอสบีซี</option>
                                    <option value="ธนาคารไอซีบีซี">ธนาคารไอซีบีซี</option>
                                    <option value="ธนาคารเกียรตินาคิน">ธนาคารเกียรตินาคินน</option>
                                    <option value="ธนาคารแลนด์ แอนด์ เฮ้าส์">ธนาคารแลนด์ แอนด์ เฮ้าส์</option>
                                    <option value="ธนาคารมิซูโฮ">ธนาคารมิซูโฮ</option>
                                    <option value="ธนาคารสแตนดาร์ดชาร์เตอร์ด">ธนาคารสแตนดาร์ดชาร์เตอร์ด</option>
                                    <option value="ธนาคารซูมิโตโม">ธนาคารซูมิโตโม</option>
                                    <option value="ธนาคารทิสโก้">ธนาคารทิสโก้</option>

                                </select>
                            </div>
                            <div class="col-sm-6 px-4">
                                <label style="margin-bottom: 0.5px;">ชื่อบัญชี</label>
                                <input type="text" class="form-control" name="bank_name"
                                    aria-describedby="emailHelp">
                            </div>
                            <div class="col-sm-6 px-4 py-4">
                                <label style="margin-bottom: 0.5px;">เลขที่บัญชี</label>
                                <input type="text" class="form-control" name="bank_number"
                                    aria-describedby="emailHelp">
                            </div>
                            <div class="col-sm-12 px-4 ">
                                <label style="margin-bottom: 0.5px;">Add file:</label>
                                <input type="file" name="image" class="form-control">                           
                            </div>
                        </div>                      
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-danger sm-8 ">ยกเลิก</button>
                        <button type="submit" class="btn btn-primary sm-8">แนบหลักฐาน</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="ShowReturnModal" tabindex="-1" role="dialog"
        aria-labelledby="ShowModalLabel" aria-hidden="true">
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
