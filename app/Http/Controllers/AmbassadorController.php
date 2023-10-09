<?php

namespace App\Http\Controllers;

use App\Rules\TelkomselNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AmbassadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ambassador.index');
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
            'alasan' => 'required',
            'instagram' => 'required',
            'email' => 'required|email',
            'kelas' => 'required',
            'telp' => ['required', 'numeric', 'digits_between:11,13', new TelkomselNumber],
            'wa' => 'required|numeric|digits_between:11,13',
        ]);

        $count = DB::table('peserta_event')->where('telp', $request->telp)->where('kategori', 'Ambassador Digital')->count();

        if ($count > 0) {
            return redirect('/')->with('error', 'Anda Sudah Mendaftar di Ambassador Digital');
        } else {
            $ambassador = DB::table('peserta_event')->insert([
                'npsn' => $request->npsn,
                'nama' => $request->nama,
                'instagram' => $request->instagram,
                'email' => $request->email,
                'kelas' => $request->kelas,
                'telp' => $request->telp,
                'wa' => $request->wa,
                'alasan' => $request->alasan,
                'kategori' => 'Ambassador Digital',
            ]);

            return redirect('/')->with('success', 'Anda Berhasil Mendaftar di Ambassador Digital');
        }
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
