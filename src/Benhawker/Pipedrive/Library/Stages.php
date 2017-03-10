<?php
/**
 * Created by PhpStorm.
 * User: plampson
 * Date: 04/11/2016
 * Time: 10:17
 */

namespace Benhawker\Pipedrive\Library;


class Stages {
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
     * Returns all deal fields
     *
     * @return array returns all dealFields
     */
    public function getAll()
    {
        return $this->curl->get('stages?pipeline_id=0')['data'];
    }

    public function getMany($start){
        return $this->curl->get('stages?start='.$start.'&limit=100')['data'];
    }
    /**
     * Returns a stage
     *
     * @param  int $id pipedrive stage id
     * @return array returns details of a stage
     */
    public function getById($id) {
        return $this->curl->get('stages/' . $id);
    }
}