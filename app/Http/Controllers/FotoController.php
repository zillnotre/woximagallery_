<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Foto;
use App\Models\album;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class FotoController extends Controller
{
    public function index()
{
    $user = User::with('foto')->find(Auth::id());
    $foto = $user->foto;
    return view('welcome', compact('user', 'foto'));
}



    public function store(Request $request)
    {
        // Periksa apakah pengguna memiliki setidaknya satu album
    $userAlbums = Album::where('user_id', Auth::id())->count();
    if($userAlbums === 0) {
        // Jika pengguna tidak memiliki album, alihkan mereka ke halaman untuk membuat album
       // Di dalam metode yang menangani logika upload foto
return redirect()->route('welcome')->with('error', 'Anda harus membuat album terlebih dahulu sebelum mengunggah foto.');

    }
        $request->validate([
            'judul_foto' =>'required',
            'image' => 'required|image|mimes:jpg,jpeg,png',
            'deskripsi_foto' => 'required',
            'album_id' => 'required|exists:album,id',
        ]);



        $foto = new Foto;
        $foto->judul_foto = $request->judul_foto;
        $foto->deskripsi_foto = $request->deskripsi_foto;
        $foto->tanggal_posting = $request->tanggal_posting;
        // $foto->lokasi_file = $request->lokasi_file;
        $foto->album_id = $request->album_id;
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

    public function delete(Request $request, $id)
    {
        // Temukan foto berdasarkan ID
        $foto = Foto::find($id);

        // Pastikan foto ditemukan
        if (!$foto) {
            return back()->with('error', 'Foto tidak ditemukan.');
        }

        // Pastikan pengguna memiliki akses untuk menghapus foto
        if ($foto->user_id !== auth()->id()) {
            return back()->with('error', 'Anda tidak memiliki izin untuk menghapus foto ini.');
        }

        // Hapus foto dari sistem file
        $imagePath = public_path('images/' . $foto->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        // Hapus foto dari database
        $foto->delete();

        // Beri feedback ke pengguna bahwa foto berhasil dihapus
        Session::flash('success', 'Foto berhasil dihapus.');

        // Redirect kembali ke halaman sebelumnya
        return back();
    }

}
