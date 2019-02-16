<?php

namespace App\Http\Controllers;

use App\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\User;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.barang.barang_view');
    }


    public function getData(Request $request)
    {
        $input = $request->all();

        $barang = \App\Barang::where('id_toko',\App\Helpers\User::get_idToko(Auth::user()->id));
        $length = (int)@$input['length'];
        $start = (int)@$input['start'];
        $search = @$input['search'];
        $order = @$input['order'];

        $data = array();
        $count = $barang->count();

        $data['recordsFiltered'] = $count;
        $data['recordsTotal'] = $count;

        if (!empty($search) AND !empty($search['value'])) {
            $barang = $barang->where(function ($query) use ($search) {
                $query->orWhere('nama_barang', 'like', '%' . $search['value'] . '%');
            });
        }

        $data['recordsFiltered'] = $barang->count();

        $barang = $barang->skip($start)->take($length)->orderBy('id_barang');
        $i = 1;
        foreach ($barang->get() as $row) {
            $d = [];
            $d[] = $i++;
            $d[] = $row->nama_barang;
            $d[] = 'Rp '.number_format($row->harga, 0, '.', ',');
            if ($row->status == 0) {
                $d[] = "Tidak Aktif";
            } else {
                $d[] = "Aktif";
            }
            $btn = '<div>
                    <input type="text" name="_id" value="'. $row->id_barang .'" hidden>
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.barang.barang_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $insert = new Barang;
        $insert->id_toko = User::get_toko(Auth::user()->id)->id_usaha;
        $insert->nama_barang = $request->nama_barang;
        $insert->harga = $request->harga;
        $insert->status = 1;
        $insert->save();
        return redirect(action('BarangController@index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Barang $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Barang $barang
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Barang $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $barang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Barang $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang)
    {
       Barang::find($barang->id_barang)->delete();
        return response()->json("succsess");
    }
}
