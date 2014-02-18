<?php

namespace Sensit\Api;

use Sensit\HttpClient\HttpClient;

/**
 * Get the value of a specific field within a feed
 *
 * @param $topic_id The key for the parent topic
 * @param $feed_id The id of the parent feed
 * @param $id The key of the specific field
 */
class Data
{

    private $topic_id;
    private $feed_id;
    private $id;
    private $client;

    public function __construct($topic_id, $feed_id, $id, HttpClient $client)
    {
        $this->topic_id = $topic_id;
        $this->feed_id = $feed_id;
        $this->id = $id;
        $this->client = $client;
    }

    /**
     * Requires authorization of **read_any_data**, or **read_application_data**.
     * '/topics/:topic_id/feeds/:feed_id/data/:id' GET
     *
     */
    public function find(array $options = array())
    {
        $body = (isset($options['query']) ? $options['query'] : array());

        $response = $this->client->get('/topics/'.rawurlencode($this->topic_id).'/feeds/'.rawurlencode($this->feed_id).'/data/'.rawurlencode($this->id).'', $body, $options);

        return $response;
    }

    /**
     * Update a specific value of a field within a feed with the data passed in. Requires authorization of **read_any_data**, or **read_application_data**.
     * '/topics/:topic_id/feeds/:feed_id/data/:id' PUT
     *
     */
    public function update(array $options = array())
    {
        $body = (isset($options['body']) ? $options['body'] : array());

        $response = $this->client->put('/topics/'.rawurlencode($this->topic_id).'/feeds/'.rawurlencode($this->feed_id).'/data/'.rawurlencode($this->id).'', $body, $options);

        return $response;
    }

}
