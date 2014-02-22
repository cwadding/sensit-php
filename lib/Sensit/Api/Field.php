<?php

namespace Sensit\Api;

use Sensit\HttpClient\HttpClient;

/**
 * .
 *
 * @param $topic_id The key for the parent topic
 * @param $id Username of the user
 */
class Field
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
     * Get all the fields associated with a topic. Requires authorization of **read_any_data**, or **read_application_data**
     * '/api/topics/:topic_id/fields' GET
     *
     */
    public function list(array $options = array())
    {
        $body = (isset($options['query']) ? $options['query'] : array());

        $response = $this->client->get('/api/topics/'.rawurlencode($this->topic_id).'/fields', $body, $options);

        return $response;
    }

    /**
     * Get a Field of the associated a topic and Id. Requires authorization of **read_any_data**, or **read_application_data**
     * '/api/topics/:topic_id/fields/:id' GET
     *
     */
    public function find(array $options = array())
    {
        $body = (isset($options['query']) ? $options['query'] : array());

        $response = $this->client->get('/api/topics/'.rawurlencode($this->topic_id).'/fields/'.rawurlencode($this->id).'', $body, $options);

        return $response;
    }

    /**
     * Adds a new field that feed data can be added too. Requires authorization of **manage_any_data**, or **manage_application_data**
     * '/api/topics/:topic_id/fields' POST
     *
     * @param $field A Hash containing`name`: A descriptive name of the field.`key`:The name that is used to identify the field in a feed (required).`datatype`:The type of data that is stored in the field. ie. integer, float, string, bool, datetime
     */
    public function create($field, array $options = array())
    {
        $body = (isset($options['body']) ? $options['body'] : array());
        $body['field'] = $field;

        $response = $this->client->post('/api/topics/'.rawurlencode($this->topic_id).'/fields', $body, $options);

        return $response;
    }

    /**
     * Updates the Field data and makes the corresponding changes in the index. Requires authorization of **manage_any_data**, or **manage_application_data**
     * '/api/topics/:topic_id/fields/:id' PUT
     *
     * @param $field A Hash containing`name`: A descriptive name of the field.`key`:The name that is used to identify the field in a feed (required).`datatype`:The type of data that is stored in the field. ie. integer, float, string, bool, datetime
     */
    public function update($field, array $options = array())
    {
        $body = (isset($options['body']) ? $options['body'] : array());
        $body['field'] = $field;

        $response = $this->client->put('/api/topics/'.rawurlencode($this->topic_id).'/fields/'.rawurlencode($this->id).'', $body, $options);

        return $response;
    }

    /**
     * Deletes a field and the feed data in that field. Requires authorization of **manage_any_data**, or **manage_application_data**
     * '/api/topics/:topic_id/fields/:id' DELETE
     *
     */
    public function delete(array $options = array())
    {
        $body = (isset($options['body']) ? $options['body'] : array());

        $response = $this->client->delete('/api/topics/'.rawurlencode($this->topic_id).'/fields/'.rawurlencode($this->id).'', $body, $options);

        return $response;
    }

}
