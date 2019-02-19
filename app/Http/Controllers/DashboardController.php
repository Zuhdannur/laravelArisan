<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserHelp;
use App\Toko;
use Carbon\Carbon;

class DashboardController extends Controller
{
//    protected $userId;
//    public  function __construct()
//    {
//
//        $this->middleware(function (Request $request, $next) {
//            $this->userId = \Auth::id(); // you can access user id here
//            if( \App\Helpers\User::getRole(\Auth::id()) == 'pemilik'){
//                return redirect(action('DashboardController@index'));
//            }
//            else{
//                return redirect(action('DashboardController@index'));
//            }
//
//        });
//
//
//
//    }


    public function index()
    {
        if (Auth::user()->type == "pemilik") {
            $data['value'] = \App\Helpers\User::get_toko(Auth::user()->id);
            $data['datas'] = false;
            $data['bulan'] = $this->pendapatan_bulanan($data['value']->id_usaha);
            $data['uang'] = $data['bulan']['penghasilan'];
            $data['pendapatan'] = $data['bulan']['pendapatan'];
            $data['pengeluaran'] = $data['bulan']['pengeluaran'];
            $data['jml'] = $data['bulan']['jml'];
            if ($data['value'] == '') {
                $data['datas'] = false;
            } else $data['datas'] = true;
            return view('pages.dashboard')->with($data);
        } else {
            $data['value'] = \App\Helpers\User::get_profil_pegawai(Auth::user()->id);
            $data['datas'] = false;
            if ($data['value'] == '') {
                $data['datas'] = false;
            } else $data['datas'] = true;
            return view('pages.dashboard_pegawai')->with($data);
        }

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function pendapatan_bulanan($id_toko)
    {
        $date = Carbon::now();
        $year = '' . $date->year;
        $month = '' . $date->month;
        $data['transaksi'] = \App\Transaksi::where('id_toko', $id_toko)->whereMonth('tgl', '=', $month)->get();
        $pendapatan = 0;
        $pengeluaran = 0;
        foreach ($data['transaksi'] as $value) {
            $pendapatan += $value['pendapatan'];
            $pengeluaran += $value['pengeluaran'];
        }
        $data['penghasilan'] =number_format( $pendapatan - $pengeluaran,0,'.',',');
        $data['pendapatan'] = number_format( $pendapatan,0,'.',',');
        $data['pengeluaran'] = number_format( $pengeluaran,0,'.',',');
        $data['jml'] = count($data['transaksi']);
        return $data;
    }

    public function create()
    {

    }


    public function join_toko(Request $request)
    {
        $findToko = Toko::where('invitation_code', $request->kode)->first();
        if ($findToko != '') {
            $insert = new \App\Pegawai;
            $insert->id_toko = $findToko->id_usaha;
            $insert->id_user = Auth::user()->id;

            $insert->save();
            return redirect(action('DashboardController@index'));
        }

    }


    public function generateCode(Request $request)
    {
        $generateCode = $this->generate();
        if ($this->checkingCode($generateCode)) {
            $update = Toko::where('id_usaha', \App\Helpers\User::get_idToko(Auth::user()->id))->
            update([
                'invitation_code' => $generateCode
            ]);
            return redirect(action('DashboardController@index'));
        } else {
            return redirect(action('DashboardController@generateCode'));
        }
    }

    private function checkingCode($data)
    {
        $data = Toko::where('invitation_code', $data)->get();
        if (count($data) > 0) {
            return false;
        } else return true;
    }

    private function generate()
    {
        $letters = 'abcdefghijklmnopqrstuvwxyz';
        $string = '';
        for ($x = 0; $x < 3; ++$x) {
            $string .= $letters[rand(0, 25)] . rand(0, 9);
        }
        return $string;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $insert = new Toko;
        $insert->id_user = Auth::user()->id;
        $insert->nama_toko = $request->nama_toko;
        $insert->deskripsi = '';
        $insert->alamat = $request->alamat;
        $insert->jenis_usaha = $request->jenis;
        $insert->save();
        return redirect(action('DashboardController@index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
