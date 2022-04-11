@extends('frontend.user.user_layout.master')
@section('title','List Categories')
@section('user-manage')
<!-- <h1 style="text-align : center;">ADD ADDRESS</h1>
<form class="forms-sample" method="post" action="{{route('myaccount.store')}}" enctype="multipart/form-data">
    {{csrf_field()}}
    <input type="hidden" name="users_id" value="{{$user}}">
    <div class="input-field">

        <div class="form-group row">
            <label class="col-sm-4 control-label ">Name :</label>
            <div class="col-sm-4">
                <input type="text" name="name" class="form-control" required="" id="name">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-4 control-label ">Surname :</label>
            <div class="col-sm-4">
                <input type="text" name="surname" class="form-control" required="" id="surname">
            </div>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-4 control-label ">Address:</label>
        <div class="col-sm-4">
            <textarea name="address" class="col-sm-12" required=""></textarea>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-4 control-label ">Province :</label>
        <div class="col-sm-4">
            <select class="form-control" name="province" id="input_province" onchange="showAmphoes()">
                <option value="">กรุณาเลือกจังหวัด</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-4 control-label ">District :</label>
        <div class="col-sm-4">
            <select class="form-control" name="district" id="input_amphoe" onchange="showDistricts()">
                <option value="">กรุณาเลือกอำเภอ</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-4 control-label ">Sub District :</label>
        <div class="col-sm-4">
            <select class="form-control" name="sub_district" id="input_district" onchange="showZipcode()">
                <option value="">กรุณาเลือกตำบล</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-4 control-label ">Postal code :</label>
        <div class="col-sm-4">
            <input id="input_zipcode" type="number" name="pincode" class="form-control" required="">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-4 control-label ">Mobile :</label>
        <div class="col-sm-4">
            <input name="mobile"
                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                type="text" maxlength="10" class="form-control" required="" id="mobile" />
        </div>
    </div>
    <hr style="border-top: 2px solid #eee;">
    <div class=" " style="text-align:center;font-size:13px; ">
        <span>**ทางร้านจะโอนเงินคืนค่ามัดจำตามเลขบัชชีที่ท่านกรอก กรุณาตรวจสอบความถูกต้องก่อนยืนยัน**</span>
    </div>
    <div class="form-group row">
        <label class="col-sm-4 control-label ">Bank account name :</label>
        <div class="col-sm-4">
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
    </div>
    <div class="form-group row">
        <label class="col-sm-4 control-label ">Account Name :</label>
        <div class="col-sm-4">
            <input type="text" name="account_name" class="form-control" required="" id="account_name">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-4 control-label ">Account No. :</label>
        <div class="col-sm-4">
            <input name="account_no"
                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                type="text" maxlength="10" class="form-control" required="" id="account_no" />
        </div>
    </div>






    <button type="submit" class="btn btn-primary">save </button>
</form> -->
@endsection



<script>
let shippingAddressData = []
$(window).ready(async function() {
    $('.sub-menu-item.address').addClass('active')
    $('#tab_bar_main_card').hide()
    shippingAddressData = await getShipingAddress()
})
const initForm = {
    address_name: '',
    phone_number: '',
    address: '',
    province_id: '',
    amphure_id: '',
    tambon_id: '',
    postcode: '',
    is_default_shipping: 0,
}
const label = {
    province_id: 'เลือกจังหวัด',
    amphure_id: 'เลือกอำเภอ/เขต',
    tambon_id: 'เลือกตำบล/แขวง',
    postcode: 'เลือกรหัสไปรษณีย์',
}

function resetFormValue() {
    for (const [key, value] of Object.entries(initForm)) {
        // reset error message
        $(`[error-for=${key}]`).removeClass('error')
        $(`[error-text-for=${key}]`).removeClass('error')

        // reset value
        $(`[selector-label=${key}]`).html(label[key])
        $(`[name=${key}]`).val(null)
    }
    $('input[name=is_default_shipping]').prop('checked', false)
    $('button[type=submit]').prop('disabled', false)
    $(`[name=address_id]`).val(null)
    $('#button-delete-shipping-address').hide()
    $('.shippingTitle').text('เพิ่มที่อยู่ใหม่')
}

let isAddressEmpty = (2 === 0);
if (!isAddressEmpty) {
    $('#is-default-shipping').removeClass('hide')
}
/** On submit form shipping address */
function handleFormSubmit() {
    if (validateForm()) {
        for (const [key, value] of Object.entries(initForm)) {
            if (key === 'is_default_shipping') {
                initForm[key] = $(`[name=${key}]`).is(":checked")
            } else {
                initForm[key] = $(`[name=${key}]`).val()
            }
        }
        if (isAddressEmpty) {
            initForm['is_default_shipping'] = 1 // true
        }
        $('button[type=submit]').prop('disabled', true)
        $('button[type=submit]').addClass('loading')
        isUpdate = !!$('input[name=address_id').val()
        $.ajax({
            url: `/api/customer-address/134868/${isUpdate ? +$("input[name=address_id").val() : ''}`,
            method: isUpdate ? 'PUT' : 'POST',
            data: {
                ...initForm,
                type: 'create',
                is_default_billing: 0,
                is_default_shipping: initForm['is_default_shipping'] ? 1 : 0,
                type: isUpdate ? 'update' : 'create',
            },
            crossDomain: true,
            dataType: 'json',
            xhrFields: {
                withCredentials: true
            },
            success: (resp) => {
                isAddressEmpty = false
                renderAddressList()
                swal({
                    html: '<div class="success-alert"><img src="https://www.mercular.com/img/icons/success.svg" /><p style="font-size: 18px;font-weight: bold;margin-top:48px;">บันทึกข้อมูลสำเร็จ</p></div>',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    $('button[type=submit]').prop('disabled', false)
                    $('#address-form').modal('hide')
                })
            },
            error: (err) => {
                console.log(err)
            }
        })
    }
}

