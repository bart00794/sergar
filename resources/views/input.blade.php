@extends('layouts.app')
@section('content')
<div class="row justify-content-center">
    <div class="col-6">
        <form action="" method="POST">
            {{ csrf_field() }}
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Ссылка на VK" name="user">
                <div class="input-group-append">
                    <button class="btn btn btn-primary" type="submit">Сканировать</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection