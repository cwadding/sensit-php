<?php

namespace Sensit\Api;

use Sensit\HttpClient\HttpClient;

/**
 * <no value>
 *
 */
class User
{

    private $client;

    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }

    /**
     * <no value>
     * '/user' GET
     *
     */
    public function profile(array $options = array())
    {
        $body = (isset($options['query']) ? $options['query'] : array());

        $response = $this->client->get('/user', $body, $options);

        return $response;
    }

}
