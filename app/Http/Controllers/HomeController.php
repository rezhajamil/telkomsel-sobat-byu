<?php

namespace App\Http\Controllers;

use App\Rules\ByuNumber;
use App\Rules\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
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
            'email' => 'required|email',
            'semester' => 'required|numeric',
            'hobi' => 'required',
            // 'telp' => 'required|numeric|digits_between:11,13',
            'telp' => ['required', 'numeric', 'digits_between:11,13', new PhoneNumber],
            'wa' => ['required', 'numeric', 'digits_between:11,13', new PhoneNumber],
        ]);

        $count = DB::table('peserta_event')->where('telp', $request->telp)->where('event', $event->id)->count();

        if ($count > 0) {
            return redirect('/')->with('error', 'Anda Sudah Terdaftar sebagai Sobat byU');
        } else {
            $stage = DB::table('peserta_event')->insert([
                'npsn' => $request->npsn,
                'nama' => $request->nama,
                'email' => $request->email,
                'semester' => $request->semester,
                'hobi' => $request->hobi,
                'telp' => $request->telp,
                'wa' => $request->wa,
                'event' => $event->id,
            ]);

            return redirect('/')->with('success', 'Anda Berhasil Mendaftar sebagai Sobat byU');
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

    public function find_school(Request $request)
    {
        $name = $request->name;
        $sekolah = DB::table('Data_Sekolah_Sumatera')->select(['NPSN', 'NAMA_SEKOLAH'])->where('PROVINSI', 'Sumatera Utara')->where('NAMA_SEKOLAH', 'like', '%' . $name . '%')->whereIn('jenjang', ['AKADEMI', 'INSTITUTE', 'POLITEKNIK', 'SEKOLAH TINGGI', 'UNIVERSITAS', 'YAYASAN'])->orderBy('NAMA_SEKOLAH')->limit('20')->get();

        return response()->json($sekolah);
    }

    public function update_session(Request $request)
    {
        session(['close_popup' => $request->close_popup]);
        return response()->json(['message' => 'Session updated successfully']);
    }
}
