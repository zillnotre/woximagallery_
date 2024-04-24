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
                                        <div class="card-body">
                                            <div class="show_image">
                                                <div class="profile" style="display: flex; justify-content: space-between;">
                                                    @if(Auth::user()->id == $foto->user_id)
                                                    <form action="{{ route('foto.delete', $foto->id) }}" method="POST" id="deleteForm_{{ $foto->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" onclick="confirmDelete('{{ $foto->id }}')" class="delete-button">
                                                         <i class="fa fa-trash"></i>
                                                          </button>
                                                        <strong>
                                                            <small style="font-size: 25px;">
                                                                <i class="fa fa-user"></i>
                                                                {{ $foto->user->name }}
                                                            </small>
                                                        </strong>
                                                    </form>
                                                @else
                                                    <strong>
                                                        <small style="font-size: 25px;">
                                                            <i class="fa fa-user"></i>
                                                            {{ $foto->user->name }}
                                                        </small>
                                                    </strong>
                                                @endif






                                                    <small style="font-size: 15px;">{{$foto->created_at->diffForHumans()}}</small>
                                                </div>

                                              <hr>
                                                <a href="#{{$foto->id}}" data-bs-toggle="modal"><img src="{{asset('images/'.$foto->image)}}" style="width: 100%; height: auto;"></a>
                                            </div>
                                            <br>
                                            <div class="foto-footer" style="display: flex; flex-direction: column;">
                                                <div class="caption" style="text-align: left;">
                                                    <h5 style="font-size: 40px; font-weight: bold;">{{ $foto->judul_foto }}</h5>
                                                    <small style="font-size: 18px;" class="deskripsi_foto">  {{ $foto->deskripsi_foto }}</small>
                                                    <!-- Akses nama pengguna -->
                                                </div>

                                                <div class="button-footer" style="display: flex; align-items: center;">
                                                    <a class="btn btn-default btn-sm" href="#{{$foto->id}}" data-bs-toggle="modal"><i class="fa fa-comment" style="font-size: 40px;"></i></a>
                                                    <span class="btn btn-default btn-sm">{{$foto->comments()->count()}}</span>
                                                    <span class="btn btn-default btn-sm like-animation {{$foto->YouLiked() ? "liked" : ""}}" onclick="likefoto('{{ $foto->id }}', this)">
                                                        <i class="fa fa-heart" style="font-size: 40px;"></i>
                                                    </span>

                                                    </span>

                                                    <span class="btn btn-default btn-sm" id="{{$foto->id}}-count">{{$foto->likes()->count()}}</span>
                                                </div>
                                            </div>
                                        </div>
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

{{-- Modal --}}
@foreach($album->foto as $foto)
<div class="modal fade" id="{{$foto->id}}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="overflow-y: auto;">
            <div class="modal-body">
                <div class="show_modal_image">
                    <div style="display: flex; justify-content: space-between;">
                        <h1 style="font-size: 45px;"><strong>{{$foto->judul_foto}}</strong></h1>
                        <span class="user-time" style="font-size: 18px;"><small>{{$foto->created_at->diffForHumans()}}</small></span>
                    </div>
                    <hr>

                    <a href=""><img src="{{asset('images/'.$foto->image)}}" style="width: 100%; height: auto;"></a>
                </div>
                <br>
                <span style="font-size: 20px; font-size: 20px; font-family: sans-serif;" class="user-info"><strong>{{$foto->user->name}}</strong>  {{$foto->deskripsi_foto}}</span>
                <br>
                <br>

                <form action="{{ route('addComment', $foto->id) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <textarea type="text" name="isi_komentar" class="form-control" placeholder="Comment here"></textarea>
                    </div>
                    <button class="btn btn-primary btn-block w-100" type="submit" style="background-color: transparent; border-color: rgb(9, 9, 9); color: black; font-size: 20px;">Send</button>
                </form>
                <hr>
                <p style="font-size: 18px;">{{$foto->comments()->count()}}  Komentar</p>
                <div class="comment-list">
                    @if($foto->comments->isEmpty())
                    <div class="text-center">No Comment</div>
                    @else
                    @foreach($foto->comments as $comment)
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
                <span class="user-time"> {{$foto->created_at->format('d F Y H:i:s')}}</span>
            </div>
        </div>
    </div>
</div>
@endforeach



<style>
    body, p, h5, .card-header {
        font-family: 'Montserrat', sans-serif;
    }
    .montserrat {
        font-family: Montserrat, sans-serif;
    }

     .btn.liked i.fa-heart {
    color: red;
}

.like-animation {
    animation: pulse 0.6s ease;
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

.deskripsi_foto{
    font-family: sans-serif;
}
</style>
@section('js')
<script type="text/javascript">
 $(document).ready(function() {
        $('#uploadFoto').on('click', function() {
            // Periksa apakah pengguna memiliki album
            var hasAlbum = {{ Auth::user()->albums->isNotEmpty() ? 'true' : 'false' }};
            if (!hasAlbum) {
                // Tampilkan pesan error jika pengguna tidak memiliki album
                alert('Anda harus membuat album terlebih dahulu sebelum mengunggah foto.');
                return false; // Hentikan aksi mengunggah foto
            }
        });
    });
    function confirmDelete(fotoId) {
    if (confirm('Apakah kamu yakin ingin menghapus foto ini?')) {
        document.getElementById('deleteForm_' + fotoId).submit();
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

