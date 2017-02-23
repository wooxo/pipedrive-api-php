<?php
/**
 * Created by PhpStorm.
 * User: antoine
 * Date: 23/02/2017
 * Time: 15:18
 */

namespace Benhawker\Pipedrive\Library;


class Files
{
    protected $curl;

    /**
     * Initialise the object load master class
     */
    public function __construct (\Benhawker\Pipedrive\Pipedrive $master) {
        //associate curl class
        $this->curl = $master->curl();
    }

    /**
     * Adds file(s)

     * @param  Object $data [files, deal_id, person_id, org_id, product_id, activity_id, note_id]

     *
     * @param  array $data activity details
     * @return array returns details of the activity
     */
    public function add ($data) {

        //if there is no subject or type set chuck error as both of the fields are required
        if (!isset($data['files'])) {
            throw new PipedriveMissingFieldError('You must include a file when');
        }

        return $this->curl->postFiles('files', $data);
    }
}