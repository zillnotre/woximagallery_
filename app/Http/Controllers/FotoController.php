<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Foto;
use Illuminate\Support\Facades\Session;

class FotoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'judul_foto' =>'required',
            'image' => 'required|image|mimes:jpg,jpeg,png',
            'deskripsi_foto' => 'required',
        ]);



        $foto = new Foto;
        $foto->judul_foto = $request->judul_foto;
        $foto->deskripsi_foto = $request->deskripsi_foto;
        $foto->tanggal_posting = $request->tanggal_posting;
        // $foto->lokasi_file = $request->lokasi_file;
        $foto->album_id = auth()->id();
        $foto->user_id = auth()->id();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('/images');
            $file->move($destinationPath, $fileName);
            $foto->image = $fileName;
        }

        $foto->save();


        Session::flash('success', 'Foto berhasil diposting.');

        return back();
    }
}
