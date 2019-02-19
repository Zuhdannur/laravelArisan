@extends('layouts.layout')

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
                        <a href="#">Pendapatan</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Daftar Pendapatan</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex">
                                <div class="p-2"><h4 class="card-title">Pendapatan</h4></div>
                                <div class="ml-auto p-2"><a href="{{ route('pendapatan.create') }}" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;<span class="btn-label">Tambah Data</span></a></div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="pendapatan" class="display table table-striped table-hover" >
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Pendapatan</th>
                                        <th>Jumlah Item</th>
                                        <th>Tanggal</th>
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
        $(document).ready(function () {
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
                                url:'/pendapatan/'+form,
                                data:{
                                    _method: 'delete'
                                },
                                success:function(data){
                                    console.log(data);

                                    tbl.reload.ajax();
                                }
                            })
                        }
                    });
            });
            $('#pendapatan').DataTable({
                "ordering": false,
                deferRender: true,
                serverSide: true,
                processing: true,
                orderMulti: true,
                stateSave: true,
                ajax: {
                    url: '{!! url('/pendapatan/data/getData') !!}',
                    type: 'GET',
                    data: function (e) {
                        return e;
                    }
                }
            });
        });
    </script>
@endpush
