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
                        <a href="{{ url('/anggota') }}">Anggota</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/anggota') }}">Daftar Anggota</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('anggota.create') }}">Tambah Barang</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex">
                                <div class="p-2"><h4 class="card-title">{{ $form }}</h4></div>
                            </div>
                        </div>
                        <div class="card-body">
                                @if($form == "add")
                                     <form action="{{ route('anggota.store') }}" method="post">
                                @else
                                    <form action="{{ url('/anggota/data/edit/'.@$result->id_anggota)  }} " method="post">
                                        @endif
                                    @csrf
                                <div class="d-flex justify-content-between">

                                    <div class="col-md-12">
                                        <div class="form-group row">
                                                {{ Form::label('nm_anggota','Nama Angggota',['class'=>'col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-left']) }}
                                                <div class="col-lg-5 col-md-9 col-sm-8">
                                                    {{ Form::text('nama_anggota',@$result->nama_anggota,['class'=>'form-control','required']) }}
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                            {{ Form::label('lbl_harga','alamat',['class'=>'col-lg-3 col-md-3 col-sm-4 mt-sm-2 text-left']) }}
                                            <div class="col-lg-3 col-md-9 col-sm-8">
                                                {{ Form::text('alamat',@$result->alamat,['class'=>'form-control','required']) }}
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
