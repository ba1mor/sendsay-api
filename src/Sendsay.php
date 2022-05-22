<?php

namespace Esdteam\Sendsay;

class Sendsay
{
    const REQUEST_INTERVAL = 25000;

    private $apiEndpoint = 'https://api.sendsay.ru/general/api/v100/json/';
    private $account = '';
    private $apiKey = '';

    private $requestSucceed = false;
    private $lastError = null;

    public function __construct($account, $apiKey)
    {
        $this->account = $account;
        $this->apiKey = $apiKey;
    }

    public function request($method, $payload = [])
    {
        usleep(self::REQUEST_INTERVAL);
        $this->lastError = null;
        $this->requestSucceed = false;
        $payload['action'] = $method;
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $this->apiEndpoint . $this->account,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'Authorization: sendsay apikey=' . $this->apiKey
            ],
        ]);
        //$headers = curl_getinfo($curl);
        $response = curl_exec($curl);
        $errors = curl_error($curl);
        curl_close($curl);
        if ($errors) {
            $this->lastError = $errors;
            return null;
        }
        $data = json_decode($response, true);
        if (isset($data['errors']) || isset($data['warnings'])) {
            $this->lastError = $data['errors'] ?: $data['warnings'];
            return null;
        }
        $this->requestSucceed = true;
        return $data;
    }

    public function success()
    {
        return $this->requestSucceed;
    }

    public function getLastError()
    {
        return $this->lastError;
    }
}