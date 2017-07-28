<?php
/**
 * Created by PhpStorm.
 * User: plampson
 * Date: 28/07/2017
 * Time: 09:33
 */

namespace Benhawker\Pipedrive\Library;


class Filters {

    /**
     * Hold the pipedrive cURL session
     *
     * @var \Benhawker\Pipedrive\Library\Curl Curl Object
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
     * Returns all Filters fields
     *
     * @return array returns all Filters
     */
    public function getAll($type = null) {
        if ($type) {
            return $this->curl->get('filters?type=' . $type)['data'];
        }
        return $this->curl->get('filters')['data'];
    }

    /**
     * Returns a filter
     *
     * @param  int $id pipedrive filter id
     * @return array returns details of a filter
     */
    public function getById($id) {
        return $this->curl->get('filters/' . $id);
    }

    public function findByName($name, $type = null) {
        $allFilter = $this->getAll($type);
        foreach ($allFilter as $filter) {
            if ($filter['name'] == $name) {
                return $filter;
            }
        }
        return false;
    }

    public function add(array $data) {

        //if there is no subject or type set chuck error as both of the fields are required
        if (!isset($data['name']) or !isset($data['type']) or !isset($data['conditions'])) {
            throw new PipedriveMissingFieldError('You must include both a "name" and "type"  and "conditions" field when inserting a filter');
        }

        return $this->curl->post('filters', $data);
    }
}