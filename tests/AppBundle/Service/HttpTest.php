<?php
/**
 * Created by IntelliJ IDEA.
 * User: mcneely
 * Date: 8/7/16
 * Time: 10:02 PM
 */

namespace tests\AppBundle\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use AppBundle\Service\Http;

class HttpTest extends TestCase
{
    /**
     * Mock's http client and returned response object.
     * Send's json to be parsed by method.
     */
    public function testDoGetRequestArray()
    {

        $response = $this->createMock(Response::class);
        $response->method('getStatusCode')->willReturn("200");
        $response->method('getBody')->willReturn('{"foo":"bar"}');

        $client = $this->createMock(Client::class);
        $client->method('request')->willReturn($response);

        $http = new Http($client);
        $array = $http->doGetRequestArray("http://it.doesn't.matter");
        $this->assertSame("bar", $array["foo"]);

    }
}