<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Anggota;

class AnggotaController extends Controller
{
    public function index()
    {
        $data['anggota'] = \App\Anggota::all();

        return view('pages.anggota.anggota_view')->with($data);
    }

    public function create()
    {
        $data['form'] = "add";
        return view('pages.anggota.anggota_form')->with($data);
    }

    public function show($id)
    {
        $data['result'] = \App\Anggota::where('id_anggota', $id)->first();
        $data['form'] = "edit";
        return view('pages.anggota.anggota_form')->with($data);
    }

    public function edit(Request $request, $id)
    {
        $update = \App\Anggota::where('id_anggota', $id)->update([
            'nama_anggota' => $request->nama_anggota,
            'alamat' => $request->alamat
        ]);

            return redirect(action('AnggotaController@index'));

    }

    public function store(Request $request)
    {
       $validate = $request->validate([
           'nama_anggota'=> 'unique:tbl_anggota'
       ]);
        $find = \App\Anggota::where('nama_anggota', '%' . $request->nama_anggota . '%')->get();

        if (count($find) > 0) {
            return view('pages.anggota.anggota_form');
        } else {
            $insert = \App\Anggota::create([
                'nama_anggota' => $request->nama_anggota,
                'alamat' => $request->alamat
            ]);

            if ($insert) {
                $insert_data = \App\Arisan::create([
                    'id_anggota' => $this->getLastRow(),
                ]);
                return redirect(action('AnggotaController@index'));
            }
        }
    }

    public function getLastRow()
    {
        $id = \App\Anggota::orderBy('id_anggota', 'desc')->first();
        return $id->id_anggota;
    }

    public function getData(Request $request)
    {
        $input = $request->all();

        $transaksi = new \App\Anggota;
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
                $query->orWhere('nama_anggota', 'like', '%' . $search['value'] . '%');
            });
        }

        $data['recordsFiltered'] = $transaksi->count();

         $transaksi = $transaksi->skip($start)->take($length)->orderBy('id_anggota');
        $i = 1;
        foreach ($transaksi->get() as $row) {
            $d = [];
            $d[] = $i++;
            $d[] = $row->nama_anggota;
            $d[] = $row->alamat;
            $d[] = $row->arisan['status'];
            $d[] = $row->arisan['status_bayar'];

            $btn = '<div>
                    <input type="text" name="_id" value="' . $row->id_anggota . '" hidden>
                    <button type="submit" class="btn btn-sm btn-danger hapus"><span class="btn-label"><i class="fa fa-trash-alt"></i> Delete</span>
                    </button>
                    <a href="' . url('/anggota/' . $row->id_anggota) . '" class="btn btn-sm btn-success"><span class="btn-label"><i class="fa fa-file"></i>Edit Data</span></a>
                    </div> ';
            if($row->arisan['status'] == "belum bayar"){
                $btn .= '<div style="margin-top: 0.5%;">
                    <input type="text" name="_id" value="' . $row->id_anggota . '" hidden>
                    <button type="submit" class="btn btn-sm btn-danger bayar"><span class="btn-label"><i class="fa fa-file"></i> Bayar</span>
                    </div>';
            }


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

    public function bayar($id)
    {
        $update = \App\Arisan::where('id_anggota', $id)->update([
            'status' => 'Sudah Bayar',
            'status_bayar' => 'Belum Menang'
        ]);
        return response()->json("success");
    }

    public function random(){
        $data = \App\Arisan::where([['status_bayar','Belum Menang'],['status','Sudah Bayar']])->get();
        $number = rand(0,count($data) - 1);
//        dd($data[$number]);
        $update = \App\Arisan::where('id_anggota',$data[$number]['id_anggota'])->update([
            'status_bayar' => 'sudah menang'
        ]);
        return redirect(action('AnggotaController@index'));
    }

    public function destroy(Anggota $anggota, $id)
    {
        $delete = \App\Anggota::find($id)->delete();
    }
}
