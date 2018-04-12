@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h3>Прогресс {{$percent}}%</h3>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: {{$percent}}%" aria-valuenow="{{$percent}}" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
        <div class="col-md-6">
            <h3>Лайкнуты @php echo count($arLiked);@endphp</h3>
            <div class="row">
                @foreach ($arLiked as $arLike)
                    <?//dd($arLike);?>
                    <div class="col-md-3">
                        <a href='https://vk.com/photo{{  $arLike["owner_id"] }}_{{  $arLike["id"] }}' target="_blank">
                            <img src="{{ $arLike["photo_130"] }}" alt=""></a>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-6">
            <h3>Еще не лайкнуты @php echo count($arLiknt);@endphp</h3>
            <div class="row">
                @foreach ($arLiknt as $arLikn)
                    <div class="col-md-3">
                        <a href='https://vk.com/photo{{  $arLikn["owner_id"] }}_{{  $arLikn["id"] }}' target="_blank">
                            <img src="{{ $arLikn["photo_130"] }}" alt=""></a>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-12">

        </div>
    </div>
@endsection