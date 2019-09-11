<?php
namespace App\Providers;

class SigWSService
{
    protected static $urlBase = "http://www.sigws.uema.br/wservice";
    protected static $appToken = '7d1a7ef38811eae678c5ea8c6440e212';
    protected static $appName = 'sigconcursos';


    public static function login($userData)
    {
        $login = $userData["login"];
        $senha = $userData["senha"];
        $urlLogin = SigWSService::$urlBase . '/login?login=' . $login . '&senha=' . $senha;

        $guzzleClient = new GuzzleHttp\Client(['base_uri' => $urlLogin, [
            'headers' => ['appName' => SigWSService::$appName, 'appToken' => SigWSService::$appToken, 'Content-Type' => 'application/json'],
            'decode_content' => false
        ]]);

        $client = json_api()->client($guzzleClient);

        $response = $client->request('GET');
        var_dump($response);
        return $response;
    }
}
