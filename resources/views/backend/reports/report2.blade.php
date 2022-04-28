@extends('backend.layouts.master')
@section('content')
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-tshirt-crew"></i>
            </span> รายงานการเช่า
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
                    <button type="button" id="search2" class="btn btn-gradient-primary mb-2">ค้นหา</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12 grid-margin stretch-card d-none" id="report2">
        <div class="card">
            <div class="card-body">
                <table id="reports2" class="table dataTable">
                    <thead>
                        <tr>
                            <th>เลขที่เช่า</th>
                            <th>สถานะ</th>
                            <th>วันที่เช่า</th>
                            <th>วันที่คืน</th>
                            <th>ชื่อ-นามสกุล</th>
                            <th>ค่าปรับ</th>
                            <th width="15%">ยอดชำระ</th>
                        </tr>
                    </thead>
                    <tbody id="report-tr">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
