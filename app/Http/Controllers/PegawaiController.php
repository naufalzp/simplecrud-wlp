<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['pegawai'] = Pegawai::all();

        return view('pegawai.index', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pegawai.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([ // 1
            'nama' => 'required',
            'no_pegawai' => 'required|unique:pegawais',
        ]);

        $data = $request->except(['_token', '_method']);

        $save = Pegawai::create($data);

        if ($save) {
            return redirect('/pegawai')->with('success', 'Data Berhasil Disimpan!');
        } else {
            return redirect()->back()->withInput()->with('error', 'Terjadi Kesalahan!');
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
        $result['pegawai'] = Pegawai::find($id);
        return view('pegawai.edit', $result);
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
        $request->validate([
            'nama' => 'required',
            'no_pegawai' => 'required|unique:pegawais',
        ]);

        $data = $request->except(['_token', '_method']);

        $pegawai = Pegawai::find($id);

        $save = $pegawai->update($data);

        if ($save) {
            return redirect('/pegawai')->with('success', 'Data Berhasil Diupdate!');
        } else {
            return redirect()->back()->withInput()->with('error', 'Terjadi Kesalahan!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pegawai = Pegawai::find($id);
        $pegawai->delete();

        return redirect('/pegawai')->with('success', 'Data Berhasil Dihapus!');
    }
}
