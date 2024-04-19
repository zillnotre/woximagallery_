@extends('layouts.app')

@section('content')
@if(Session::has('success'))
<div class="alert alert-success">
    {{ Session::get('success') }}
</div>
@endif

<div class="container">
    <div class="row justify-content-start">
        <div class="col-md-4">
            <div class="text-start mb-3">
                <!-- Memindahkan elemen "Selamat Datang" keluar dari div card -->
                <div class="card-header" style="font-size: 49px; margin-bottom: 0;">Selamat Datang Di Woxima, {{Auth::user()->nama_lengkap}}!</div>
            </div>
            <p>Ayo Upload Foto Mu!</p>
            <a href="#uploadFoto" data-bs-toggle="modal" class="btn btn-primary btn-block d-block"><i class="fa fa-upload"></i> Upload Foto</a>
        </div>
    </div>
</div>






<!-- Modal -->
<div class="modal fade" id="uploadFoto" role="dialog" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Posting Sebuah Foto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('foto.store')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group">
                        <input type="file" name="image" class="form-control">
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="string" name="judul_foto" class="form-control" placeholder="Judul Foto...">
                    </div>
                    <br>
                    <div class="form-group">
                        <textarea name="deskripsi_foto" placeholder="Masukkan Deskripsi..." class="form-control"></textarea>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary" style="width: 100%;">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<br>
<div class="container">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body" style="font-size: 50px;"> <!-- Adjust the font size here -->
                Gallery
            </div>
        </div>
    </div>
</div>


<br>

<div class="container">
    <div class="row justify-content-center">
        @foreach($foto as $fot)
            <div class="col-md-6 mb-4"> <!-- Added mb-4 class for margin bottom -->
                <div class="card">
                    <div class="card-body">
                        <div class="show_image">
                            <div class="profile">
                                <small style="font-size: 30px;"><i class="fa fa-user"></i>@
                                    {{ $fot->user->name }}</small>
                            </div>
                            <a href="#{{$fot->id}}" data-bs-toggle="modal"><img src="{{asset('images/'.$fot->image)}}" style="width: 100%; height: auto;"></a>
                        </div>
                        <br>
                        <div class="foto-footer" style="display: flex; flex-direction: column;">
                            <div class="caption" style="text-align: left;">
                                <h5 style="font-size: 40px; font-weight: bold;">{{ $fot->judul_foto }}</h5>
                                <small style="font-size: 18px;">{{ $fot->deskripsi_foto }}</small>
                                <!-- Akses nama pengguna -->
                            </div>
                            <div class="button-footer" style="display: flex; align-items: center;">
                                <a class="btn btn-default btn-sm" href="#{{$fot->id}}" data-bs-toggle="modal"><i class="fa fa-comment" style="font-size: 40px;"></i></a>
                                <span class="btn btn-default btn-sm">5</span>
                                <span class="btn btn-default btn-sm {{$fot->YouLiked() ? "liked" : ""}}" onclick="likefoto('{{ $fot->id }}', this)">
                                    <i class="fa fa-heart" style="font-size: 40px;"></i>
                                </span>

                                <span class="btn btn-default btn-sm" id="{{$fot->id}}-count">{{$fot->likes()->count()}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

{{-- Modal --}}
@foreach($foto as $fot)
    <div class="modal fade" id="{{$fot->id}}">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="show_modal_image">
                        <a href=""><img src="{{asset('images/'.$fot->image)}}" style="width: 100%; height: auto;"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach


    </div> <!--End Container-->
</div>


<style>
    .button-footer .btn {

        /* background-color: rgba(0, 0, 0, 0.1);
        color: rgba(0, 0, 0, 0.9);
        margin: 3px;
        padding: 3px 10px; */

    }
    .show_image img {
        width: 100%;
    height: auto;
    max-width: 100%; /* Menjaga gambar agar tidak melebihi lebar parent */
    max-height: 100%; /* Menjaga gambar agar tidak melebihi tinggi parent */
    box-shadow: 5px 5px 20px rgba(2, 2, 7, 7.1); /* Menambahkan efek bayangan */
}
/* Tambahkan warna merah ke ikon hati saat tombol di-like */
.button-footer .btn.liked i.fa-heart {
    color: red;
}



    .button-footer .btn:hover {
        background-color: rgba(0, 0, 0, 0.2); /* Set a slightly darker background color when hovered */
    }

    .show_modal_image img{
        width: 100%;
        height: 30%;

    }
    body {
            background-color: rgb(213, 213, 228);
        }



</style>
@section('js')
<script type="text/javascript">
function likefoto(fotoId, elem){
    var csrfToken = '{{csrf_token()}}';
    var likeCount = parseInt($('#'+fotoId+"-count").text());

    $.post('{{route('likefoto')}}', {fotoId: fotoId, _token: csrfToken}, function (data){
        console.log(data);

        if(data.status === 'success'){
            if(data.message === 'Liked'){
                $('#'+fotoId+"-count").text(likeCount+1);
                $(elem).addClass('liked'); // Menambahkan kelas 'liked' untuk mengubah warna tombol
            } else if(data.message === 'Unliked'){
                $('#'+fotoId+"-count").text(likeCount-1);
                $(elem).removeClass('liked'); // Menghapus kelas 'liked' untuk mengembalikan warna tombol ke semula
            }
        }
    });
}


</script>
@endsection



</script>

@endsection
