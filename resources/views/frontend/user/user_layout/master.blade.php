@extends('frontend.layouts.master')
@section('title','List Categories')
@section('content')
<hr>
<div class="row">
    <div class="col-sm-3">
        <div class="sm-up">
            <div class="menu-account-welcome text">
                ยินดีต้อนรับ, &nbsp; <strong>ronnasak_best@hotmail.com </strong>
            </div>
            <div class="menu-account-item profile">
                <div class="menu-card">
                    <img src="https://www.mercular.com/img/icons/menu/user-hover.svg" class="menu-icon-account">
                    <span>
                        บัญชีของฉัน</span>
                    <div id="moreProfile">
                        <img id="arrowCollapse" class="toogle-up open"
                            src="https://www.mercular.com/img/icons/menu/link-up.svg">
                    </div>
                </div>
            </div>
            <div class="sub-menu-account profile" id="profileDetail">
                <a href="{{route('myaccount.index')}}" class="sub-menu-item profile detail">
                    ข้อมูลส่วนตัว </a>
                <a href="{{route('myaccount.index')}}" class="sub-menu-item profile detail"> ที่อยู่จัดส่งสินค้า
                </a>
            </div>
            <a href="{{ route('orders.index') }}">
                <div class="menu-account-item orderlist-menu">
                    <img src="https://www.mercular.com/img/icons/page.svg" class="menu-icon-account">
                    <span>รายการคำสั่งซื้อ</span>
                </div>
            </a>

            <a>
                <div class="menu-account-item last-child" onclick="leftMenuLogout()">
                    <img src="https://www.mercular.com/img/icons/logout.svg" class="menu-icon-account"> <span>
                        ออกจากระบบ</span>
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-9">
        @yield('user-manage')
    </div>
</div>
<script>
$('#input_province1').ready(function() {
    //console.log("HELLO");
    showProvinces();
    //dataTable();
});

function showProvinces() {
    //PARAMETERS
    var url = "{{ url('/') }}/province";
    var callback = function(result) {
        // $("#input_province").empty();
        for (var i = 0; i < result.length; i++) {
            $("#input_province1").append(
                $('<option></option>')
                .attr("value", "" + result[i].province)
                .html("" + result[i].province)
            );
        }
        showAmphoes();
    };
    //CALL AJAX
    ajax(url, callback);
}


function showAmphoes() {
    //INPUT
    var province_code = $("#input_province1").val();
    //PARAMETERS
    var url = "{{ url('/') }}/province/" + province_code + "/amphoe";
    var callback = function(result) {
        //console.log(result);
        $("#input_district").empty();
        for (var i = 0; i < result.length; i++) {
            $("#input_district").append(
                $('<option></option>')
                .attr("value", "" + result[i].amphoe)
                .html("" + result[i].amphoe)
            );
        }
        showDistricts();
    };
    //CALL AJAX
    ajax(url, callback);
}

function showDistricts() {
    //INPUT
    var province_code = $("#input_province1").val();
    var amphoe_code = $("#input_district").val();
    //console.log(amphoe_code);
    //PARAMETERS
    var url = "{{ url('/') }}/province/" + province_code + "/amphoe/" + amphoe_code + "/district";
    var callback = function(result) {
        //console.log(result);
        $("#input_sub_district").empty();
        for (var i = 0; i < result.length; i++) {
            $("#input_sub_district").append(
                $('<option></option>')
                .attr("value", "" + result[i].district)
                .html("" + result[i].district)
            );
        }
        showZipcode();
    };
    //CALL AJAX
    ajax(url, callback);
}

function showZipcode() {
    //INPUT
    var province_code = $("#input_province1").val();
    var amphoe_code = $("#input_district").val();
    var district_code = $("#input_sub_district").val();
    //PARAMETERS
    var url = "{{ url('/') }}/province/" + province_code + "/amphoe/" + amphoe_code + "/district/" + district_code;
    var callback = function(result) {
        //console.log(result);
        for (var i = 0; i < result.length; i++) {
            $("#input_pincode").val(result[i].zipcode);
        }
    };
    //CALL AJAX
    ajax(url, callback);
}

function ajax(url, callback) {
    $.ajax({
            "url": url,
            "type": "GET",
            "dataType": "json",
        })
        .done(callback); //END AJAX
}
</script>
<script>
function validateRequired(e) {
    if (!e.value) {
        e.classList.add('error')
        $(`[error-text-for=${e.name.replace("_m","")}]`).addClass('error')
    } else {
        e.classList.remove('error')
        $(`[error-text-for=${e.name.replace("_m","")}]`).removeClass('error')
    }
}

function falidatePhoneNumber(e) {
    if (!e.value) {
        e.classList.add('error')
        $(`[error-text-for=${e.name}]`).addClass('error')
        $(`[error-text-for=${e.name}]`).html('จำเป็นต้องกรอกข้อมูล')
        return
    }
    if (e.value.length <= 9 || e.value.length > 10) {
        e.classList.add('error')
        $(`[error-text-for=${e.name}]`).addClass('error')
        $(`[error-text-for=${e.name}]`).html('กรอกหมายเลขโทรศัพท์ไม่ครบตามจำนวนที่กำหนด')
    } else {
        e.classList.remove('error')
        $(`[error-text-for=${e.name}]`).removeClass('error')
    }
}
</script>
<script>
let shippingAddressData
document.addEventListener('DOMContentLoaded', async function() {
    // console.log('ready');
    shippingAddressData = await getShipingAddress()
    // console.log(shippingAddressData);
})

