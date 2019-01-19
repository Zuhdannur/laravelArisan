<?php

namespace App\Http\Controllers;

use App\Pendapatan;
use Illuminate\Http\Request;

class PendapatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.pendapatan.pendapatan_view');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.pendapatan.pendapatan_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pendapatan  $pendapatan
     * @return \Illuminate\Http\Response
     */
    public function show(Pendapatan $pendapatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pendapatan  $pendapatan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pendapatan $pendapatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pendapatan  $pendapatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pendapatan $pendapatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pendapatan  $pendapatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pendapatan $pendapatan)
    {
        //
    }
}
