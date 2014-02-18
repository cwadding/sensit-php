<?php

namespace Sensit;

use Sensit\HttpClient\HttpClient;

class Client
{
    private $httpClient;

    public function __construct($auth = array(), array $options = array())
    {
        $this->httpClient = new HttpClient($auth, $options);
    }

    /**
     * <no value>
     *
     */
    public function user()
    {
        return new Api\User($this->httpClient);
    }

    /**
     * A topic is root that data is attached to. It is the equivalent of a source in searchlight/solink and acts as a table which has columns(Fields) and rows(Feeds).
     *
     */
    public function topic()
    {
        return new Api\Topic($this->httpClient);
    }

    /**
     * Returns api instance to get auxilary information about Buffer useful when creating your app.
     *
     * @param $topic_id The key for the parent topic
     * @param $id The id of the feed
     */
    public function feed($topic_id, $id)
    {
        return new Api\Feed($topic_id, $id, $this->httpClient);
    }

    /**
     * Get the value of a specific field within a feed
     *
     * @param $topic_id The key for the parent topic
     * @param $feed_id The id of the parent feed
     * @param $id The key of the specific field
     */
    public function data($topic_id, $feed_id, $id)
    {
        return new Api\Data($topic_id, $feed_id, $id, $this->httpClient);
    }

    /**
     * A **Percolator** is a reverse query much like a match rule which is run whenever a new feed is added. These can be used to create alerts by causing the sensit to publish the feed that was just added. A percolator query is defined by a `name` and and valid `query` according to the according the the [elasticsearch Query DSL](http://www.elasticsearch.org/guide/en/elasticsearch/reference/current/query-dsl.html).  For more information about Percolator queries please refer to the [elasticsearch percolator documentation](http://www.elasticsearch.org/guide/en/elasticsearch/reference/current/search-percolate.html).
     *
     * @param $topic_id The key for the parent topic
     * @param $id The name of the percolator query
     */
    public function percolator($topic_id, $id)
    {
        return new Api\Percolator($topic_id, $id, $this->httpClient);
    }

    /**
     * Reports are stored filter and facet queries on the **Feed** data. A report is a assigned a `name` and the `query` is any elasticsearch query which filters only the desired data for the facets (See the [elasticsearch Query DSL](http://www.elasticsearch.org/guide/en/elasticsearch/reference/current/query-dsl-queries.html) for valid queries). A report can have many `facets` with each facet is referred to by a user defined `name`. Valid `type`'s of facet include **terms**, **range**, **histogram**, **filter**, **statistical**, **query**, **terms_stats**, or **geo_distance**. The `query` within a facet defines the field counts or statistics which the data is calculated over. See the [elasticsearch facet dsl](http://www.elasticsearch.org/guide/en/elasticsearch/reference/current/search-facets.html) for information about the various facet types and valid query fields.
     *
     * @param $topic_id The key for the parent topic
     * @param $id The identifier of the report
     */
    public function report($topic_id, $id)
    {
        return new Api\Report($topic_id, $id, $this->httpClient);
    }

    /**
     * Subscriptions allows feed data to imported using a socket rather than just using the Feed REST API. By creating a subscription sensit will start to listen for feed data being imported using the specified `host` and while using the topic name as the `channel` name.
     *
     * @param $id The identifier for the subscription
     */
    public function subscription($id)
    {
        return new Api\Subscription($id, $this->httpClient);
    }

    /**
     * .
     *
     * @param $topic_id The key for the parent topic
     * @param $id Username of the user
     */
    public function field($topic_id, $id)
    {
        return new Api\Field($topic_id, $id, $this->httpClient);
    }

}
