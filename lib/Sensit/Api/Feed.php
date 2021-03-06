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
     * '/api/topics/:topic_id/feeds' GET
     *
     */
    public function list(array $options = array())
    {
        $body = (isset($options['query']) ? $options['query'] : array());

        $response = $this->client->get('/api/topics/'.rawurlencode($this->topic_id).'/feeds', $body, $options);

        return $response;
    }

    /**
     * Returns a specific feed for a topic. Requires authorization of **read_any_data**, or **read_application_data**.
     * '/api/topics/:topic_id/feeds/:id' GET
     *
     */
    public function find(array $options = array())
    {
        $body = (isset($options['query']) ? $options['query'] : array());

        $response = $this->client->get('/api/topics/'.rawurlencode($this->topic_id).'/feeds/'.rawurlencode($this->id).'', $body, $options);

        return $response;
    }

    /**
     * Create a feed on a given topic. Requires authorization of **read_any_data**, or **read_application_data**.
     * '/api/topics/:topic_id/feeds' POST
     *
     * @param $feed A Hash containing `at`: a formatted time of the event. Defaults to the current time if not present.`tz`: The time zone of the time given in `at`. Defaults to UTC`data`:A hash of data to be stored
     */
    public function create($feed, array $options = array())
    {
        $body = (isset($options['body']) ? $options['body'] : array());
        $body['feed'] = $feed;

        $response = $this->client->post('/api/topics/'.rawurlencode($this->topic_id).'/feeds', $body, $options);

        return $response;
    }

    /**
     * Update an associated Feed to the Topic. Requires authorization of **read_any_data**, or **read_application_data**.
     * '/api/topics/:topic_id/feeds/:id' PUT
     *
     * @param $feed A hash containing `data`:A hash of data to be stored
     */
    public function update($feed, array $options = array())
    {
        $body = (isset($options['body']) ? $options['body'] : array());
        $body['feed'] = $feed;

        $response = $this->client->put('/api/topics/'.rawurlencode($this->topic_id).'/feeds/'.rawurlencode($this->id).'', $body, $options);

        return $response;
    }

    /**
     * Deletes the desired feed. Requires authorization of **read_any_data**, or **read_application_data**.
     * '/api/topics/:topic_id/feeds/:id' DELETE
     *
     */
    public function delete(array $options = array())
    {
        $body = (isset($options['body']) ? $options['body'] : array());

        $response = $this->client->delete('/api/topics/'.rawurlencode($this->topic_id).'/feeds/'.rawurlencode($this->id).'', $body, $options);

        return $response;
    }

}
