@extends('frontend.layouts.master')
@section('title','HOME')
@section('content')
<link href="https://fonts.googleapis.com/css2?family=Athiti&display=swap" rel="stylesheet">

<div class="" style="text-align: center;">
  <h5 style="color:#D28BB5;font-family: 'Athiti', sans-serif;">RENT A DRESS FOR YOUR SPECIAL OCCASION</h5>
  <h6 style="color:#D28BB5;font-family: 'Athiti', sans-serif;">บริการเช่าชุดราตรี ชุดออกงาน เครื่องประดับ</h6><br><br>
  <h3 style="color:#D28BB5;font-family: 'Athiti', sans-serif;">อ่านวิธีการสั่งซื้อ และข้อสงสัยก่อนทำการเช่าสินค้า</h3><br>

</div>
<div class="row  ml-5 mr-5 mb-1 ">
  <div class="col-sm-8 pl-1 pr-1">
    <img src="{{asset('/images/4.jpg')}}" alt="" style="width: 100%; height:400px">
  </div>
  <div class="col-sm-4 pl-1 pr-1">
    <img src="{{asset('/images/1.jpg')}}" alt=""  style="width: 100%; height:400px">
</div>
</div>
<div class="row ml-5 mr-5 mb-5 ">
  <div class="col-sm-4 pl-1 pr-1">
    <img src="{{asset('/images/2.jpg')}}" alt="" style="width: 100%; height:400px">
  </div>
  <div class="col-sm-8 pl-1 pr-1">
    <img src="{{asset('/images/3.jpg')}}" alt=""  style="width: 100%; height:400px">
</div>

</div>


@endsection
