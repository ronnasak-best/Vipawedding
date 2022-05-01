@extends('frontend.user.user_layout.master')
@section('title', 'List Categories')
@section('user-manage')
   @yield('order-manage')
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
                <form id="form_id" method="post" action="" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    @csrf
                    <div class="modal-body px-4">
                        <div class="form-row">
                            <div class="col-sm-12 px-4">
                                <h6 class="bank-transfer-text">เลือกธนาคารที่คุณต้องการชำระเงิน ตามรายชื่อธนาคารดังนี้</h6>
                                <div class="bank-list row px-3">
                                    @foreach ($banks as $bank)
                                        <div class="bank col-sm-6">
                                            <img src="{{ url('/') }}/banks/{{ $bank->logo }}"class="bank-logo">
                                            <div class="bank-infor">
                                                <p class="bank-name"> {{$bank->bank_name}} </p>
                                                <div class="bank-account-infor">
                                                    <div class="infor mr-2">
                                                        <span>เลขที่บัญชี</span>
                                                        <span>ชื่อบัญชี</span>
                                                        <span>สาขา</span>
                                                    </div>
                                                    <div class="infor">
                                                        <span>: {{$bank->account_no}}</span>
                                                        <span>: {{$bank->account_name}}</span>
                                                        <span>: {{$bank->bank_location}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <label class="ml-auto" id="radio-kbank">
                                                <input type="radio" name="bank_id" value="{{$bank->id}}"
                                                    class="input-element" required>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-sm-12 px-4 mt-2">
                                <label style="margin-bottom: 0.5px;">หลักฐานการโอนเงิน</label>
                                <input type="file" name="image_slip" id="upload_slip" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-primary sm-8">แนบหลักฐาน</button>
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
                                <select name="bank_name" class="form-control" required="">
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
                                <input type="text" class="form-control" name="account_name" aria-describedby="emailHelp"
                                    required="">
                            </div>
                            <div class="col-sm-6 px-4 py-4">
                                <label style="margin-bottom: 0.5px;">เลขที่บัญชี</label>
                                <input type="number" class="form-control" name="account_no" aria-describedby="emailHelp"
                                    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                    maxlength="10" required="">
                            </div>
                            <div class="col-sm-12 px-4 ">
                                <label style="margin-bottom: 0.5px;">Add file:</label>
                                <input type="file" name="image" id="upload" required>
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
    <script>
        $('.order-cancel').on('click', function(event) {
            event.preventDefault();
            const url = $(this).attr('href');
            Swal.fire({
                title: "Are you sure?",
                text: "Your will cancel order :: {{ $order['id'] }}",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function(result) {
                if (result.isConfirmed) {
                    Swal.fire("Poof! Your imaginary file has been deleted!", {
                        icon: "success",
                    });
                    window.location.href = url;
                } else {
                    Swal.fire({
                        title: "Your imaginary file is safe!",
                        timer: 1500
                    });
                }
            });
        });
    </script>
@endsection
