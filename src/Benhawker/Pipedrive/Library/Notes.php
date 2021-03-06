<?php namespace Benhawker\Pipedrive\Library;

use Benhawker\Pipedrive\Exceptions\PipedriveMissingFieldError;

/**
 * Pipedrive Notes Methods
 * Notes are pieces of textual (HTML-formatted) information that can be attached
 * to Deals, Persons and Organizations. Notes are usually displayed in the UI in
 * a chronological order – newest first – and in context with other updates
 * regarding the item they are attached to.
 */
class Notes {
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

    public function getMany($start) {
        return $this->curl->get("notes?start=$start&limit=100")['data'];
    }

    /**
     * Returns a note
     *
     * @param  int $id pipedrive note id
     * @return array returns detials of a user
     */
    public function getById($id) {
        return $this->curl->get('notes/' . $id);
    }

    /**
     * Adds a note
     *
     * @param  array $data note detials
     * @return array returns detials of the note
     */
    public function add(array $data) {
        //if there is no content set throw error as it is a required field
        if (!isset($data['content'])) {
            throw new PipedriveMissingFieldError('You must include a "content" field when inserting a note');
        }

        //if there is no deal, person, organisation id set throw error as one of the fields is required
        if (!isset($data['deal_id']) && !isset($data['person_id']) && !isset($data['org_id'])) {
            throw new PipedriveMissingFieldError('You must include one of the following "deal_id", "person_id", "org_id" field when inserting a note');
        }

        return $this->curl->post('notes', $data);
    }

    /**
     * Update a note
     *
     * @param       $id
     * @param array $data
     */
    public function update($id, array $data) {
        return $this->curl->put('notes/' . $id, $data);
    }
}
