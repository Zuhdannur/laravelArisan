@extends('layouts.layout')

@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="pb-2 mt-4 mb-2">
                <ul class="breadcrumbs">
                    <li class="nav-home">
                        <a href="{{ url("/") }}">
                            <i class="flaticon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/barang') }}">Barang</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/barang') }}">Daftar Barang</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex">
                                <div class="p-2"><h4 class="card-title">Barang</h4></div>
                                <div class="ml-auto p-2"><a href="{{ route('barang.create') }}" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;<span class="btn-label">Tambah Data</span></a></div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="barang" class="display table table-striped table-hover" >
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Harga</th>
                                        <th>status</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('extras-js')
    <script src="{{ asset('assets') }}/js/plugin/datatables/datatables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#barang').DataTable({});
        });
    </script>
@endpush
