@extends('layouts.app')
@if(Session::has('success'))
<div class="alert alert-success">
    {{ Session::get('success') }}
</div>
@endif


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Selamat Datang, {{Auth::user()->nama_lengkap}}!</div>


            </div>
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
                <textarea name="deskripsi_foto" placeholder="Masukkan Deskripsi...
                " class="form-control
                "></textarea>
            </div>

            <br>
            <button type="submit" class="btn btn-primary" style="width: 100%;">Save</button>


         </form>
        </div>

      </div>
    </div>
  </div>



@endsection
