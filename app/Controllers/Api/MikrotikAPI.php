<?php

namespace App\Controllers\Api;

use App\Controllers\ApiBaseController;
use PEAR2\Net\RouterOS;
use App\Models\Password;
use CodeIgniter\API\ResponseTrait;

class MikrotikAPI extends ApiBaseController
{
    use ResponseTrait;

    public function index()
    {
        $data = ["message"=>"It works!"];   
        return $this->setResponseFormat('json')->respond($data);
    }

    public function get_bts_info()
    {
        $Password = new Password;

        if ($this->request->isAJAX()) {
            $password = $Password->find($this->request->getGet('password'));
            $ip_address = $this->request->getGet('ip_address');
            try {
                $client = new RouterOS\Client($ip_address, $password->username, $password->password);
            } catch (\Exception $e) {
                return $this->fail($e,500);
            }
            $request = new RouterOS\Request('/system/identity/print');
            $responses = $client->sendSync($request);
            foreach ($responses as $response) {
                if ($response->getType() === RouterOS\Response::TYPE_DATA) {
                    $identity = $response->getProperty('name');
                }
            }
            $request = new RouterOS\Request('/interface/wireless/print');
            $query = RouterOS\Query::where('disabled', 'no');
            $request->setQuery($query);
            $responses = $client->sendSync($request);
            foreach ($responses as $response) {
                if ($response->getType() === RouterOS\Response::TYPE_DATA) {
                    $data = [
                        'mode' => $response->getProperty('mode'),
                        'band' => $response->getProperty('band'),
                        'frequency' => $response->getProperty('frequency'),
                        'channel_width' => $response->getProperty('channel-width'),
                        'radio_name' => $response->getProperty('radio-name'),
                        'wireless_protocol' => $response->getProperty('wireless-protocol'),
                        'ssid' => $response->getProperty('ssid'),
                        'identity' => $identity
                    ];
                }
            }
            return $this->setResponseFormat('json')->respond($data);
        }
    }
}
