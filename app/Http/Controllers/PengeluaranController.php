<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Helpers\User;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.pengeluaran.pengeluaran_view');
    }

    private function getLastRow($toko_id)
    {
        $data = Transaksi::where('id_toko', $toko_id)->orderBy('id_transaksi', 'desc')->first();
        return $data->id_transaksi;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['barang'] = \App\Barang::all();
        return view('pages.pengeluaran.pengeluaran_form')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date = Carbon::today()->toDateString();
        $id_toko = User::get_toko(Auth::user()->id)->id_usaha;
        $search = Transaksi::where([['id_toko', $id_toko],['pengeluaran','!=', ''], ['tgl', $date]])->get();
        if (count($search) > 0) {

        } else {
            $insert = new Transaksi;
            $insert->id_toko = $id_toko;
            $insert->pengeluaran = $request->totalPembayaran;
            $insert->tgl = $date;
            $insert->save();
            foreach ($request->data as $value) {
                $insert = new \App\DetailTransaksi;
                $insert->id_transaksi = $this->getLastRow($id_toko);
                $insert->nama_barang = $value['nama_barang'];
                $insert->jumlah = $value['jumlah'];
                $insert->subtotal = $value['subtotal'];
                $insert->save();
            }
        }
        return redirect(action('PengeluaranController@index'));
    }


    public function getData(Request $request)
    {
        $input = $request->all();

        $transaksi = \App\Transaksi::where('pengeluaran','!=','');
        $length = (int)@$input['length'];
        $start = (int)@$input['start'];
        $search = @$input['search'];
        $order = @$input['order'];

        $data = array();
        $count = $transaksi->count();

        $data['recordsFiltered'] = $count;
        $data['recordsTotal'] = $count;

        if (!empty($search) AND !empty($search['value'])) {
            $transaksi = $transaksi->where(function ($query) use ($search) {
                $query->orWhere('pengeluaran', 'like', '%' . $search['value'] . '%');
            });
        }

        $data['recordsFiltered'] = $transaksi->count();

        $transaksi = $transaksi->skip($start)->take($length)->orderBy('id_transaksi');
        $i = 1;
        foreach ($transaksi->get() as $row) {
            $d = [];
            $d[] = $i++;
            $d[] = $row->tgl;
            $d[] = $this->getItem($row->id_transaksi);
            $d[] = 'Rp '.number_format($row->pengeluaran, 0,'.', ',');
            $btn = '<div>
                    <input type="text" name="_id" value="'. $row->id_transaksi .'" hidden>
                    <button type="submit" class="btn btn-sm btn-danger hapus"><span class="btn-label"><i class="fa fa-trash-alt"></i> Hapus</span>
                    </button>
                    </div> ';

            $d[] = $btn;
            $data['data'][] = $d;
        }

        if (empty($data['data'])) {
            $data['recordsTotal'] = $count;
            $data['recordsFiltered'] = 0;
            $data['aaData'] = [];
        }

        return response()->json($data);
    }

    public function getItem($id_transaksi)
    {
        $data = \App\DetailTransaksi::where('id_transaksi',$id_transaksi)->get();
        return count($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
