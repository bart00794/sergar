<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use ATehnix\VkClient\Auth;

class VkAuth extends Controller
{
    protected $auth;

    public function __construct()
    {
        $this->auth = new Auth("6142886","pu0uK5RofbtzLhBwQEcV","http://sergar.et/auth/login","photos");
    }
    function GetToken(Input $input){
        if($input::has("code")){
            $token = $this->auth->getToken($input::get("code"));
            session(["token_id"=>$token]);
            return redirect("/");
        }else
            return redirect($this->auth->getUrl());
    }
}
