<?php

namespace Sensit\Api;

use Sensit\HttpClient\HttpClient;

/**
 * Returns api instance to get auxilary information about Buffer useful when creating your app.
 *
 * @param $topic_id The key for the parent topic
 * @param $id The id of the feed
 */
class Feed
{

    private $topic_id;
    private $id;
    private $client;

    public function __construct($topic_id, $id, HttpClient $client)
    {
        $this->topic_id = $topic_id;
        $this->id = $id;
        $this->client = $client;
    }

    /**
     * Returns a list of feeds for a given topic. Requires authorization of **read_any_data**, or **read_application_data**.
     * '/topics/:topic_id/feeds' GET
     *
     */
    public function list(array $options = array())
    {
        $body = (isset($options['query']) ? $options['query'] : array());

        $response = $this->client->get('/topics/'.rawurlencode($this->topic_id).'/feeds', $body, $options);

        return $response;
    }

    /**
     * Returns a specific feed for a topic. Requires authorization of **read_any_data**, or **read_application_data**.
     * '/topics/:topic_id/feeds/:id' GET
     *
     */
    public function find(array $options = array())
    {
        $body = (isset($options['query']) ? $options['query'] : array());

        $response = $this->client->get('/topics/'.rawurlencode($this->topic_id).'/feeds/'.rawurlencode($this->id).'', $body, $options);

        return $response;
    }

    /**
     * Create a feed on a given topic. Requires authorization of **read_any_data**, or **read_application_data**.
     * '/topics/:topic_id/feeds' POST
     *
     * @param $data A hash of data to be stored
     */
    public function create($data, array $options = array())
    {
        $body = (isset($options['body']) ? $options['body'] : array());
        $body['data'] = $data;

        $response = $this->client->post('/topics/'.rawurlencode($this->topic_id).'/feeds', $body, $options);

        return $response;
    }

    /**
     * Update an associated Feed to the Topic. Requires authorization of **read_any_data**, or **read_application_data**.
     * '/topics/:topic_id/feeds/:id' PUT
     *
     * @param $data A hash of data to be stored
     */
    public function update($data, array $options = array())
    {
        $body = (isset($options['body']) ? $options['body'] : array());
        $body['data'] = $data;

        $response = $this->client->put('/topics/'.rawurlencode($this->topic_id).'/feeds/'.rawurlencode($this->id).'', $body, $options);

        return $response;
    }

    /**
     * Deletes the desired feed. Requires authorization of **read_any_data**, or **read_application_data**.
     * '/topics/:topic_id/feeds/:id' DELETE
     *
     */
    public function delete(array $options = array())
    {
        $body = (isset($options['body']) ? $options['body'] : array());

        $response = $this->client->delete('/topics/'.rawurlencode($this->topic_id).'/feeds/'.rawurlencode($this->id).'', $body, $options);

        return $response;
    }

}
