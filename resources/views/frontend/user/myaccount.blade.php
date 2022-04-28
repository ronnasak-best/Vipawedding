@extends('frontend.user.user_layout.master')
@section('title', 'List Categories')
@section('user-manage')
    <div class="card">
        <div class="title-head">
            <div class="account-icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                    <path d="M12 13.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z"></path>
                    <path fill-rule="evenodd"
                        d="M19.071 3.429C15.166-.476 8.834-.476 4.93 3.429c-3.905 3.905-3.905 10.237 0 14.142l.028.028 5.375 5.375a2.359 2.359 0 003.336 0l5.403-5.403c3.905-3.905 3.905-10.237 0-14.142zM5.99 4.489A8.5 8.5 0 0118.01 16.51l-5.403 5.404a.859.859 0 01-1.214 0l-5.378-5.378-.002-.002-.023-.024a8.5 8.5 0 010-12.02z">
                    </path>
                </svg>
            </div>
            <div class="title-text">
                <h2> ที่อยู่จัดส่งสินค้า </h2>
                <span> สามารถแก้ไขที่อยู่ของคุณได้ </span>
            </div>
            <div class="header-action" style="text-align: right;width: 100%;">
                <button onclick="resetFormValue()" class="btn btn-primary button primary " data-toggle="modal"
                    data-target="#address-form">เพิ่มที่อยู่ </button>
            </div>
        </div>
        <div id="shipping-address-list">
            @foreach ($address as $addr)
                <div class="shipping-address">
                    <div class="name-phone">
                        {{ $addr['name'] }}<br>
                        {{ $addr['mobile'] }}
                    </div>
                    <div class="address-info">
                        {{ $addr['address'] }} {{ $addr['district'] }} {{ $addr['sub_district'] }}
                        {{ $addr['province'] }}
                        {{ $addr['pincode'] }}
                        <span class="default-shipping">{{ $addr['default_address'] == 1 ? '[ค่าเริ่มต้น]' : '' }}</span>
                    </div>
                    <div class="edit">
                        <button onclick="setFormValueForEdit({{ $addr['id'] }})" class="button">
                            แก้ไข
                        </button>
                        <button onclick="DeleteAddress({{ $addr['id'] }})"="" class="button"
                            {{ $addr['default_address'] == 1 ? 'disabled' : '' }}>
                            ลบ
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
    <!-- Modal -->
    <div class="modal fade" id="address-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 600px;">
            <div class="modal-content" style="padding: 0 20px;">
                <div class="modal-header">
                    <div class="modal-title">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path fill-rule="evenodd"
                                d="M11.03 2.59a1.5 1.5 0 011.94 0l7.5 6.363a1.5 1.5 0 01.53 1.144V19.5a1.5 1.5 0 01-1.5 1.5h-5.75a.75.75 0 01-.75-.75V14h-2v6.25a.75.75 0 01-.75.75H4.5A1.5 1.5 0 013 19.5v-9.403c0-.44.194-.859.53-1.144l7.5-6.363zM12 3.734l-7.5 6.363V19.5h5v-6.25a.75.75 0 01.75-.75h3.5a.75.75 0 01.75.75v6.25h5v-9.403L12 3.734z">
                            </path>
                        </svg>
                        <div>
                            <h1 class="shippingTitle">เพิ่มที่อยู่ใหม่</h1>
                            <span>ที่อยู่จัดส่งสินค้า</span>
                        </div>
                    </div>
                    <button type="button" class="close sm-up" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body address-form-modal pt-0 pb-0" style="background-color: white; border-radius: 8px;">
                    <form id="shipping-address">
                        <input type="hidden" name="address_id" value="">
                        <div class="row">
                            <div class="col col-12 col-md-6">
                                <div class="input-item">
                                    <label class="label" for="full-name">ชื่อ-นามสกุล</label>
                                    <input onblur="validateRequired(this)" error-for="address_name" type="text"
                                        name="address_name" placeholder="กรอกชื่อ-นามสกุล" id="full-name"
                                        class="">
                                </div>
                                <div error-text-for="address_name" class="error-message ">จำเป็นต้องกรอกข้อมูล</div>
                            </div>
                            <div class="col col-12 col-md-6">
                                <div class="input-item">
                                    <label class="label" for="phone-number">หมายเลขโทรศัพท์</label>
                                    <input onblur="falidatePhoneNumber(this)" error-for="phone_number" type="number"
                                        name="phone_number" placeholder="กรอกหมายเลขโทรศัพท์" id="phone-number"
                                        class="">
                                </div>
                                <div error-text-for="phone_number" class="error-message">จำเป็นต้องกรอกข้อมูล</div>
                            </div>
                            <div class="col col-12 col-md-12">
                                <div class="input-item">
                                    <label class="label" for="address">ที่อยู่</label>
                                    <textarea onblur="validateRequired(this)" rows="4" error-for="address" type="text" name="address"
                                        placeholder="กรอกบ้านเลขที่, หมู่, ซอย, อาคาร, ถนน และจุดสังเกตุ (ถ้ามี)"
                                        id="address"></textarea>
                                </div>
                                <div error-text-for="address" class="error-message">จำเป็นต้องกรอกข้อมูล</div>
                            </div>
                            <div class="col col-12 col-md-6">
                                <div class="input-item">
                                    <label class="label">จังหวัด</label>
                                    <select class="input" name="province" id="input_province1"
                                        onchange="showAmphoes()">
                                        <option value="">กรุณาเลือกจังหวัด</option>
                                    </select>
                                    <div error-text-for="province_id" class="error-message">จำเป็นต้องกรอกข้อมูล</div>
                                </div>
                            </div>
                            <div class="col col-12 col-md-6">
                                <div class="input-item">
                                    <label class="label">อำเภอ/เขต</label>
                                    <select class="input" name="district" id="input_district"
                                        onchange="showDistricts()">
                                        <option value="">กรุณาเลือกอำเภอ</option>
                                    </select>
                                    <div error-text-for="province_id" class="error-message">จำเป็นต้องกรอกข้อมูล</div>
                                </div>
                            </div>
                            <div class="col col-12 col-md-6">
                                <div class="input-item">
                                    <label class="label">ตำบล/แขวง</label>
                                    <select class="input" name="sub_district" id="input_sub_district"
                                        onchange="showZipcode()">
                                        <option value="">กรุณาเลือกตำบล</option>
                                    </select>
                                    <div error-text-for="tambon_id" class="error-message">จำเป็นต้องกรอกข้อมูล</div>
                                </div>
                            </div>
                            <div class="col col-12 col-md-6">
                                <div class="input-item">
                                    <label class="label">รหัสไปรษณีย์</label>
                                    <input id="input_pincode" type="number" name="pincode" class="form-control"
                                        required="">
                                    <div error-text-for="postcode" class="error-message">จำเป็นต้องกรอกข้อมูล</div>
                                </div>
                            </div>
                            <div class="col col-12 col-md-6">
                                <div class="form-check form-check-inline " style="margin: 20px 0">
                                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2"
                                        name="default_address">
                                    <label class="form-check-label" for="inlineCheckbox2">ตั้งค่าเริ่มต้น</label>
                                </div>
                            </div>
                        </div><!-- end row -->
                </div>
                <div class="modal-footer ">
                    <button onclick="$('#button-delete-shipping-address').hide()" type="button"
                        class="btn btn-default button default" data-dismiss="modal">ยกเลิก</button>
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!--End Modal -->




    <script>
        var msg = '{{ Session::get('message') }}';
        var exist = '{{ Session::has('message') }}';
        if (exist) {
            alert(msg);
        }
    </script>
@endsection
