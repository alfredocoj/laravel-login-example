<?php
namespace App\Providers;

use GuzzleHttp;

class SigWSService
{
    protected static $urlBase = "http://www.sigws.uema.br/wservice";
    protected static $appToken = '7d1a7ef38811eae678c5ea8c6440e212';
    protected static $appName = 'sigconcursos';


    public static function login($userData)
    {
        $login = $userData["login"];
        //$login = md5($userData["login"]);
        $senha = $userData["senha"];
        $urlLogin = SigWSService::$urlBase . '/login?login=' . $login . '&senha=' . $senha;
        //$urlLogin = SigWSService::$urlBase . '/login?login=' . $login;

        $guzzleClient = new GuzzleHttp\Client();

        $request = $guzzleClient->get($urlLogin, [
            'headers' => ['appName' => SigWSService::$appName, 'appToken' => SigWSService::$appToken, 'Content-Type' => 'application/json']
        ]);
        $response = json_decode($request->getBody());
        //var_dump(var_export($response,true));
        dd($response);
        return $response;
    }
}
