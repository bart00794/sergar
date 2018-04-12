@extends('layouts.app')
@section('content')
    <div class="row">
        @foreach ($arAlbums as $arAlbum)
            <div class="col-md-2">
                <a href='/album/download/{{  $arAlbum["owner_id"] }}/{{  $arAlbum["id"] }}' target="_blank">
                    <img src="{{ $arAlbum["src"] }}" alt="">{{ $arAlbum["title"] }}</a>
            </div>
        @endforeach
    </div>
@endsection