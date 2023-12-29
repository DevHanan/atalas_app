@extends('admin.layouts.master')
@section('title', 'عرض  الطلبات')
@section('content')

<!-- Start Content-->
<style>
   .list-group-item.active {
    background: #ffc107;
}
/* end common class */
.top-status ul {
    list-style: none;
    display: flex;
    justify-content: space-around;
    justify-content: center;
    flex-wrap: wrap;
    padding: 0;
    margin: 0;
}
.top-status ul li {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    background: #fff;
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
    border: 8px solid #ddd;
    box-shadow: 1px 1px 10px 1px #ddd inset;
    margin: 10px 5px;
}
.top-status ul li.active {
    border-color: #ffc107;
    box-shadow: 1px 1px 20px 1px #ffc107 inset;
}
/* end top status */

ul.timeline {
    list-style-type: none;
    position: relative;
}
ul.timeline:before {
    content: ' ';
    background: #d4d9df;
    display: inline-block;
    position: absolute;
    left: 29px;
    width: 2px;
    height: 100%;
    z-index: 400;
}
ul.timeline > li {
    margin: 20px 0;
    padding-left: 30px;
}
ul.timeline > li:before {
    content: '\2713';
    background: #fff;
    display: inline-block;
    position: absolute;
    border-radius: 50%;
    border: 0;
    left: 5px;
    width: 50px;
    height: 50px;
    z-index: 400;
    text-align: center;
    line-height: 50px;
    color: #d4d9df;
    font-size: 24px;
    border: 2px solid #d4d9df;
}
ul.timeline > li.active:before {
    content: '\2713';
    background: #28a745;
    display: inline-block;
    position: absolute;
    border-radius: 50%;
    border: 0;
    left: 5px;
    width: 50px;
    height: 50px;
    z-index: 400;
    text-align: center;
    line-height: 50px;
    color: #fff;
    font-size: 30px;
    border: 2px solid #28a745;
}
/* end timeline */
</style>
<div class="main-body">
    <div class="page-wrapper">
        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5> عرض  تفاصيل الطلب</h5>
                    </div>
                   

                </div>
            </div>

            <div class="col-sm-12">
                <div class="card">
                    <div class="card-block">
                        <!-- [ Data table ] start -->
                        
                        <section class="my-5">
        <div class="container">
            <div class="main-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="Admin"
                                        class="rounded-circle p-1 bg-warning" width="110">
                                    <div class="mt-3">
                                        <h4>{{ optional($row->client)->name }}</h4>
                                        <p class="text-secondary mb-1">{{ optional($row->client)->email }}</p>
                                        <p class="text-muted font-size-sm">{{ optional($row->client)->phone }}</p>
                                    </div>
                                </div>
                                <!-- <div class="list-group list-group-flush text-center mt-4">
                                    <a href="#" class="list-group-item list-group-item-action border-0 active">
                                        Profile Informaton
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action border-0">Orders</a>
                                    <a href="#" class="list-group-item list-group-item-action border-0">Address Book</a>
                                    <a href="#" class="list-group-item list-group-item-action border-0">Settings</a>
                                    <a href="#" class="list-group-item list-group-item-action border-0">Logout</a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="top-status">
                                    <h5>رقم الطلب# {{  $row->id }}</h5>
                                    <h5>حالة الطلب# {{  $row->statusLabel }}</h5>

                                   
                                </div>
                            </div>
                        </div>
                        <div class="card mt-4">
                            <div class="card-body p-0 table-responsive">
                                <h4 class="p-3 mb-0">المنتجات</h4>
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">المنتج</th>
                                            <th scope="col">الكمية</th>
                                            <th scope="col">السعر</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($row->products as $item)
                                        <tr>
                                            
                                            <td>
                                                <img src="{{asset( optional($item->product)->main_img)}}"
                                                    alt="product" class="" width="80">
                                                    <p>  {{ optional($item->product)->name }}</p>
                                            </td>
                                            <td>{{ $item->quantity}}</td>
                                            <td><strong> {{ $item->price }}</strong></td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            
                                            <td>
                                                <span class="text-muted">الإجمالى</span>
                                                <strong>{{ $row->total }}</strong>
                                            </td>
                                            <td>
                                                <span class="text-muted">المدفوع</span>
                                                <strong>{{ $row->paid }}</strong>
                                            </td>
                                            <td>
                                                <span class="text-muted">المتبقى</span>
                                                <strong>{{ $row->remainig_payment }}</strong>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- <div class="card mt-4">
                            <div class="card-body">
                                <h4>Timeline</h4>
                                    <ul class="timeline">
                                        <li class="active">
                                            <h6>PICKED</h6>
                                            <p class="mb-0 text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque Lorem ipsum dolor</p>
                                            <o class="text-muted">21 March, 2014</p>
                                        </li>
                                        <li>
                                            <h6>PICKED</h6>
                                            <p class="mb-0 text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque</p>
                                            <o class="text-muted">21 March, 2014</p>
                                        </li>
                                        <li>
                                            <h6>PICKED</h6>
                                            <p class="mb-0 text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque</p>
                                            <o class="text-muted">21 March, 2014</p>
                                        </li>
                                        <li>
                                            <h6>PICKED</h6>
                                            <p class="mb-0 text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque</p>
                                            <o class="text-muted">21 March, 2014</p>
                                        </li>
                                        <li>
                                            <h6>PICKED</h6>
                                            <p class="mb-0 text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque</p>
                                            <o class="text-muted">21 March, 2014</p>
                                        </li>
                                    </ul>
                            </div>
                        </div> -->

                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>
</div>
            </div>
        </div>
    </div>
</div>
<!-- End Content-->

@endsection