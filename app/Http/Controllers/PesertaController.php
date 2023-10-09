<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesertaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stage = DB::select("SELECT * FROM peserta_event a LEFT JOIN Data_Sekolah_Sumatera b on a.npsn=b.NPSN WHERE a.kategori='The Stage' ORDER BY b.NAMA_SEKOLAH,a.nama");
        $ambassador = DB::select("SELECT * FROM peserta_event a LEFT JOIN Data_Sekolah_Sumatera b on a.npsn=b.NPSN WHERE a.kategori='Ambassador Digital' ORDER BY b.NAMA_SEKOLAH,a.nama");
        $offer = DB::select("SELECT * FROM peserta_event a LEFT JOIN Data_Sekolah_Sumatera b on a.npsn=b.NPSN WHERE a.kategori='Special Offer Orbit' ORDER BY b.NAMA_SEKOLAH,a.nama_instansi,a.nama");
        $esport = DB::select("SELECT * FROM peserta_event a LEFT JOIN Data_Sekolah_Sumatera b on a.npsn=b.NPSN WHERE a.kategori='E-Sport Competition' ORDER BY b.NAMA_SEKOLAH,a.nama");
        return view('peserta.index', compact('stage', 'ambassador', 'offer', 'esport'));
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