function resetFormValue() {
    document.getElementById("input_province1").selectedIndex = "0";
    for (const [key, value] of Object.entries(initForm)) {
        // reset error message
        $(`[error-for=${key}]`).removeClass('error')
        $(`[error-text-for=${key}]`).removeClass('error')

        // reset value
        $(`[name=${key}]`).val(null);
        $(`[id=input_${key}]`).empty();
        $(`[id=input_${key}]`).append(`[<option value="">${label[key]}</option>]`);
    }
    $('input[name=default_address').prop('checked', false)
    $('button[type=submit]').prop('disabled', false)
    $(`[name=address_id]`).val(null)
    $('#button-delete-shipping-address').hide()
    $('.shippingTitle').text('เพิ่มที่อยู่ใหม่')
}
const initForm = {
    address_name: '',
    phone_number: '',
    address: '',
    province: '',
    district: '',
    sub_district: '',
    pincode: '',
    default_address: 0,
}
const label = {
    province: 'เลือกจังหวัด',
    district: 'เลือกอำเภอ/เขต',
    sub_district: 'เลือกตำบล/แขวง',
    pincode: 'เลือกรหัสไปรษณีย์',
}
$('#shipping-address').on('submit', function(e) {
    e.preventDefault();
    if (validateForm()) {
        for (const [key, value] of Object.entries(initForm)) {
            if (key === 'default_address') {
                initForm[key] = $(`[name=${key}]`).is(":checked")
            } else {
                initForm[key] = $(`[name=${key}]`).val()
            }
        }
        // if (isAddressEmpty) {
        //     initForm['is_default_shipping'] = 1 // true
        // }
        $('button[type=submit]').prop('disabled', true)
        $('button[type=submit]').addClass('loading')
        isUpdate = !!$('input[name=address_id').val()
        $.ajax({
            url: '{{route('myaccount.store')}}' + (isUpdate ? '/' + $('input[name=address_id').val() : ''),
            method: isUpdate ? 'PUT' : 'POST',
            //method: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                ...initForm,
                // is_default_billing: 0,
                default_address: initForm['default_address'] ? 1 : 0,
                //type: isUpdate ? 'update' : 'create',
            },
            success: (resp) => {
                // isAddressEmpty = false
                renderAddressList()
                Swal.fire({
                    title: 'บันทึกข้อมูลสำเร็จ',
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
})

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

        // if (key !== 'is_default_shipping' && !$(`[name=${key}]`).val()) {
        //     isvalid = false;
        //     $(`[error-for=${key}]`).addClass('error')
        //     $(`[error-text-for=${key}]`).addClass('error')
        // } else {
        //     $(`[error-for=${key}]`).removeClass('error')
        //     $(`[error-text-for=${key}]`).removeClass('error')
        // }
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
                        ${address.name}<br>
                        ${address.mobile}
                    </div>
                    <div class="address-info">
                        ${[address.address, address.district, address.sub_district, address.province, address.pincode].join(' ')} 
                        ${address.default_address == '1' ? '<span class="default-shipping"> [ค่าเริ่มต้น] </span>' : ''}                                          
                    </div>
                    <div class="edit">
                        <button onclick="setFormValueForEdit(${address.id})" class="button">
                            แก้ไข
                        </button>
                        <button onclick="DeleteAddress(${address.id})"="" class="button" ${address.default_address == '1' ? 'disabled': ''} >
                            ลบ
                        </button>
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

function getShipingAddress() {
    return fetch('{{route('myaccount.create')}}')
        .then(res => {
            return res.json()
        })
        .catch(err => {
            console.log('Error: ', err)
        })
}
function DeleteAddress(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
           $.ajax({
                url: '{{route('myaccount.store')}}' + '/' + id,
                method: 'DELETE',
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id,
                },
                success: (resp) => {
                    Swal.fire({
                        title: 'Deleted!',
                        text: "Your file has been deleted.",
                        icon: 'success',
                        timer: 1500,
                    }).then(function() {
                        renderAddressList()
                    })
                },
                error: (err) => {
                    console.log(err)
                }
            })
           
        }
    })
}

async function setFormValueForEdit(id) {
    $('input[name=address_id').val(id)
    const addressSelected = shippingAddressData.find(each => each.id == id)
    const apiKey = {
        name: 'address_name',
        mobile: 'phone_number',
        address: 'address',
        province: 'province',
        district: 'district',
        sub_district: 'sub_district',
        pincode: 'pincode',
        default_address: 0,
    }
    const valueKey = {
        province: 'province',
        district: 'district',
        sub_district: 'sub_district',
        pincode: 'pincode',
    }
    for (const [key, value] of Object.entries(apiKey)) {
        if (key === 'default_address') {
            initForm[key] = $(`[name=${key}]`).prop('checked', addressSelected[key] == '1')
        } else {
            //(`[selector-label=${key}]`).
            $(`[name=${value}]`).val(addressSelected[key])
        }

    }
    await showAmphoes()
    await showDistricts()
    $('#address-form').modal('show')
    $('.shippingTitle').text('แก้ไขที่อยู่')
    document.querySelector("#input_district").selectedIndex = "3";
    //document.getElementById("input_district").selectedIndex = "3";
    //console.log(addressSelected.district);
    $("select#input_district option").filter(":selected").val();
    //$("#input_district").val("เมืองลำปาง").trigger("loded");
    //$(`.district option[value='${addressSelected.district}']`)
    //$(`.district option[value='${addressSelected.district}']`).attr('selected','selected');
    //$('#input_district').val(addressSelected.district);
}
</script>
@endsection