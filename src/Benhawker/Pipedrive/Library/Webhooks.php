<?php
/**
 * Created by PhpStorm.
 * User: plampson
 * Date: 20/02/2017
 * Time: 14:40
 */

namespace Benhawker\Pipedrive\Library;

use Benhawker\Pipedrive\Exceptions\PipedriveMissingFieldError;

class Webhooks {

    /**
     * Hold the pipedrive cURL session
     *
     * @var Curl Object
     */
    protected $curl;

    /**
     * Initialise the object load master class
     */
    public function __construct(\Benhawker\Pipedrive\Pipedrive $master) {
        //associate curl class
        $this->curl = $master->curl();
    }

    /**
     * @return array get all webhooks info
     */
    public function get() {
        return $this->curl->get('webhooks');
    }

    /**
     * @param array $data activity details
     * @return array returns details of the activity
     * @throws PipedriveMissingFieldError
     */
    public function add(array $data) {

        //if there is no subject or type set chuck error as both of the fields are required
        if (!isset($data['subscription_url'])) {
            throw new PipedriveMissingFieldError('You must include a "subscription_url" field when inserting a webhook');
        }

        return $this->curl->post('webhooks', $data);
    }

    /**
     * Update a activity
     * @param       $id
     * @return array
     */
    public function delete($id) {
        return $this->curl->delete('webhooks/' . $id);
    }


}