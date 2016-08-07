<?php
/**
 * Created by IntelliJ IDEA.
 * User: mcneely
 * Date: 8/6/16
 * Time: 12:20 PM
 */

namespace AppBundle\Service;

use GuzzleHttp;
use GuzzleHttp\Client;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class Http
 * @package AppBundle\Service
 * This classes exposes http routines from a injected Client library
 * This allows us to swap client libraries in the future if necessary.
 */
class Http
{
    /**
     * @var Client
     */
    protected $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $url
     * @return array|NotFoundHttpException
     * For now, anything other than a 200 status, we reject.
     */
    public function doGetRequestArray($url) {
        $response = $this->client->request('GET', $url);

        if("200" == $response->getStatusCode()) {
            return GuzzleHttp\json_decode($response->getBody(), true);
        }

        return new NotFoundHttpException;
    }
}