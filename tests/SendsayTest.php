<?php

namespace Esdteam\Sendsay\Tests;

use Esdteam\Sendsay\Sendsay;
use PHPUnit\Framework\TestCase;

class SendsayTest extends TestCase
{
    public function testRequest()
    {
        $account = getenv('ACCOUNT');
        $apiKey = getenv('API_KEY');
        $sendsay = new Sendsay($account, $apiKey);
        $result = $sendsay->request('member.list');
        $this->assertTrue(count($result['list']) > 0);
    }
}