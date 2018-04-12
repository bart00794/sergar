@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-md-4">
        <i class="fa fa-users" aria-hidden="true"></i>
        <a href="/friends">Друзья</a>
    </div>
    <div class="col-md-4">
        <i class="fa fa-camera" aria-hidden="true"></i>
        <a href="/photos">Сколько фоток пролайкано?</a>
    </div>
    <div class="col-md-4">
        <i class="fa fa-camera" aria-hidden="true"></i>
        <a href="/hidefriend">Скрывающие Вас друзья</a>
    </div>
    <div class="col-md-4">
        <i class="fa fa-picture-o" aria-hidden="true"></i>
        <a href="/album/show">Список альбомов</a>
    </div>
    <div class="col-md-4">
        <i class="fa fa-download" aria-hidden="true"></i>
        <a href="/album/download">Скачать альбом</a>
    </div>
</div>
@endsection