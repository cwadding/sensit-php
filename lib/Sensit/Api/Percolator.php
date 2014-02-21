<?php

namespace Sensit\Api;

use Sensit\HttpClient\HttpClient;

/**
 * A **Percolator** is a reverse query much like a match rule which is run whenever a new feed is added. These can be used to create alerts by causing the sensit to publish the feed that was just added. A percolator query is defined by a `name` and and valid `query` according to the according the the [elasticsearch Query DSL](http://www.elasticsearch.org/guide/en/elasticsearch/reference/current/query-dsl.html).  For more information about Percolator queries please refer to the [elasticsearch percolator documentation](http://www.elasticsearch.org/guide/en/elasticsearch/reference/current/search-percolate.html).
 *
 * @param $topic_id The key for the parent topic
 * @param $id The name of the percolator query
 */
class Percolator
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
     * Returns a list or percolators for a given topic. Requires authorization of **read_any_percolators**, or **read_application_percolators**.
     * '/topics/:topic_id/percolators' GET
     *
     */
    public function list(array $options = array())
    {
        $body = (isset($options['query']) ? $options['query'] : array());

        $response = $this->client->get('/topics/'.rawurlencode($this->topic_id).'/percolators', $body, $options);

        return $response;
    }

    /**
     * Return a specific percolator of the associated Topic by Id. Requires authorization of **read_any_percolators**, or **read_application_percolators**.
     * '/topics/:topic_id/percolators/:id' GET
     *
     */
    public function find(array $options = array())
    {
        $body = (isset($options['query']) ? $options['query'] : array());

        $response = $this->client->get('/topics/'.rawurlencode($this->topic_id).'/percolators/'.rawurlencode($this->id).'', $body, $options);

        return $response;
    }

    /**
     * Create a percolator on the associated Topic with the specified name and query. Requires authorization of **manage_any_percolators**, or **manage_application_percolators**.
     * '/topics/:topic_id/percolators' POST
     *
     * @param $percolator A Hash containing `name`: The name of the percolator(required).`query`: The query hash according to the according the the [elasticsearch Query DSL](http://www.elasticsearch.org/guide/en/elasticsearch/reference/current/query-dsl.html)
     */
    public function create($percolator, array $options = array())
    {
        $body = (isset($options['body']) ? $options['body'] : array());
        $body['percolator'] = $percolator;

        $response = $this->client->post('/topics/'.rawurlencode($this->topic_id).'/percolators', $body, $options);

        return $response;
    }

    /**
     * Update the query for a specific percolator. Requires authorization of **manage_any_percolators**, or **manage_application_percolators**.
     * '/topics/:topic_id/percolators/:id' PUT
     *
     * @param $percolator A Hash containing the `query` hash according to the according the the [elasticsearch Query DSL](http://www.elasticsearch.org/guide/en/elasticsearch/reference/current/query-dsl.html)
     */
    public function update($percolator, array $options = array())
    {
        $body = (isset($options['body']) ? $options['body'] : array());
        $body['percolator'] = $percolator;

        $response = $this->client->put('/topics/'.rawurlencode($this->topic_id).'/percolators/'.rawurlencode($this->id).'', $body, $options);

        return $response;
    }

    /**
     * Delete a percolator on the associated topic. Requires authorization of **manage_any_percolators**, or **manage_application_percolators**.
     * '/topics/:topic_id/percolators/:id' DELETE
     *
     */
    public function delete(array $options = array())
    {
        $body = (isset($options['body']) ? $options['body'] : array());

        $response = $this->client->delete('/topics/'.rawurlencode($this->topic_id).'/percolators/'.rawurlencode($this->id).'', $body, $options);

        return $response;
    }

}
