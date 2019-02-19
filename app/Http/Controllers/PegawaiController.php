<?php

namespace App\Http\Controllers;

use App\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('pages.pegawai.pegawai_view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function getData(Request $request)
    {
        $data['toko'] = \App\Helpers\User::get_toko(Auth::user()->id);
        $input = $request->all();

        $transaksi = \App\Pegawai::where('id_toko', $data['toko']->id_usaha);
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
                $query->orWhere('jabatan', 'like', '%' . $search['value'] . '%');
            });
        }

        $data['recordsFiltered'] = $transaksi->count();

        $transaksi = $transaksi->skip($start)->take($length)->orderBy('id_pegawai');
        $i = 1;
        foreach ($transaksi->get() as $row) {
            $d = [];
            $d[] = $i++;
            $d[] = $row->user->name;
            $d[] = '';
            $d[] = 'Aktif';
            $d[] = 'Rp' . number_format($row->pendapatan, 0, '.', ',');
            $btn = '<div>
                    <input type="text" name="_id" value="' . $row->id_pegawai . '" hidden>
                    <button type="submit" class="btn btn-sm btn-danger hapus"><span class="btn-label"><i class="fa fa-trash-alt"></i> pecat</span>
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pegawai $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show(Pegawai $pegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pegawai $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(Pegawai $pegawai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Pegawai $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pegawai $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pegawai $pegawai)
    {
        //
    }
}
