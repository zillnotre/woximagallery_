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
                <div class="card-header" style="font-size: 45px; margin-bottom: 0;">Selamat Datang Di Woxima, {{Auth::user()->nama_lengkap}}!</div>
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
                            <div class="profile" style="display: flex; justify-content: space-between;">
                                @if(Auth::user()->id == $fot->user_id)
                                <form action="{{ route('foto.delete', $fot->id) }}" method="POST" id="deleteForm">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete()" class="delete-button">
                                        <i class="fa fa-trash"></i> <!-- Tambahkan ikon Font Awesome untuk hapus -->
                                    </button>
                                    <strong>
                                        <small style="font-size: 25px;">
                                            <i class="fa fa-user"></i>
                                            {{ $fot->user->name }}
                                        </small>
                                    </strong>
                                </form>
                            @else
                                <strong>
                                    <small style="font-size: 25px;">
                                        <i class="fa fa-user"></i>
                                        {{ $fot->user->name }}
                                    </small>
                                </strong>
                            @endif






                                <small style="font-size: 15px;">{{$fot->created_at->diffForHumans()}}</small>
                            </div>

                          <hr>
                            <a href="#{{$fot->id}}" data-bs-toggle="modal"><img src="{{asset('images/'.$fot->image)}}" style="width: 100%; height: auto;"></a>
                        </div>
                        <br>
                        <div class="foto-footer" style="display: flex; flex-direction: column;">
                            <div class="caption" style="text-align: left;">
                                <h5 style="font-size: 40px; font-weight: bold;">{{ $fot->judul_foto }}</h5>
                                <small style="font-size: 18px;" class="deskripsi_foto">  {{ $fot->deskripsi_foto }}</small>
                                <!-- Akses nama pengguna -->
                            </div>

                            <div class="button-footer" style="display: flex; align-items: center;">
                                <a class="btn btn-default btn-sm" href="#{{$fot->id}}" data-bs-toggle="modal"><i class="fa fa-comment" style="font-size: 40px;"></i></a>
                                <span class="btn btn-default btn-sm">{{$fot->comments()->count()}}</span>
                                <span class="btn btn-default btn-sm like-animation {{$fot->YouLiked() ? "liked" : ""}}" onclick="likefoto('{{ $fot->id }}', this)">
                                    <i class="fa fa-heart" style="font-size: 40px;"></i>
                                </span>

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
        <div class="modal-content" style="overflow-y: auto;">
            <div class="modal-body">
                <div class="show_modal_image">
                    <div style="display: flex; justify-content: space-between;">
                        <h1 style="font-size: 45px;"><strong>{{$fot->judul_foto}}</strong></h1>
                        <span class="user-time" style="font-size: 18px;"><small>{{$fot->created_at->diffForHumans()}}</small></span>
                    </div>
                    <hr>

                    <a href=""><img src="{{asset('images/'.$fot->image)}}" style="width: 100%; height: auto;"></a>
                </div>
                <br>
                <span style="font-size: 20px; font-size: 20px; font-family: sans-serif;" class="user-info"><strong>{{$fot->user->name}}</strong>  {{$fot->deskripsi_foto}}</span>
                <br>
                <br>

                <form action="{{ route('addComment', $fot->id) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <textarea type="text" name="isi_komentar" class="form-control" placeholder="Comment here"></textarea>
                    </div>
                    <button class="btn btn-primary btn-block w-100" type="submit" style="background-color: transparent; border-color: rgb(9, 9, 9); color: black; font-size: 20px;">Send</button>
                </form>
                <hr>
                <p style="font-size: 18px;">{{$fot->comments()->count()}}  Komentar</p>
                <div class="comment-list">
                    @if($fot->comments->isEmpty())
                    <div class="text-center">No Comment</div>
                    @else
                    @foreach($fot->comments as $comment)
                    <div class="comment-body">
                        <p style="color: black; font-size: 25px; font-family: sans-serif;"><i class="fa fa-user"></i> <strong>{{$comment->user->name}}</strong> </p>
                        <p style="font-size: 20px; font-family: sans-serif;">{{$comment->isi_komentar}}</p>
                        <br>
                        <div class="comment-info">
                            <span class="btn btn-default btn-xs"></span>
                            <span class="pull-right">

                                <span>{{$comment->created_at->diffForHumans()}}</span>
                            </span>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
                <span class="user-time"> {{$fot->created_at->format('d F Y H:i:s')}}</span>
            </div>
        </div>
    </div>
