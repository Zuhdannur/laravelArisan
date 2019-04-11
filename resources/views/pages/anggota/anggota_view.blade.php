@extends('layouts.layout')
@section('extars-css')
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                        <a href="{{ url('/anggota') }}">anggota</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/anggota') }}">Daftar Anggota</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex">
                                <div class="p-2"><h4 class="card-title">Anggota</h4></div>
                                <div class="ml-auto p-2"><a href="{{ route('anggota.create') }}" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;<span class="btn-label">Tambah Data</span></a></div>
                                <div class=" p-2"><a href="{{ url('/anggota/data/random') }}" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;<span class="btn-label">Kocok arisan</span></a></div>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="anggota" class="display table table-striped table-hover" >
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th style="width: 40%;">Nama Anggota</th>
                                        <th style="width: 20%;">Alamat</th>
                                        <th>status bayar</th>
                                        <th>status menang</th>
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
    <script src="{{ asset('assets') }}/js/plugin/sweetalert/sweetalert.min.js"></script>
    <script>
        // $(document).ready(function () {
        //
        // });
        jQuery(function ($) {
            var tbl;
            jQuery.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('body').on('click','.hapus',function(e){
                e.preventDefault();
                var form = $(this).parent().find('input[type=text]').val();
                swal({
                    title: "Anda Yakin?",
                    text: "Menghapus Data",
                    icon: "warning",
                    buttons: {
                        confirm: {
                            text: "Hapus",
                            value: true,
                            visible: true,
                            className: "btn-danger",
                            closeModal: true
                        },
                        cancel: {
                            text: "Batal",
                            value: null,
                            visible: true,
                            className: "",
                            closeModal: true,
                        }
                    }
                })
                    .then((isConfirm) => {
                        if (isConfirm) {
                            $.ajax({
                                type:'POST',
                                url:'/anggota/'+form,
                                data:{
                                    _method: 'delete'
                                },
                                success:function(data){
                                    console.log(data);
                                    tbl.ajax.reload();
                                }
                            })
                        }
                    });
            });
            $('body').on('click','.bayar',function(e){
                e.preventDefault();
                var form = $(this).parent().find('input[type=text]').val();
                swal({
                    title: "Anda Yakin Akan Membayar?",
                    text: "Menghapus Data",
                    icon: "success",
                    buttons: {
                        confirm: {
                            text: "Bayar",
                            value: true,
                            visible: true,
                            className: "btn-success",
                            closeModal: true
                        },
                        cancel: {
                            text: "Batal",
                            value: null,
                            visible: true,
                            className: "",
                            closeModal: true,
                        }
                    }
                })
                    .then((isConfirm) => {
                        if (isConfirm) {
                            $.ajax({
                                type:'POST',
                                url:'/anggota/data/bayar/'+form,
                                data:{
                                    _method: 'POST'
                                },
                                success:function(data){
                                    console.log(data);
                                    tbl.ajax.reload();
                                }
                            })
                        }
                    });
            });
            //anggota/data/getData
            tbl =  $('#anggota').DataTable({
                "ordering": false,
                deferRender: true,
                serverSide: true,
                processing: true,
                orderMulti: true,
                stateSave: true,
                ajax: {
                    url: '{!! url('/anggota/data/getData') !!}',
                    type: 'GET',
                    data: function (e) {
                        return e;
                    }
                },
                "fnRowCallback" : function (nRow,aData,index) {
                    if(aData[4] === "sudah menang"){
                        $('td',nRow).css('background-color','Red');
                        $('td',nRow).css('color','White');
                    }

                },
            });
        });
    </script>
@endpush
