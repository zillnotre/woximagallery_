@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Albums</div>
                <div class="card-body">
                    @if(count($albums) > 0)
                    <ul class="list-group">
                        @foreach($albums as $album)
                        <li class="list-group-item">
                            <a href="{{ route('albums.show', $album->id) }}">{{ $album->nama_album }}</a>
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <p>No albums found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
