<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\like_foto;
use App\Models\Foto;
use Illuminate\Support\Facades\Input; // Import Input facade

class Like_FotoController extends Controller
{
    public function likefoto(Request $request) // Pass the request instance
    {
        $fotoId = $request->input('fotoId'); // Use the request to get the fotoId

        $foto = Foto::find($fotoId);

        if (!$foto->YouLiked()) {
            $foto->YouLikeIt();
            return response()->json(['status'=>'success', 'message' =>'Liked']);
        } else {
            $foto->YouUnlike();
            return response()->json(['status'=>'success', 'message' =>'Unliked']);
        }
    }
}