</div>
@endforeach




    </div> <!--End Container-->
</div>


<style>
    /* CSS untuk animasi tombol */
.button-footer .btn:hover {
    background-color: rgba(0, 0, 0, 0.2); /* Set a slightly darker background color when hovered */
    transition: background-color 0.3s ease; /* Animasi transisi untuk perubahan warna latar belakang */
}



    .button-footer .btn {

        /* background-color: rgba(0, 0, 0, 0.1);
        color: rgba(0, 0, 0, 0.9);
        margin: 3px;
        padding: 3px 10px; */

    }

    .modal-title,
    .modal-body,
    .modal-footer {
        color: black;
    }
    .show_image img {
        width: 100%;
    height: auto;
    max-width: 100%; /* Menjaga gambar agar tidak melebihi lebar parent */
    max-height: 100%; /* Menjaga gambar agar tidak melebihi tinggi parent */
    /* box-shadow: 5px 5px 20px rgba(2, 2, 7, 7.1);  */
}

.show_modal_image img {
        width: 100%;
    height: auto;
    max-width: 100%; /* Menjaga gambar agar tidak melebihi lebar parent */
    max-height: 100%; /* Menjaga gambar agar tidak melebihi tinggi parent */
    /* box-shadow: 5px 5px 40px rgba(2, 2, 7, 7.1); */
}
/* Tambahkan warna merah ke ikon hati saat tombol di-like */
.button-footer .btn.liked i.fa-heart {
    color: red;
}

.like-animation {
    animation: pulse 0.6s ease;
}


.comment-body {
    padding: 12px;
    border-top-right-radius: 30px;
    border-bottom-left-radius: 30px;
    border-bottom-right-radius: 30px;
    border: 1px solid rgba(0, 0, 0, 0.2);
    margin-bottom: 17px;
    font-size: 20px;
}

.comment-body p{
    font-size: 20px;
    margin-bottom: 10px;

}




    .button-footer .btn:hover {
        background-color: rgba(0, 0, 0, 0.2); /* Set a slightly darker background color when hovered */
    }

    .show_modal_image img{
        width: 100%;
        height: 30%;

    }
    .delete-button {
    border: none; /* Menghilangkan border */
    background: none; /* Menghilangkan background */
    padding: 0; /* Menghilangkan padding */
    margin-right: 10px;
}
.delete-button i.fa-trash {
    font-size: 30px; /* Sesuaikan dengan ukuran yang diinginkan */
}
    body {
            background-color: rgb(231, 231, 236);
        }
        .card{
            border-radius: 20px;
        }

        element.style{
            font-size: 100px;
        }
        body {
    font-family: 'Montserrat', sans-serif;
    color: rgb(6, 5, 5);
}

.deskripsi_foto {
        font-family: sans-serif;
        /* Tambahkan properti lain sesuai kebutuhan Anda */
    }




</style>
@section('js')
<script type="text/javascript">
 function confirmDelete() {
        if (confirm('Apakah kamu yakin ingin menghapus foto ini?')) {
            document.getElementById('deleteForm').submit();
        }
    }
    function likefoto(fotoId, elem){
    var csrfToken = '{{csrf_token()}}';
    var likeCount = parseInt($('#'+fotoId+"-count").text());

    $.post('{{route('likefoto')}}', {fotoId: fotoId, _token: csrfToken}, function (data){
        console.log(data);

        if(data.status === 'success'){
            if(data.message === 'Liked'){
                $('#'+fotoId+"-count").text(likeCount+1);
                $(elem).addClass('liked'); // Menambahkan kelas 'liked' untuk mengubah warna tombol
                $(elem).addClass('like-animation'); // Menambahkan kelas 'like-animation' untuk memicu animasi pulse
                $(elem).animate({fontSize: '+=5px'}, 'fast'); // Animasi scaling tombol saat like diberikan

                // Tambahkan kelas 'like-animation' secara manual
                $(elem).addClass('like-animation');
            } else if(data.message === 'Unliked'){
                $('#'+fotoId+"-count").text(likeCount-1);
                $(elem).removeClass('liked'); // Menghapus kelas 'liked' untuk mengembalikan warna tombol ke semula
                $(elem).removeClass('like-animation'); // Menghapus kelas 'like-animation' agar animasi pulse berhenti
                $(elem).animate({fontSize: '-=5px'}, 'fast'); // Animasi scaling tombol saat like dicabut
            }
        }
    });
}





</script>
@endsection



</script>

@endsection

