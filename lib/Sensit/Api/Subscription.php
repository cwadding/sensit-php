<?php

namespace Sensit\Api;

use Sensit\HttpClient\HttpClient;

/**
 * Subscriptions allows feed data to imported using a socket rather than just using the Feed REST API. By creating a subscription sensit will start to listen for feed data being imported using the specified `host` and while using the topic name as the `channel` name.
 *
 * @param $id The identifier for the subscription
 */
class Subscription
{

    private $id;
    private $client;

    public function __construct($id, HttpClient $client)
    {
        $this->id = $id;
        $this->client = $client;
    }

    /**
     * Get the list of all subscriptions for importing feed data to the associated topics. Requires authorization of **read_any_subscriptions**, or **read_application_subscriptions**.
     * '/subscriptions' GET
     *
     */
    public function list(array $options = array())
    {
        $body = (isset($options['query']) ? $options['query'] : array());

        $response = $this->client->get('/subscriptions', $body, $options);

        return $response;
    }

    /**
     * Get the information of a specific subscription. Requires authorization of **read_any_subscriptions**, or **read_application_subscriptions**.
     * '/subscriptions/:id' GET
     *
     */
    public function find(array $options = array())
    {
        $body = (isset($options['query']) ? $options['query'] : array());

        $response = $this->client->get('/subscriptions/'.rawurlencode($this->id).'', $body, $options);

        return $response;
    }

    /**
     * Create a subscription which will connect to the server and listen for feed data for any of the associated topics. Requires authorization of **manage_any_subscriptions**, or **manage_application_subscriptions**.
     * '/subscriptions' POST
     *
     * @param $name The channel or name to identify the subscription.
     * @param $host The ip address or host of the connection
     * @param $protocol the protocol to comminivate over
     */
    public function create($name, $host, $protocol, array $options = array())
    {
        $body = (isset($options['body']) ? $options['body'] : array());
        $body['name'] = $name;
        $body['host'] = $host;
        $body['protocol'] = $protocol;

        $response = $this->client->post('/subscriptions', $body, $options);

        return $response;
    }

    /**
     * Returns an object with the current configuration that Buffer is using, including supported services, their icons and the varying limits of character and schedules.  Requires authorization of **manage_any_subscriptions**, or **manage_application_subscriptions**.
     * '/subscriptions/:id' PUT
     *
     * @param $name The channel or name to identify the subscription.
     * @param $host The ip address or host of the connection
     * @param $protocol the protocol to comminivate over
     */
    public function update($name, $host, $protocol, array $options = array())
    {
        $body = (isset($options['body']) ? $options['body'] : array());
        $body['name'] = $name;
        $body['host'] = $host;
        $body['protocol'] = $protocol;

        $response = $this->client->put('/subscriptions/'.rawurlencode($this->id).'', $body, $options);

        return $response;
    }

    /**
     * Delete the subscription and stop listening for feed data for the associated topics. Requires authorization of **manage_any_subscriptions**, or **manage_application_subscriptions**.
     * '/subscriptions/:id' DELETE
     *
     */
    public function delete(array $options = array())
    {
        $body = (isset($options['body']) ? $options['body'] : array());

        $response = $this->client->delete('/subscriptions/'.rawurlencode($this->id).'', $body, $options);

        return $response;
    }

}
