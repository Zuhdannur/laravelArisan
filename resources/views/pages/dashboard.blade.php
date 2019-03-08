@extends('layouts.layout')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="content">
        <div class="panel-header bg-secondary-gradient">
            @if(Auth::user()->email_verified_at == '')
            <div class="alert alert-danger" role="alert">
                <div class="d-flex align-items-center">
                    <div>Tolong Verifikasi Akun Anda</div>
                    <a class="btn btn-sm btn-success" style="margin-left: 2%;" href="{{ route('profile.index') }}">verify</a>
                </div>
            </div>
            @endif
            <div class="page-inner pt-5 pb-5">
                <h2 class="text-white pb-2">Welcome back {{ Auth::user()->name }}</h2>
                @if($value != '')
                <h5 class="text-white op-7 mb-2">{{ @$value->nama_toko }}</h5>
                    @else
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalLong">
                        Buka Toko
                    </button>
                    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Buka Toko</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ url('/dashboard') }}" method="post">
                                    @csrf
                                <div class="modal-body">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Nama Toko</label>
                                            <input type="text" class="form-control" name="nama_toko" placeholder="Masukkan Nama toko">
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Alamat Toko</label>
                                            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukan Alamat">
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Jenis Usaha</label>
                                            <input type="text" class="form-control" id="alamat" name="jenis"  placeholder="Jenis Usaha ex.Makanan,Barang dll">
                                        </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif

            </div>
        </div>

        @if($value != '')
        <div class="page-inner mt--5">
            <div class="row row-card-no-pd mt--2">
                <div class="col">
                    <div id="chart-container">
                        <canvas id="LineChart"></canvas>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Jadwal</div>
                        </div>
                        <div class="card-body">
                            @if(count($jadwal) > 0)
                            <ol class="activity-feed">
                                @php
                                $class = array("feed-item-success","feed-item-secondary","feed-item-info","feed-item-warning","feed-item-danger"
                                )
                                @endphp
                                @foreach($jadwal as $key=>$value)
                                <li class="feed-item {{ $class[$key] }}">
                                    <time class="date" datetime="9-25">{{\Carbon\Carbon::parse($value->start)->format('M d')}}</time>
                                    <span class="text">{{ $value->title }}</span><br>
                                    <a href="#">{{ $value->description }}</a>
                                </li>
                                @endforeach
                            </ol>
                                @else
                                <p>BELUM PUNYA JADWAL</p>
                                @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <div class="card-title">Penjualan Bulan Ini</div>
                            <div class="card-category">March 25 - April 02</div>
                        </div>
                        <div class="card-body pb-0">
                            <div class="mb-4 mt-2">
                                <h1>Rp {{ @$uang }}</h1>
                            </div>
                            <div class="pull-in">
                                <canvas id="dailySalesChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="card card-primary bg-primary-gradient">
                        <div class="card-body">
                            <h4 class="mb-1 fw-bold">Invitation Code</h4>
                            @if(@$value->invitation_code != "")
                            <div id="task-complete" ><h4 class="display-4">{{ @$value->invitation_code  }}</h4></div>
                                @else
                                <form action="{{ url('/data/code') }}" method="post">
                                    @csrf
                                <button type="submit" class="btn btn-primary" id="btnKode">
                                    Generate Kode
                                </button>
                                </form>
                                @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body pb-0">
                            <div class="h1 fw-bold float-right text-primary">+0%</div>
                            <h2 class="mb-2">Rp {{ @$pendapatan }},-</h2>
                            <p class="text-muted">Pendapatan Bulanan</p>
                            <div class="pull-in sparkline-fix">
                                <div id="lineChart"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body pb-0">
                            <div class="h1 fw-bold float-right text-danger">-3%</div>
                            <h2 class="mb-2">Rp {{@$pengeluaran }},-</h2>
                            <p class="text-muted">Pengeluaran Bulanan</p>
                            <div class="pull-in sparkline-fix">
                                <div id="lineChart2"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body pb-0">
                            <div class="h1 fw-bold float-right text-warning">+0%</div>
                            <h2 class="mb-2">{{ @$jml }}</h2>
                            <p class="text-muted">Transactions</p>
                            <div class="pull-in sparkline-fix">
                                <div id="lineChart3"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-card-no-pd">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <h4 class="card-title">Users Geolocation</h4>
                                <div class="card-tools">
                                    <button class="btn btn-icon btn-link btn-primary btn-xs"><span
                                                class="fa fa-angle-down"></span></button>
                                    <button class="btn btn-icon btn-link btn-primary btn-xs btn-refresh-card"><span
                                                class="fa fa-sync-alt"></span></button>
                                    <button class="btn btn-icon btn-link btn-primary btn-xs"><span
                                                class="fa fa-times"></span></button>
                                </div>
                            </div>
                            <p class="card-category">
                                Map of the distribution of users around the world</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="table-responsive table-hover table-sales">
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <div class="flag">
                                                        <img src="https://via.placeholder.com/16x11" alt="indonesia">
                                                    </div>
                                                </td>
                                                <td>Indonesia</td>
                                                <td class="text-right">
                                                    2.320
                                                </td>
                                                <td class="text-right">
                                                    42.18%
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="flag">
                                                        <img src="https://via.placeholder.com/16x11"
                                                             alt="united states">
                                                    </div>
                                                </td>
                                                <td>USA</td>
                                                <td class="text-right">
                                                    240
                                                </td>
                                                <td class="text-right">
                                                    4.36%
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="flag">
                                                        <img src="https://via.placeholder.com/16x11" alt="australia">
                                                    </div>
                                                </td>
                                                <td>Australia</td>
                                                <td class="text-right">
                                                    119
                                                </td>
                                                <td class="text-right">
                                                    2.16%
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="flag">
                                                        <img src="https://via.placeholder.com/16x11" alt="russia">
                                                    </div>
                                                </td>
                                                <td>Russia</td>
                                                <td class="text-right">
                                                    1.081
                                                </td>
                                                <td class="text-right">
                                                    19.65%
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="flag">
                                                        <img src="https://via.placeholder.com/16x11" alt="china">
                                                    </div>
                                                </td>
                                                <td>China</td>
                                                <td class="text-right">
                                                    1.100
                                                </td>
                                                <td class="text-right">
                                                    20%
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="flag">
                                                        <img src="https://via.placeholder.com/16x11" alt="brazil">
                                                    </div>
                                                </td>
                                                <td>Brasil</td>
                                                <td class="text-right">
                                                    640
                                                </td>
                                                <td class="text-right">
                                                    11.63%
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mapcontainer">
                                        <div id="map-example" class="vmap"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Top Products</div>
                        </div>
                        <div class="card-body pb-0">
                            <div class="d-flex">
                                <div class="avatar">
                                    <img src="https://via.placeholder.com/48x48" alt="..."
                                         class="avatar-img rounded-circle">
                                </div>
                                <div class="flex-1 pt-1 ml-2">
                                    <h6 class="fw-bold mb-1">CSS</h6>
                                    <small class="text-muted">Cascading Style Sheets</small>
                                </div>
                                <div class="d-flex ml-auto align-items-center">
                                    <h3 class="text-info fw-bold">+$17</h3>
                                </div>
                            </div>
                            <div class="separator-dashed"></div>
                            <div class="d-flex">
                                <div class="avatar">
                                    <img src="https://via.placeholder.com/48x48" alt="..."
                                         class="avatar-img rounded-circle">
                                </div>
                                <div class="flex-1 pt-1 ml-2">
                                    <h6 class="fw-bold mb-1">J.CO Donuts</h6>
                                    <small class="text-muted">The Best Donuts</small>
                                </div>
                                <div class="d-flex ml-auto align-items-center">
                                    <h3 class="text-info fw-bold">+$300</h3>
                                </div>
                            </div>
                            <div class="separator-dashed"></div>
                            <div class="d-flex">
                                <div class="avatar">
                                    <img src="https://via.placeholder.com/48x48" alt="..."
                                         class="avatar-img rounded-circle">
                                </div>
                                <div class="flex-1 pt-1 ml-2">
                                    <h6 class="fw-bold mb-1">Ready Pro</h6>
                                    <small class="text-muted">Bootstrap 4 Admin Dashboard</small>
                                </div>
                                <div class="d-flex ml-auto align-items-center">
                                    <h3 class="text-info fw-bold">+$350</h3>
                                </div>
                            </div>
                            <div class="separator-dashed"></div>
                            <div class="pull-in">
                                <canvas id="topProductsChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title fw-mediumbold">Suggested People</div>
                            <div class="card-list">
                                <div class="item-list">
                                    <div class="avatar">
                                        <img src="https://via.placeholder.com/50x50" alt="..."
                                             class="avatar-img rounded-circle">
                                    </div>
                                    <div class="info-user ml-3">
                                        <div class="username">Jimmy Denis</div>
                                        <div class="status">Graphic Designer</div>
                                    </div>
                                    <button class="btn btn-icon btn-primary btn-round btn-xs">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                                <div class="item-list">
                                    <div class="avatar">
                                        <img src="https://via.placeholder.com/50x50" alt="..."
                                             class="avatar-img rounded-circle">
                                    </div>
                                    <div class="info-user ml-3">
                                        <div class="username">Chad</div>
                                        <div class="status">CEO Zeleaf</div>
                                    </div>
                                    <button class="btn btn-icon btn-primary btn-round btn-xs">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                                <div class="item-list">
                                    <div class="avatar">
                                        <img src="https://via.placeholder.com/50x50" alt="..."
                                             class="avatar-img rounded-circle">
                                    </div>
                                    <div class="info-user ml-3">
                                        <div class="username">Talha</div>
                                        <div class="status">Front End Designer</div>
                                    </div>
                                    <button class="btn btn-icon btn-primary btn-round btn-xs">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                                <div class="item-list">
                                    <div class="avatar">
                                        <img src="https://via.placeholder.com/50x50" alt="..."
                                             class="avatar-img rounded-circle">
                                    </div>
                                    <div class="info-user ml-3">
                                        <div class="username">John Doe</div>
                                        <div class="status">Back End Developer</div>
                                    </div>
                                    <button class="btn btn-icon btn-primary btn-round btn-xs">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                                <div class="item-list">
                                    <div class="avatar">
                                        <img src="https://via.placeholder.com/50x50" alt="..."
                                             class="avatar-img rounded-circle">
                                    </div>
                                    <div class="info-user ml-3">
                                        <div class="username">Talha</div>
                                        <div class="status">Front End Designer</div>
                                    </div>
                                    <button class="btn btn-icon btn-primary btn-round btn-xs">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                                <div class="item-list">
                                    <div class="avatar">
                                        <img src="https://via.placeholder.com/50x50" alt="..."
                                             class="avatar-img rounded-circle">
                                    </div>
                                    <div class="info-user ml-3">
                                        <div class="username">Jimmy Denis</div>
                                        <div class="status">Graphic Designer</div>
                                    </div>
                                    <button class="btn btn-icon btn-primary btn-round btn-xs">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card card-primary bg-primary-gradient">
                        <div class="card-body">
                            <h4 class="mt-3 b-b1 pb-2 mb-4 fw-bold">Active user right now</h4>
                            <h1 class="mb-4 fw-bold">17</h1>
                            <h4 class="mt-3 b-b1 pb-2 mb-5 fw-bold">Page view per minutes</h4>
                            <div id="activeUsersChart"></div>
                            <h4 class="mt-5 pb-3 mb-0 fw-bold">Top active pages</h4>
                            <ul class="list-unstyled">
                                <li class="d-flex justify-content-between pb-1 pt-1">
                                    <small>/product/readypro/index.html</small>
                                    <span>7</span></li>
                                <li class="d-flex justify-content-between pb-1 pt-1">
                                    <small>/product/Millenium/demo.html</small>
                                    <span>10</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Feed Activity</div>
                        </div>
                        <div class="card-body">
                            <ol class="activity-feed">
                                <li class="feed-item feed-item-secondary">
                                    <time class="date" datetime="9-25">Sep 25</time>
                                    <span class="text">Responded to need <a href="#">"Volunteer opportunity"</a></span>
                                </li>
                                <li class="feed-item feed-item-success">
                                    <time class="date" datetime="9-24">Sep 24</time>
                                    <span class="text">Added an interest <a href="#">"Volunteer Activities"</a></span>
                                </li>
                                <li class="feed-item feed-item-info">
                                    <time class="date" datetime="9-23">Sep 23</time>
                                    <span class="text">Joined the group <a
                                                href="single-group.php">"Boardsmanship Forum"</a></span>
                                </li>
                                <li class="feed-item feed-item-warning">
                                    <time class="date" datetime="9-21">Sep 21</time>
                                    <span class="text">Responded to need <a href="#">"In-Kind Opportunity"</a></span>
                                </li>
                                <li class="feed-item feed-item-danger">
                                    <time class="date" datetime="9-18">Sep 18</time>
                                    <span class="text">Created need <a href="#">"Volunteer Opportunity"</a></span>
                                </li>
                                <li class="feed-item">
                                    <time class="date" datetime="9-17">Sep 17</time>
                                    <span class="text">Attending the event <a
                                                href="single-event.php">"Some New Event"</a></span>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Support Tickets</div>
                                <div class="card-tools">
                                    <ul class="nav nav-pills nav-secondary nav-pills-no-bd nav-sm" id="pills-tab"
                                        role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-today" data-toggle="pill" href="#pills-today"
                                               role="tab" aria-selected="true">Today</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link active" id="pills-week" data-toggle="pill"
                                               href="#pills-week" role="tab" aria-selected="false">Week</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="pills-month" data-toggle="pill" href="#pills-month"
                                               role="tab" aria-selected="false">Month</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="avatar avatar-online">
                                    <span class="avatar-title rounded-circle border border-white bg-info">J</span>
                                </div>
                                <div class="flex-1 ml-3 pt-1">
                                    <h6 class="text-uppercase fw-bold mb-1">Joko Subianto <span
                                                class="text-warning pl-3">pending</span></h6>
                                    <span class="text-muted">I am facing some trouble with my viewport. When i start my</span>
                                </div>
                                <div class="float-right pt-1">
                                    <small class="text-muted">8:40 PM</small>
                                </div>
                            </div>
                            <div class="separator-dashed"></div>
                            <div class="d-flex">
                                <div class="avatar avatar-offline">
                                    <span class="avatar-title rounded-circle border border-white bg-secondary">P</span>
                                </div>
                                <div class="flex-1 ml-3 pt-1">
                                    <h6 class="text-uppercase fw-bold mb-1">Prabowo Widodo <span
                                                class="text-success pl-3">open</span></h6>
                                    <span class="text-muted">I have some query regarding the license issue.</span>
                                </div>
                                <div class="float-right pt-1">
                                    <small class="text-muted">1 Day Ago</small>
                                </div>
                            </div>
                            <div class="separator-dashed"></div>
                            <div class="d-flex">
                                <div class="avatar avatar-away">
                                    <span class="avatar-title rounded-circle border border-white bg-danger">L</span>
                                </div>
                                <div class="flex-1 ml-3 pt-1">
                                    <h6 class="text-uppercase fw-bold mb-1">Lee Chong Wei <span class="text-muted pl-3">closed</span>
                                    </h6>
                                    <span class="text-muted">Is there any update plan for RTL version near future?</span>
                                </div>
                                <div class="float-right pt-1">
                                    <small class="text-muted">2 Days Ago</small>
                                </div>
                            </div>
                            <div class="separator-dashed"></div>
                            <div class="d-flex">
                                <div class="avatar avatar-offline">
                                    <span class="avatar-title rounded-circle border border-white bg-secondary">P</span>
                                </div>
                                <div class="flex-1 ml-3 pt-1">
                                    <h6 class="text-uppercase fw-bold mb-1">Peter Parker <span
                                                class="text-success pl-3">open</span></h6>
                                    <span class="text-muted">I have some query regarding the license issue.</span>
                                </div>
                                <div class="float-right pt-1">
                                    <small class="text-muted">2 Day Ago</small>
                                </div>
                            </div>
                            <div class="separator-dashed"></div>
                            <div class="d-flex">
                                <div class="avatar avatar-away">
                                    <span class="avatar-title rounded-circle border border-white bg-danger">L</span>
                                </div>
                                <div class="flex-1 ml-3 pt-1">
                                    <h6 class="text-uppercase fw-bold mb-1">Logan Paul <span class="text-muted pl-3">closed</span>
                                    </h6>
                                    <span class="text-muted">Is there any update plan for RTL version near future?</span>
                                </div>
                                <div class="float-right pt-1">
                                    <small class="text-muted">2 Days Ago</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            @endif
    </div>
