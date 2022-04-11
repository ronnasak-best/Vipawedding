@extends('frontend.layouts.master')
@section('title','List Categories')
@section('content')

    <h1>ADD address</h1>
    <form class="forms-sample" method="post" action="{{ action('AddressController@update',$address['id']) }}" enctype="multipart/form-data">
      <input type="hidden" name="_method" value="PATCH"/>
      {{csrf_field()}}
      <div class="form-group row">
        <label class="col-sm-4 control-label ">Name :</label>
          <div class="col-sm-4">
            <input type="text" name="name" class="form-control"  value="{{$address['name']}}"required="" id="name" >
         </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-4 control-label ">Surname :</label>
          <div class="col-sm-4">
            <input type="text" name="surname" class="form-control" value="{{$address['surname']}}" required="" id="surname" >
         </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-4 control-label ">Address:</label>
          <div class="col-sm-4">
            <textarea name="address"  class="col-sm-12"  required="">{{$address['address']}}</textarea>
         </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-4 control-label ">Province :</label>
          <div class="col-sm-4">
            <select class="form-control" name="province" id="input_province" onchange="showAmphoes()">
              <option value="">{{$address['province']}}</option>
            </select>
         </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-4 control-label ">District :</label>
          <div class="col-sm-4">
            <select  class="form-control"  name="district" id="input_amphoe" onchange="showDistricts()">
              <option value="">{{$address['district']}}</option>
            </select>
         </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-4 control-label ">Sub District :</label>
          <div class="col-sm-4">
            <select  class="form-control"  name="sub_district" id="input_district" onchange="showZipcode()">
              <option value="">{{$address['sub_district']}}</option>
            </select>
         </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-4 control-label ">Postal code :</label>
          <div class="col-sm-4">
            <input  id="input_zipcode" value="{{$address['pincode']}}" type="text" name="pincode" class="form-control" required="" >
         </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-4 control-label ">Mobile :</label>
          <div class="col-sm-4">
            <input name="mobile"
            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
            value="{{$address['mobile']}}"
            type = "number"
            maxlength = "10"
            class="form-control"
            required=""
            id="mobile"
            />
           </div>
      </div>
      <hr style="border-top: 2px solid #eee;">
         <div class=" " style="text-align:center;font-size:13px; ">
           <span>**ทางร้านจะโอนเงินคืนค่ามัดจำตามเลขบัญชีที่ท่านกรอก กรุณาตรวจสอบความถูกต้องก่อนยืนยัน**</span>
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
                  <input type="text" value="{{$address['account_name']}}"name="account_name" class="form-control" required=""  id="account_name" >
               </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-4 control-label ">Account No. :</label>
                <div class="col-sm-4">
                  <input name="account_no"
                  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                  type = "number"
                  value="{{$address['account_no']}}"
                  maxlength = "10"
                  class="form-control"
                  required=""
                  id="account_no"
                  />
                </div>
            </div>


      <button type="submit" class="btn btn-primary">save </button>
    </form>
    <script>
      $('#input_province').click(function(){
        console.log("HELLO");
        showProvinces();
        //dataTable();
      });

      function showProvinces(){
        //PARAMETERS
        var url = "{{ url('/') }}/province";
        var callback = function(result){
          $("#input_province").empty();
          for(var i=0; i<result.length; i++){
            $("#input_province").append(
              $('<option></option>')
                .attr("value", ""+result[i].province)
                .html(""+result[i].province)
            );
          }
          showAmphoes();
        };
        //CALL AJAX
        ajax(url,callback);
      }


      function showAmphoes(){
        //INPUT
        var province_code = $("#input_province").val();
        //PARAMETERS
        var url = "{{ url('/') }}/province/"+province_code+"/amphoe";
        var callback = function(result){
          //console.log(result);
          $("#input_amphoe").empty();
          for(var i=0; i<result.length; i++){
            $("#input_amphoe").append(
              $('<option></option>')
                .attr("value", ""+result[i].amphoe)
                .html(""+result[i].amphoe)
            );
          }
          showDistricts();
        };
        //CALL AJAX
        ajax(url,callback);
      }

      function showDistricts(){
        //INPUT
        var province_code = $("#input_province").val();
        var amphoe_code = $("#input_amphoe").val();
        //PARAMETERS
        var url = "{{ url('/') }}/province/"+province_code+"/amphoe/"+amphoe_code+"/district";
        var callback = function(result){
          //console.log(result);
          $("#input_district").empty();
          for(var i=0; i<result.length; i++){
            $("#input_district").append(
              $('<option></option>')
                .attr("value", ""+result[i].district)
                .html(""+result[i].district)
            );
          }
          showZipcode();
        };
        //CALL AJAX
        ajax(url,callback);
      }

      function showZipcode(){
        //INPUT
        var province_code = $("#input_province").val();
        var amphoe_code = $("#input_amphoe").val();
        var district_code = $("#input_district").val();
        //PARAMETERS
        var url = "{{ url('/') }}/province/"+province_code+"/amphoe/"+amphoe_code+"/district/"+district_code;
        var callback = function(result){
          //console.log(result);
          for(var i=0; i<result.length; i++){
            $("#input_zipcode").val(result[i].zipcode);
          }
        };
        //CALL AJAX
        ajax(url,callback);
      }

      function ajax(url, callback){
        $.ajax({
          "url" : url,
          "type" : "GET",
          "dataType" : "json",
        })
        .done(callback); //END AJAX
      }

    </script>
@endsection
