<?php

namespace App\Http\Controllers;

use ATehnix\VkClient\Requests\Request;
use ATehnix\VkClient\Client;
use ATehnix\VkClient\Requests\ExecuteRequest;
use Illuminate\Http\Request as Requ;

class VkPhotos extends Controller
{
    static function Show($id)
    {
        if (session()->has('token_id')) {
            $arLiked = array();
            $arLiknt = array();
            $token = session("token_id");
            $api = new Client();
            $response = $api->request('photos.getAlbums', [
                'owner_id'  => $id,
                'need_system'   => 1
            ],$token);
            foreach($response["response"]["items"] as $album) {
                //pp($album);
                if($album['size']<1000){
                    //pp($album['size']);
                    $mes[] = new Request('photos.get', [
                        'owner_id' => $id,
                        "album_id" => $album['id'],
                        "extended" => 1
                    ]);
                }else{
                    $steps = intdiv($album['size'],1000);
                    for ($i = 0; $i <= $steps; $i++) {
                        $mes[] = new Request('photos.get', [
                            'owner_id' => $id,
                            "album_id" => $album['id'],
                            "extended" => 1,
                            "count" =>1000,
                            "offset"    => $i*1000
                        ]);
                    }
                }
            }
            $execute = ExecuteRequest::make($mes);
            $api->setDefaultToken($token);
            $response = $api->send($execute);
            //pp($response);
            //die();


            foreach ($response["response"] as $item) {
                if ($item["count"] > 0) {
                    foreach ($item["items"] as $arItem) {
                        if ($arItem["likes"]["user_likes"] == "1") {
                            $arLiked[] = $arItem;
                        } elseif ($arItem["likes"]["user_likes"] == "0") {
                            $arLiknt[] = $arItem;
                        }
                    }
                }
            }
            if (!empty($arLiked) || !empty($arLiknt)) {
                $totalPhotos = count($arLiked) + count($arLiknt);
                $totalLiked = count($arLiked);
                $percent = (100 * $totalLiked) / $totalPhotos;
                $percent = number_format($percent, 2);
                return view("photos", ["arLiked" => $arLiked, "arLiknt" => $arLiknt, "percent" => $percent]);
            }
        } else {
            return redirect('/auth/login');
        }
    }
    static function index(){
        return view('input');
    }
    //TODO:Обьеденить в одну функцию
    static function GetID(Requ $request){
        $user = $request->input('user');
        //pp(parse_url($user));
        $user = parse_url($user);
        $user = mb_substr( $user['path'], "1");
        //pp($user);

        $api = new Client;

        $response = $api->request('users.get', ['user_ids' => $user]);
        //pp($response["response"]["0"]["id"]);
        return redirect()->route('GetPhotos', ['id' => $response["response"]["0"]["id"]]);
    }
}
