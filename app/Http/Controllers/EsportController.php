<?php

namespace App\Http\Controllers;

use App\Models\Esport;
use App\Rules\TelkomselNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EsportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('esport.index');
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
        $request->validate([
            'npsn' => 'required|numeric|digits:8',
            'nama' => 'required',
            'nama_tim' => 'required',
            'kelas' => 'required',
            'jenis' => 'required',
            'alasan' => 'required',
            'email' => 'required|email',
            'telp' => ['required', 'numeric', 'digits_between:11,13', new TelkomselNumber],
            'wa' => 'required|numeric|digits_between:11,13',
        ]);

        $count = DB::table('peserta_event')->where('telp', $request->telp)->where('kategori', 'E-Sport Competition')->count();

        if ($count > 0) {
            return redirect('/')->with('error', 'Anda Sudah Mendaftar di E-Sport Competition');
        } else {
            $stage = DB::table('peserta_event')->insert([
                'npsn' => $request->npsn,
                'nama' => $request->nama,
                'nama_tim' => $request->nama_tim,
                'kelas' => $request->kelas,
                'jenis' => $request->jenis,
                'telp' => $request->telp,
                'email' => $request->email,
                'wa' => $request->wa,
                'alasan' => $request->alasan,
                'kategori' => 'E-Sport Competition',
            ]);

            return redirect('/')->with('success', 'Anda Berhasil Mendaftar di E-Sport Competition');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Esport  $esport
     * @return \Illuminate\Http\Response
     */
    public function show(Esport $esport)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Esport  $esport
     * @return \Illuminate\Http\Response
     */
    public function edit(Esport $esport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Esport  $esport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Esport $esport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Esport  $esport
     * @return \Illuminate\Http\Response
     */
    public function destroy(Esport $esport)
    {
        //
    }
}
