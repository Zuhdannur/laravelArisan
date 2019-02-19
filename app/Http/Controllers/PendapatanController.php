<?php

namespace App\Http\Controllers;

use App\Barang;
use App\Transaksi;
use Carbon\Carbon;
use App\Pendapatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\User;

class PendapatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->type == "pemilik") {
            return view('pages.pendapatan.pendapatan_view');
        } else {
            return redirect(action('PendapatanController@create'));
        }

    }

    public function getPrice(Request $request)
    {
        $data = Barang::where('id_barang', $request->kode)->first();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['barang'] = \App\Barang::all();
        return view('pages.pendapatan.pendapatan_form')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $date = Carbon::today()->toDateString();
        $id_toko = User::get_toko(Auth::user()->id)->id_usaha;
        $search = Transaksi::where([['id_toko', $id_toko],['pendapatan','!=', ''], ['tgl', $date]])->get();
        if (count($search) > 0) {
            $uang = Transaksi::where([['id_toko', $id_toko],['pendapatan','!=', ''], ['tgl', $date]])->first()->pendapatan;
            $total = 0;
            foreach ($request->data as $value) {
                $total += $value['subtotal'];
            }
            $saveChange = \App\Transaksi::where('id_transaksi', '=', $this->getLastRow($id_toko))->update([
                'pendapatan' => $uang + $total
            ]);
            foreach ($request->data as $value) {
                $insert = new \App\DetailTransaksi;
                $insert->id_transaksi = $this->getLastRow($id_toko);
                $insert->nama_barang = $value['barang'];
                $insert->jumlah = $value['jumlah'];
                $insert->subtotal = $value['subtotal'];
                $insert->save();
            }
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
        return redirect(action('PendapatanController@index'));
    }

    private function getLastRow($toko_id)
    {
        $data = Transaksi::where([['id_toko', $toko_id],['pendapatan','!=','']])->orderBy('id_transaksi', 'desc')->first();
        return $data->id_transaksi;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pendapatan $pendapatan
     * @return \Illuminate\Http\Response
     */
    public function show(Pendapatan $pendapatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pendapatan $pendapatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pendapatan $pendapatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Pendapatan $pendapatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pendapatan $pendapatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pendapatan $pendapatan
     * @return \Illuminate\Http\Response
     */
    public function getData(Request $request)
    {
        $input = $request->all();

        $transaksi = \App\Transaksi::where('pendapatan', '!=', '');
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
                $query->orWhere('pendapatan', 'like', '%' . $search['value'] . '%');
            });
        }

        $data['recordsFiltered'] = $transaksi->count();

        $transaksi = $transaksi->skip($start)->take($length)->orderBy('id_transaksi');
        $i = 1;
        foreach ($transaksi->get() as $row) {
            $d = [];
            $d[] = $i++;
            $d[] = 'Rp' . number_format($row->pendapatan, 0, '.', ',');
            $d[] = $this->getItem($row->id_transaksi);
            $d[] = Carbon::parse($row->tgl)->format('Y-m-d');
            $btn = '<div>
                    <input type="text" name="_id" value="' . $row->id_transaksi . '" hidden>
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

    public function destroy(Pendapatan $pendapatan)
    {
        //
    }
}
