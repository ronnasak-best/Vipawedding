@extends('backend.layouts.master')
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-tshirt-crew"></i>
            </span> รายงานสรุปการชำระเงินค่ามัดจำ/ค่าปรับ
        </h3>
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="form-inline">
                    <label class="mr-2">วันที่ </label>
                    <input type="date" class="form-control mb-2 mr-sm-2" id="start">
                    <label class="mr-2">ถึง </label>
                    <input type="date" class="form-control mb-2 mr-sm-2" id="end">
                    <button type="button" id="search" class="btn btn-gradient-primary mb-2">ค้นหา</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 grid-margin stretch-card d-none" id="report">
        <div class="card">
            <div class="card-body">
                <table id="reports" class="table dataTable">

                </table>
            </div>
        </div>
    </div>
@endsection
