@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-6">
            <form action="/api/get.albums" method="POST">
                {{ csrf_field() }}
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Вставьте ссылку на источник, где искать альбомы" aria-label="Вставьте ссылку на источник, где искать альбомы" name="user">
                    <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit">Далее <i class="fa fa-angle-right" aria-hidden="true"></i></button>
                </span>
                </div>
            </form>
        </div>
    </div>
@endsection