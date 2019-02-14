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
                        <a href="{{ url('/pengeluaran') }}">Pengeluaran</a>
                    </li>
                    <li class="separator">
                        <i class="flaticon-right-arrow"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Daftar Pengeluaran</a>
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
                            <form action="{{ route('pengeluaran.store') }}" id="input_pendapatan">
                                <div class="repeater">
                                    <div data-repeater-list="data">
                                        <div data-repeater-item class="col-md-12 row">
                                            <div class="form-group col-md-5">
                                                <label for="MACOA">Nama Barang</label>
                                                {{-- <div class="select2-input">
                                                    <select class="form-control select2_jenis_administrasi"
                                                            name="jenis_administrasi" onchange="setBiaya(this)"
                                                             required>
                                                        @foreach($barang as $value)
                                                        <option value="{{ $value->id_barang}}">{{ $value->nama_barang }}</option>
                                                            @endforeach
                                                    </select>

                                                </div> --}}
                                                <input type="text" class="form-control biaya" name="biaya"
                                                       placeholder="Ex. Kegiatan,Barang"  required>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="deskripsi">Harga</label>
                                                <input type="text" class="form-control biaya" name="biaya"
                                                       onkeyup="setSubtotal(this)"
                                                       placeholder=""  required readonly>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="MACOA">Total Terjual</label>
                                                <input type="text" class="form-control jumlah" name="jumlah"
                                                       onkeyup="setSubtotal(this)"  required>
                                            </div>
                                            <div class="form-group col-md-2">
                                                <label for="biaya">Sub Total</label>
                                                <input type="text" class="form-control subtotal" name="subtotal"
                                                       value="{{@$uang}}" placeholder="" readonly>
                                            </div>
                                            <div class="form-group col-md-1" style="margin-top: 0.8%;"><br>
                                                <button data-repeater-delete type="button"
                                                        class="btn btn-danger"
                                                         onclick="deleteBiaya(this)"><i
                                                            class="fa fa-trash"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <button data-repeater-create type="button"
                                            class="btn btn-info ml-2 my-2" ><i
                                                class="fa fa-plus"></i></button>
                                </div>
                                <div class="d-flex justify-content-end">
                                    <div class="p-2" style="margin-top: 1%;">Total Pendapatan</div>
                                    <div class="p-2"><input type="text" class="form-control"></div>
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
            repeater = $('.repeater').repeater({
                show: function () {
                    $(this).slideDown();
                    var json = JSON.stringify($(this).repeaterVal());
                    list = $('.select2_jenis_administrasi').select2({
                        theme: "bootstrap",
                        placeholder: "[ Pilih Item ]"
                    });

                },
                hide: function (remove) {
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
                                var json = JSON.stringify($(this).repeaterVal());
                                var obj = JSON.parse(json);
                                $.each(obj.data, function (i, item) {
                                    console.log(item['subtotal']);
                                    totalPembayaran -= Number(item['subtotal']);
                                    $('#totalPembayaran').val(totalPembayaran);
                                });
                                console.log();
                                $(this).slideUp(remove);
                            }
                        })
                },
            });


            $("#input_pendapatan").validate({
                rules: {
                    confirmpassword: {
                        equalTo: "#password"
                    }
                },
                highlight: function(element) {
                    $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
                },
                success: function(element) {
                    $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
                },
            });
        });
    </script>
@endpush
