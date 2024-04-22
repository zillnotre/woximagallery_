<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\User;
use App\Models\Foto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AlbumController extends Controller
{
    public function index()
{
    $user = User::with('foto')->find(Auth::id());
    $foto = $user->foto; // Mengambil data foto dari relasi user
    $albums = Album::where('user_id', Auth::id())->get();
    return view('welcome', compact('albums', 'foto'));
}




    public function create()
    {
        return view('albums.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_album' => 'required',
            'deskripsi' => 'required',
        ]);

        $album = new Album();
        $album->nama_album = $request->nama_album;
        $album->deskripsi = $request->deskripsi;
        $album->user_id = Auth::id();
        $album->save();

        Session::flash('success', 'Album created successfully.');
        return redirect()->route('albums.index');
    }

    public function show(Album $album)
    {
        return view('albums.show', compact('album'));
    }

    public function edit(Album $album)
    {
        return view('albums.edit', compact('album'));
    }

    public function update(Request $request, Album $album)
    {
        $request->validate([
            'nama_album' => 'required',
            'deskripsi' => 'required',
        ]);

        $album->update([
            'nama_album' => $request->nama_album,
            'deskripsi' => $request->deskripsi,
        ]);

        Session::flash('success', 'Album updated successfully.');
        return redirect()->route('albums.index');
    }

    public function destroy(Album $album)
    {
        $album->delete();

        Session::flash('success', 'Album deleted successfully.');
        return redirect()->route('albums.index');
    }
}
