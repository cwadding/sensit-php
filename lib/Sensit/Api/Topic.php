<?php

namespace Sensit\Api;

use Sensit\HttpClient\HttpClient;

/**
 * A topic is root that data is attached to. It is the equivalent of a source in searchlight/solink and acts as a table which has columns(Fields) and rows(Feeds).
 *
 */
class Topic
{

    private $client;

    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }

    /**
     * Requires authorization of **read_any_data**, or **read_application_data**.
     * '/api/topics' GET
     *
     */
    public function list(array $options = array())
    {
        $body = (isset($options['query']) ? $options['query'] : array());

        $response = $this->client->get('/api/topics', $body, $options);

        return $response;
    }

    /**
     * Requires authorization of **read_any_data**, or **read_application_data**.
     * '/api/topics/:id' GET
     *
     */
    public function find(array $options = array())
    {
        $body = (isset($options['query']) ? $options['query'] : array());

        $response = $this->client->get('/api/topics/:id', $body, $options);

        return $response;
    }

    /**
     * Requires authorization of **manage_any_data**, or **manage_application_data**.
     * '/api/topics' POST
     *
     * @param $topic A hash containing the name/id of the topic (required) and a description of the topic.
     */
    public function create($topic, array $options = array())
    {
        $body = (isset($options['body']) ? $options['body'] : array());
        $body['topic'] = $topic;

        $response = $this->client->post('/api/topics', $body, $options);

        return $response;
    }

    /**
     * Requires authorization of **manage_any_data**, or **manage_application_data**.
     * '/api/topics/:id' PUT
     *
     * @param $topic A hash containing the name/id of the topic (required) and a description of the topic.
     */
    public function update($topic, array $options = array())
    {
        $body = (isset($options['body']) ? $options['body'] : array());
        $body['topic'] = $topic;

        $response = $this->client->put('/api/topics/:id', $body, $options);

        return $response;
    }

    /**
     * Requires authorization of **manage_any_data**, or **manage_application_data**.
     * '/api/topics/:id' DELETE
     *
     */
    public function delete(array $options = array())
    {
        $body = (isset($options['body']) ? $options['body'] : array());

        $response = $this->client->delete('/api/topics/:id', $body, $options);

        return $response;
    }

}