function validateForm() {
    let isvalid = true
    for (const [key, value] of Object.entries(initForm)) {
        if (
            key === 'phone_number' &&
            $(`input[name=${key}]`).val() &&
            $(`input[name=${key}]`).val().length < 9
        ) {
            isvalid = false
            $('[error-text-for=phone_number]').html('กรอกหมายเลขโทรศัพท์ไม่ครบตามจำนวนที่กำหนด')
            $(`[error-for=${key}]`).addClass('error')
            $(`[error-text-for=${key}]`).addClass('error')
            continue
        }

        if (key !== 'is_default_shipping' && !$(`[name=${key}]`).val()) {
            isvalid = false;
            $(`[error-for=${key}]`).addClass('error')
            $(`[error-text-for=${key}]`).addClass('error')
        } else {
            $(`[error-for=${key}]`).removeClass('error')
            $(`[error-text-for=${key}]`).removeClass('error')
        }
    }
    return isvalid
}

async function renderAddressList() {
    try {
        const resp = await getShipingAddress()
        shippingAddressData = resp
        $('#shipping-address-list').empty()
        resp.forEach(address => {
            $('#shipping-address-list').append(`
                <div class="shipping-address">
                    <div class="name-phone"> 
                        ${address.name} <br/> <b class="sm-down"> | </b>
                        ${address.phone_number}
                    </div>
                    <div class="address-info"> 
                        ${[address.address, address.tambon, address.amphure, address.province, address.postcode].join(' ')} 
                        ${address.is_default_shipping === '1' ? '<span class="default-shipping"> [ค่าเริ่มต้น] </span>' : ''}
                    </div>
                    <div class="edit">
                        <button onclick="setFormValueForEdit(${address.id})" class="button">
                            แก้ไข
                        </button>
                        <button onclick="handleClickDeletAddress(${address.id})" ${address.is_default_shipping === '1' ? 'disabled': ''} class="button">
                            ลบ
                        </button>
                    </div>
                    <div onclick="handleClickEditOfMobile(${address.id}, ${address.is_default_shipping || false})" class="mb-edit sm-down">
                        <div class="icon">
                            <img src="https://www.mercular.com/img/icons/arrow-down.svg">
                        </div>
                    </div>
                </div>
                `)
            $('#no-shipping-address').hide()
        });
    } catch (error) {
        swal({
            type: 'error',
            title: 'Oops!',
            text: 'Something went wrong!',
        })
        console.error(error)
    }
}

async function getShipingAddress() {
    return await $.ajax({
        url: '/cart/address/json',
        method: 'GET',
        crossDomain: true,
        dataType: 'json',
        xhrFields: {
            withCredentials: true
        },
    })
}

function handleClickDeletAddress(id, isMobile = false) {
    const closeModal = isMobile ? () => $('#address-form').modal('hide') : () => null
    if (id && id !== "") {
        swal({
            html: `
                <div id="confirm-delete-dialog">
                    <img src='https://www.mercular.com/img/icons/dialog-warning.svg' alt='' />
                    <h5> คุณต้องการลบที่อยู่นี้ </h5>
                    <div class="action">
                        <a onclick="window.swal.close()" class="button default"> ยกเลิก </a>
                        <a onclick="deleteAddress(${id}); ${isMobile} ? $('#address-form').modal('hide') : ''" class="confirm-delete button primary"> ลบที่อยู่ </a>
                    </div>
                </div>
                `,
            showConfirmButton: false,
        })
    }
}
async function deleteAddress(id) {
    swal.close()
    $('#button-delete-shipping-address').hide()
    var customerId = '134868';
    var url = 'https://www.mercular.com/api/customer-address/' + customerId + '/' + id;
    await $.ajax({
        url: url,
        type: 'DELETE'
    })
    renderAddressList()
}

function handleClickEditOfMobile(id, isDefault) {
    if (isDefault) {
        $('#button-delete-shipping-address').hide()
    } else {
        $('#button-delete-shipping-address').show()
        $('#button-delete-shipping-address button').attr('address-id', id)
    }
    setFormValueForEdit(id)
}

async function setFormValueForEdit(id) {
    $('input[name=address_id').val(id)
    const addressSelected = shippingAddressData.find(each => each.id == id)
    const apiKey = {
        name: 'address_name',
        phone_number: 'phone_number',
        address: 'address',
        province_id: 'province_id',
        amphure_id: 'amphure_id',
        tambon_id: 'tambon_id',
        postcode: 'postcode',
        is_default_shipping: 0,
    }
    const valueKey = {
        province_id: 'province',
        amphure_id: 'amphure',
        tambon_id: 'tambon',
        postcode: 'postcode',
    }
    for (const [key, value] of Object.entries(apiKey)) {
        if (key === 'is_default_shipping') {
            initForm[key] = $(`[name=${key}]`).prop('checked', addressSelected[key] == '1')
        } else {
            $(`[selector-label=${key}]`).html(addressSelected[valueKey[key]])
            $(`[name=${value}]`).val(addressSelected[key])
        }
    }
    $('#address-form').modal('show')
    $('.shippingTitle').text('แก้ไขที่อยู่')
    getDistrict({
        id: addressSelected.province_id
    }, false)
    getSubDistrict({
        id: addressSelected.amphure_id
    }, false)
}
</script>