<?php

namespace App\Http\Controllers;

use App\Models\SpecialOffer;
use App\Rules\TelkomselNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpecialOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orbit = DB::table('produk_orbit')->select("*")->get();
        return view('offer.index', compact('orbit'));
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
        if ($request->asal == 'sekolah') {
            $request->validate([
                'npsn' => 'required|numeric|digits:8',
                'nama' => 'required',
                'alasan' => 'required',
                'email' => 'required|email',
                'kelas' => 'required',
                'telp' => ['required', 'numeric', 'digits_between:11,13', new TelkomselNumber],
                'wa' => 'required|numeric|digits_between:11,13',
                'jenis_orbit' => 'required'
            ]);
        } else if ($request->asal == 'non_sekolah') {
            $request->validate([
                'instansi' => 'required',
                'nama' => 'required',
                'alasan' => 'required',
                'email' => 'required|email',
                'jabatan' => 'required',
                'telp' => ['required', 'numeric', 'digits_between:11,13', new TelkomselNumber],
                'wa' => 'required|numeric|digits_between:11,13',
                'jenis_orbit' => 'required'
            ]);
        }

        $count = DB::table('peserta_event')->where('telp', $request->telp)->where('kategori', 'Special Offer Orbit')->count();

        if ($count > 0) {
            return redirect('/')->with('error', 'Anda Sudah Mendaftar di Special Offer Orbit');
        } else {
            if ($request->asal == 'sekolah') {
                $offer = DB::table('peserta_event')->insert([
                    'npsn' => $request->npsn,
                    'nama' => $request->nama,
                    'email' => $request->email,
                    'kelas' => $request->kelas,
                    'jenis_orbit' => $request->jenis_orbit,
                    'telp' => $request->telp,
                    'wa' => $request->wa,
                    'alasan' => $request->alasan,
                    'kategori' => 'Special Offer Orbit',
                ]);
            } else if ($request->asal == 'non_sekolah') {
                $offer = DB::table('peserta_event')->insert([
                    'nama_instansi' => $request->instansi,
                    'nama' => $request->nama,
                    'email' => $request->email,
                    'kelas' => $request->jabatan,
                    'jenis_orbit' => $request->jenis_orbit,
                    'telp' => $request->telp,
                    'wa' => $request->wa,
                    'alasan' => $request->alasan,
                    'kategori' => 'Special Offer Orbit',
                ]);
            }

            return redirect('/')->with('success', 'Anda Berhasil Mendaftar di Special Offer Orbit');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SpecialOffer  $specialOffer
     * @return \Illuminate\Http\Response
     */
    public function show(SpecialOffer $specialOffer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SpecialOffer  $specialOffer
     * @return \Illuminate\Http\Response
     */
    public function edit(SpecialOffer $specialOffer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SpecialOffer  $specialOffer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SpecialOffer $specialOffer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SpecialOffer  $specialOffer
     * @return \Illuminate\Http\Response
     */
    public function destroy(SpecialOffer $specialOffer)
    {
        //
    }
}
