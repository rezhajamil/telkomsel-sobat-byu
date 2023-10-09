<?php

namespace App\Http\Controllers;

use App\Rules\TelkomselNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TheStageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('stage.index');
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
        $event = DB::table('list_event')->where('status', 1)->first();
        $request->validate([
            'npsn' => 'required|numeric|digits:8',
            'nama' => 'required',
            'nama_tim' => 'required',
            'email' => 'required|email',
            'kelas' => 'required',
            'jenis' => 'required',
            'agree' => 'required',
            'alasan' => 'required',
            // 'telp' => 'required|numeric|digits_between:11,13',
            'telp' => ['required', 'numeric', 'digits_between:11,13', new TelkomselNumber],
            'wa' => 'required|numeric|digits_between:11,13',
            'url' => 'required|url',
        ]);

        $count = DB::table('peserta_event')->where('telp', $request->telp)->where('kategori', 'The Stage')->where('event', $event->id)->count();

        if ($count > 0) {
            return redirect('/')->with('error', 'Anda Sudah Mendaftar di The Stage');
        } else {
            $stage = DB::table('peserta_event')->insert([
                'npsn' => $request->npsn,
                'nama' => $request->nama,
                'nama_tim' => $request->nama_tim,
                'email' => $request->email,
                'kelas' => $request->kelas,
                'jenis' => $request->jenis,
                'telp' => $request->telp,
                'wa' => $request->wa,
                'alasan' => $request->alasan,
                'youtube' => $request->url,
                'kategori' => 'The Stage',
                'event' => $event->id,
            ]);

            return redirect('/')->with('success', 'Anda Berhasil Mendaftar di The Stage');
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
