<?php namespace Benhawker\Pipedrive\Library;

use Benhawker\Pipedrive\Exceptions\PipedriveMissingFieldError;

class ActivityTypes
{
    /**
     * Hold the pipedrive cURL session
     *
     * @var \Benhawker\Pipedrive\Library\Curl Curl Object
     */
    protected $curl;

    /**
     * Initialise the object load master class
     */
    public function __construct (\Benhawker\Pipedrive\Pipedrive $master) {
        //associate curl class
        $this->curl = $master->curl();
    }

    /**
     * Returns all deal fields
     *
     * @return array returns all dealFields
     */
    public function getAll () {
        return $this->curl->get('activityTypes');
    }

    /**
     * Adds a dealField
     *
     * @param  array $data deal field detials
     *
     * @return array returns details of the deal field
     */
    public function add (array $data) {
        //if there is no name set throw error as it is a required field
        if (!isset($data['name'])) {
            throw new PipedriveMissingFieldError('You must include a "name" field when inserting a ActivityType');
        }

        return $this->curl->post('activityTypes', $data);
    }

}
