<?php

namespace Sensit\Api;

use Sensit\HttpClient\HttpClient;

/**
 * Publications are stored actions which are taken when a feed is created, updated, deleted, or there is a matching percolator query.
 *
 * @param $topic_id The key for the parent topic
 * @param $id The identifier of the publication
 */
class Publication
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
     * Get all publications for the associated Topic. Requires authorization of **read_any_publications**, or **read_application_publications**.
     * '/api/topics/:topic_id/publications' GET
     *
     */
    public function list(array $options = array())
    {
        $body = (isset($options['query']) ? $options['query'] : array());

        $response = $this->client->get('/api/topics/'.rawurlencode($this->topic_id).'/publications', $body, $options);

        return $response;
    }

    /**
     * Retrieve a specific publication on the associated topic by Id. Requires authorization of **read_any_publications**, or **read_application_publications**.
     * '/api/topics/:topic_id/publications/:id' GET
     *
     */
    public function find(array $options = array())
    {
        $body = (isset($options['query']) ? $options['query'] : array());

        $response = $this->client->get('/api/topics/'.rawurlencode($this->topic_id).'/publications/'.rawurlencode($this->id).'', $body, $options);

        return $response;
    }

    /**
     * Create a new publication on the associated Topic which can be easily retrieved later using an id. Requires authorization of **manage_any_publications**, or **manage_application_publications**.
     * '/api/topics/:topic_id/publications' POST
     *
     * @param $publication A Hash containing `host`:The ip address or host of the connection(required).`protocol`:the protocol to communicate over (http, tcp, udp, mqtt) (required)`port`:The port of the connection.
     */
    public function create($publication, array $options = array())
    {
        $body = (isset($options['body']) ? $options['body'] : array());
        $body['publication'] = $publication;

        $response = $this->client->post('/api/topics/'.rawurlencode($this->topic_id).'/publications', $body, $options);

        return $response;
    }

    /**
     * Update a publication. Requires authorization of **manage_any_publications**, or **manage_application_publications**.
     * '/api/topics/:topic_id/publications/:id' PUT
     *
     * @param $publication A Hash containing `host`:The ip address or host of the connection(required).`protocol`:the protocol to communicate over (http, tcp, udp, mqtt) (required)`port`:The port of the connection.
     */
    public function update($publication, array $options = array())
    {
        $body = (isset($options['body']) ? $options['body'] : array());
        $body['publication'] = $publication;

        $response = $this->client->put('/api/topics/'.rawurlencode($this->topic_id).'/publications/'.rawurlencode($this->id).'', $body, $options);

        return $response;
    }

    /**
     * Remove a saved publication on the associated Topic by Id. Requires authorization of **manage_any_publications**, or **manage_application_publications**.
     * '/api/topics/:topic_id/publications/:id' DELETE
     *
     */
    public function delete(array $options = array())
    {
        $body = (isset($options['body']) ? $options['body'] : array());

        $response = $this->client->delete('/api/topics/'.rawurlencode($this->topic_id).'/publications/'.rawurlencode($this->id).'', $body, $options);

        return $response;
    }

}
