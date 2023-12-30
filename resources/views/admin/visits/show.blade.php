@extends('admin.layouts.master')
@section('title', 'عرض الزيارات')
@section('content')

<!-- Start Content-->
<style>
    .steps.clearfix {
        display: none;
    }
</style>
<div class="main-body">
    <div class="page-wrapper">
        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5> عرض تفاصيل الزيارة</h5>
                    </div>


                </div>
            </div>

            <div class="col-sm-12">
                <div class="card">
                    <div class="card-block">
                        <!-- [ Data table ] start -->
                        <div class="table-responsive">
                            <table id="" class="display table nowrap table-striped table-hover" style="widtd:100%">
                                <tbody>
                                    <tr>

                                        <td>كود الزيارة </td>
                                        <td>{{ $row->code }}</td>
                                    </tr>
                                    <tr>

                                        <td>تاريخ </td>
                                        <td>{{ $row->visit_date }}</td>
                                    </tr>
                                    <tr>
                                        <td>وقت الزيارة</td>
                                        <td>{{ $row->visit_time }}</td>

                                    </tr>
                                    <tr>
                                        <td>العميل</td>
                                        <td>{{ optional($row->client)->name }}</td>

                                    </tr>
                                    <tr>
                                        <td>المندوب</td>
                                        <td>{{ optional($row->sale)->name }}</td>

                                    </tr>
                                    <tr>
                                        <td>تقرير الزيارة</td>
                                        <td>{{ $row->report }}</td>

                                    </tr>
                                    <tr>
                                        <td>الحالة</td>
                                        <td>{{ $row->statusLabel }}</td>

                                    </tr>
                                    <tr>
                                        <td>موقع الزيارة</td>
                                    </tr>
                                  

                                </tbody>
                            </table>
                        </div>
                        <!-- [ Data table ] end -->
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</div>
<!-- End Content-->

@endsection