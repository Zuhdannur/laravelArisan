<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Toko;
use App\Barang;
use Carbon\Carbon;
use App\Transaksi;
use App\DetailTransaksi;
use Illuminate\Support\Facades\Auth;
class ApiPegawaiController extends Controller
{
    public function get_token(Request $request)
    {
        $getValue = User::where('email', $request->email)->get();
        if (count($getValue) > 0) {
            foreach ($getValue as $item) {
                if (hash::check($request->password, $item->password)) {
                    $getValue->makeVisible(['remember_token']);
                    $data['token'] = $item->remember_token;
                    $data['message'] = 'success';
                    return response()->json($data);
                } else {
                    $data['message'] = 'wrong password';
                }
            }
        } else {
            $data['message'] = $request->email;
        }
        return $data;


    }

    public function get_profile(Request $request)
    {
        $data['data'] = User::where('remember_token', $request->token)->first();
        $data['toko'] = Toko::where('id_user', $data['data']->id)->first();
        $data['barang'] = Barang::where('id_toko', $data['toko']->id_usaha)->get();
        $data['pendapatan'] = Transaksi::where([['id_toko', $data['toko']->id_usaha], ['tgl', $date = Carbon::today()->toDateString()]])->get();
        $id_transaksi = 0;
        foreach ($data['pendapatan'] as $value) {
            $id_transaksi = $value->id_transaksi;
        }
        if ($data['data'] != '') {
            $data['message'] = "success";
        } else {
            $data['message'] = "failuer";
        }
        return $data;
    }

    public function get_detail_transaksi(Request $request)
    {
        $data['data'] = DetailTransaksi::where('id_transaksi', $request->id_transaksi)->get();
        foreach ($data['data'] as $key => $value) {
            $search = Barang::where('id_barang', $value['nama_barang'])->first();
            if ($search != "") {
                $data['data'][$key]['nama_barang'] = $search['nama_barang'];
            } else {

            }
        }
        if (count($data['data']) > 0) {
            $data['message'] = "success";
        } else {
            $data['message'] = "success";
        }
        return response()->json($data);
    }

    public function register(Request $request)
    {
        $insert = new User;
        $insert->name = $request->name;
        $insert->email = $request->email;
        $insert->password = Hash::make($request->password);
        $insert->type = $request->type;
        $data['token'] = bin2hex(random_bytes(16));
        $insert->remember_token =  $data['token'];
        $insert->save();
        $data['message'] = "success";
        return response()->json($data);
    }

    public function getDetailPendapatan($id){
        $data['data'] = User::where('remember_token',$id)->first();
        $data['toko'] = Toko::where('id_user', $data['data']->id)->first();
        $data['data'] = Transaksi::where([['id_toko',$data['toko']->id_usaha],['pendapatan','!=',0]])->first();
        if($data['data'] != null){
            $data['pendapatan'] = DetailTransaksi::where('id_transaksi',$data['data']->id_transaksi)->get();
            foreach ($data['pendapatan'] as $key => $value) {
              $search = Barang::where('id_barang', $value['nama_barang'])->first();
            if ($search != "") {
                $data['pendapatan'][$key]['nama_barang'] = $search['nama_barang'];
                }
            }
            return [
            'message' => 'success',
            'data'=> $data['pendapatan']
            ];
        }
        else {
            return [
            'message' => 'data tidak ada',
            'data' => null
         ];
        }
        
    }

    public function getDetailPengeluaran($id) {
         $data['data'] = User::where('remember_token',$id)->first();
        $data['toko'] = Toko::where('id_user', $data['data']->id)->first();
        $data['data'] = Transaksi::where([['id_toko',$data['toko']->id_usaha],['pengeluaran','!=',0]])->first();
        if($data['data'] != null){
            $data['pendapatan'] = DetailTransaksi::where('id_transaksi',$data['data']->id_transaksi)->get();
            foreach ($data['pendapatan'] as $key => $value) {
              $search = Barang::where('id_barang', $value['nama_barang'])->first();
            if ($search != "") {
                $data['pendapatan'][$key]['nama_barang'] = $search['nama_barang'];
                }
            }
            return [
            'message' => 'success',
            'data'=> $data['pendapatan']
            ];
        }
        else {
            return [
            'message' => 'data tidak ada',
            'data' => null
         ];
        }
    }

    public function getBarang($id) {
        $data['data'] = User::where('remember_token', $id)->first();
        $data['toko'] = Toko::where('id_user', $data['data']->id)->first();
        $data['barang'] = Barang::where('id_toko', $data['toko']->id_usaha)->get();
        if(count($data['barang']) > 0){
            return [
                'message' => 'success',
                'data' => $data['barang']
            ];
        }
        else{
             return [
                'message' => 'tidak ada data',
                'data' => null
            ];
        }
    }

    private function getLastRowPendapatan($toko_id)
    {
        $data = Transaksi::where([['id_toko', $toko_id],['pendapatan','!=','']])->orderBy('id_transaksi', 'desc')->first();
        return $data->id_transaksi;
    }

    public function store_pendapatan(Request $request) {
        $date = Carbon::today()->toDateString();
        $data['data'] = User::where('remember_token', $id)->first();
        $id_toko = User::get_toko($data['data']->id)->id_usaha;
        $search = Transaksi::where([['id_toko', $id_toko],['pendapatan','!=', ''], ['tgl', $date]])->get();
        if (count($search) > 0) {
            $uang = Transaksi::where([['id_toko', $id_toko],['pendapatan','!=', ''], ['tgl', $date]])->first()->pendapatan;
            $saveChange = \App\Transaksi::where('id_transaksi', '=', $this->getLastRow($id_toko))->update([
                'pendapatan' => $uang + $request->total
            ]);
                $insert = new \App\DetailTransaksi;
                $insert->id_transaksi = $this->getLastRowPendapatan($id_toko);
                $insert->nama_barang = $request->barang;
                $insert->jumlah = $request->jumlah;
                $insert->subtotal = $request->total;
                $insert->save();
        } else {
            $insert = new Transaksi;
            $insert->id_toko = $id_toko;
            $total = 0;
            foreach ($request->data as $value) {
                $total += $value['subtotal'];
            }
            $insert->pendapatan = $total;
            $insert->tgl = $date;
            $insert->save();

            foreach ($request->data as $value) {
                $insert = new \App\DetailTransaksi;
                $insert->id_transaksi = $this->getLastRow($id_toko);
                $insert->nama_barang = $value['barang'];
                $insert->jumlah = $value['jumlah'];
                $insert->subtotal = $value['subtotal'];
                $insert->save();
            }
        }
    }

}
