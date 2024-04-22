@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" style="text-align: center; font-size: 30px; font-family: Montserrat, sans-serif;"  >Album Preview</div>

                <div class="card-body">


                    <h1 style="font-size: 45px;"><strong>{{ $album->nama_album }}</strong></h1>
                    <h2>{{ $album->deskripsi }}</h2>
                    <hr>
                    @if($album->foto->isEmpty())
                        <p>Belum ada foto dalam album ini.</p>
                    @else
                    <div class="row">
                        @if($album->foto->isNotEmpty())
                            @foreach($album->foto as $foto)
                                <div class="col-md-6 mb-4">
                                    <div class="card">
                                        <img src="{{ asset('images/'.$foto->image) }}" class="card-img-top" style="width: 100%; height: auto;" alt="...">
                                        <div class="card-body">
                                            <p class="card-text montserrat" style="font-size: 45px; font-family: Montserrat, sans-serif;">{{ $foto->judul_foto }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-md-12">
                                <p>Tidak ada foto dalam album ini.</p>
                            </div>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


<style>
    body, p, h5, .card-header {
        font-family: 'Montserrat', sans-serif;
    }
    .montserrat {
        font-family: Montserrat, sans-serif;
    }
</style>

