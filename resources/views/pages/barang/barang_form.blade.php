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
                        <a href="{{ url('/barang') }}">Daftar Pendapatan</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('barang.create') }}">Tambah Barang</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex">
                                <div class="p-2"><h4 class="card-title">Tambah</h4></div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('barang.store') }}" method="post">
                                @csrf
                                <div class="d-flex justify-content-between">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                                {{ Form::label('lbl_barang','Nama Barang',['class'=>'col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-left']) }}
                                                <div class="col-lg-5 col-md-9 col-sm-8">
                                                    {{ Form::text('nama_barang',@$result->nama_barang,['class'=>'form-control','required']) }}
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                            {{ Form::label('lbl_harga','Harga Barang',['class'=>'col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-left']) }}
                                            <div class="col-lg-3 col-md-9 col-sm-8">
                                                {{ Form::number('harga',@$result->harga,['class'=>'form-control','required']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <div class="p-2" style="margin-top: 1%;"><button type="submit" class="btn btn-success">Simpan</button></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('extras-js')
    <script src="{{ asset('assets') }}/js/plugin/jquery.validate/jquery.validate.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugin/jquery.repeater.js"></script>
    <script src="{{ asset('assets') }}/js/plugin/sweetalert/sweetalert.min.js"></script>
    <script>
        $(document).ready(function () {
        });
    </script>
@endpush
