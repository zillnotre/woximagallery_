<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\komentar_foto;
use App\Models\Foto;

class Komentar_FotoController extends Controller
{
    public function postComment(Request $request, Foto $foto)
{
    $request->validate([
        'isi_komentar' => 'required|string', // Ensure that isi_komentar field is present and not empty
    ]);

    $comment = new komentar_foto;

    $comment->isi_komentar = $request->isi_komentar;
    $comment->user_id = auth()->user()->id;

    $foto->comments()->save($comment);

    return back()->with('success', 'Komentar Terkirim');
}
}