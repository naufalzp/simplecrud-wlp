<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result['mahasiswa'] = Mahasiswa::all();

        return view("mahasiswa.index", $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("mahasiswa.create");
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
            'nama' => 'required',
        ]);

        $data = $request->except(['_token', '_method']);

        $save = Mahasiswa::create($data);

        if ($save) {
            return redirect('/mahasiswa')->with('success', 'Data Berhasil Disimpan!');
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
        $result['mahasiswa'] = Mahasiswa::find($id);

        return view('mahasiswa.edit', $result);
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
        ]);

        $data = $request->except(['_token', '_method']);

        $mahasiswa = Mahasiswa::find($id);
        $save = $mahasiswa->update($data);

        if ($save) {
            return redirect('/mahasiswa')->with('success', 'Data Berhasil Diubah!');
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
        $mahasiswa = Mahasiswa::find($id);
        $mahasiswa->delete();

        return redirect('/mahasiswa')->with('success', 'Data Berhasil Dihapus!');
    }
}