@endsection
@push('extras-js')
    <script src="{{ asset('assets') }}/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugin/chart.js/chart.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugin/sweetalert/sweetalert.min.js"></script>
    <script>
        $(document).ready(function () {

            var lineChart = document.getElementById('LineChart').getContext('2d');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var myLineChart = new Chart(lineChart, {
                type: 'line',
                data: {
                    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                    datasets: [{
                        label: "Statistik Keuangan",
                        borderColor: "#1d7af3",
                        pointBorderColor: "#FFF",
                        pointBackgroundColor: "#1d7af3",
                        pointBorderWidth: 2,
                        pointHoverRadius: 4,
                        pointHoverBorderWidth: 1,
                        pointRadius: 4,
                        backgroundColor: 'transparent',
                        fill: true,
                        borderWidth: 2,
                        data: [542, 480, 430, 550, 530, 453, 380, 434, 568, 610, 700, 900]
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 10,
                            fontColor: '#1d7af3',
                        }
                    },
                    tooltips: {
                        bodySpacing: 4,
                        mode: "nearest",
                        intersect: 0,
                        position: "nearest",
                        xPadding: 10,
                        yPadding: 10,
                        caretPadding: 10
                    },
                    layout: {
                        padding: {left: 15, right: 15, top: 15, bottom: 15}
                    }
                }
            });

            $.notify({
                icon: "add_alert",
                message: "Welcome {!! Auth::user()->name; !!}"

            }, {
                type: 'success',
                timer: 4000,
                placement: {
                    from: 'top',
                    align: 'right'
                }
            });

        });
    </script>
@endpush