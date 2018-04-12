<?php

namespace App\Http\Controllers;

use ATehnix\VkClient\Requests\Request;
use ATehnix\VkClient\Client;
use ATehnix\VkClient\Requests\ExecuteRequest;
use Illuminate\Http\Request as Requ;

class VkAlbum extends Controller
{
    static function Show($id){
        if(session()->has('token_id')){
            $token = session("token_id");
            $api = new Client();
            $response = $api->request('photos.getAlbums', [
                'owner_id'  => $id,
                'need_system'   => 1
            ],$token);
            $thumb = "";
            $arAlbums = $response["response"]["items"];
            foreach($arAlbums as &$arAlbum) {
                $photos_id = $id."_".$arAlbum["thumb_id"];
                $response = $api->request('photos.getById', [
                    'photos'  => $photos_id
                ],$token);
                $arAlbum["src"] = $response["response"]["0"]["photo_130"];
            }
            //pp($arAlbums);
            return view("albums", ["arAlbums" => $arAlbums]);
        }else{
            return redirect('/auth/login');
        }
    }
    function download($owner_id,$album_id){
        pp($owner_id);
        pp($album_id);
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
        return redirect()->route('GetAlbums', ['id' => $response["response"]["0"]["id"]]);
    }

}
