<?php

namespace App\Http\Traits;

use Illuminate\Http\Request;
use App\Http\Requests;
use GuzzleHttp\Client;
use config\constants;
use Redirect;
use Session;

trait GeneralServices {


    private $_client;
    public function __construct(Request $request) {
        $this->_client = new Client();
    }


    protected function POST($url,$data = [], $headers = [], $timeout = ['connection_timeout' => 600,'timeout'=> 600]){
        return json_decode($this->_client->POST($url,[
            'headers' => [
                'Authorization' => "Bearer ".Session::get('Users.credential ')
            ],
            'form_params' => $data,
            $timeout
        ])->getBody(),true);
    }
    protected function DELETE($url,$data = [], $headers = [], $timeout = ['connection_timeout' => 600,'timeout'=> 600]){
        return json_decode($this->_client->DELETE($url,[
            'headers' => [
                'Authorization' => "Bearer ".Session::get('Users.credential ')
            ],
            'form_params' => $data,
            $timeout
        ])->getBody(),true);
    }
    protected function PUT($url,$data = [], $headers = [], $timeout = ['connection_timeout' => 600,'timeout'=> 600]){
        return json_decode($this->_client->PUT($url,[
            'headers' => [
                'Authorization' => "Bearer ".Session::get('Users.credential ')
            ],
            'form_params' => $data,
            $timeout
        ])->getBody(),true);
    }

    protected function GET($url,$data = [], $headers = [], $timeout = ['connection_timeout' => 600,'timeout'=> 600]){
        return json_decode($this->_client->GET($url,[
            'form_params'   => $data,
            'headers' => [
                'Authorization' => "Bearer ".Session::get('Users.credential ')
            ],
            $timeout
        ])->getBody(),true);
    }

}