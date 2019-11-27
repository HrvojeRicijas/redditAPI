<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class PostController extends Controller
{
    public function fetch($sorting="1", $after=null, $direction=null){

        switch ($sorting){
            case 1:
                $sort="hot";
                break;
            case 2:
                $sort="top";
                break;
            case 3:
                $sort="new";
                break;
            case 4:
                $sort="rising";
                break;
            default:
                $sort="top";
        }

        $wantedUri = 'http://www.reddit.com/r/corgi/'.$sort.'.json';
        $client = new Client(['headers'=>['User-Agent'=>'windows:personalAPItesting:v1.0 (by /u/hrvojericijas)']]);
        $response = $client->get($wantedUri, [
            'query' => [
                'count' => 5,
                'limit' => 5,
                $direction => $after
            ]
        ]);

        $response=json_decode($response->getBody()->getContents())->data;

        return $response;

        //return redirect("/");
    }

    public function index($sorting="1", $after=null, $direction=null){

        $response=($this->fetch($sorting, $after, $direction));
        if (sizeof($response->children) == 0){
            $response=($this->fetch($sorting, null, $direction));
        }

        return view('index', [
            "response" => $response->children,
            "after" => $response->after, "sorting"=>$sorting, "before"=>$response->before , "responsetest"=>$response] );

    }
}
