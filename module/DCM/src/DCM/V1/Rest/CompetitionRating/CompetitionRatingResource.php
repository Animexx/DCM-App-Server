<?php
namespace DCM\V1\Rest\CompetitionRating;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;

class CompetitionRatingResource extends AbstractResourceListener
{

	/** @var CompetitionRatingStorageMapper $storageMapper */
	protected $storageMapper;

	/**
	 * @param CompetitionRatingStorageMapper $storageMapper
	 */
	public function __construct($storageMapper)
	{
		$this->storageMapper = $storageMapper;
	}

	/**
	 * @return int
	 */
	protected function getCurrentCompetitionId() {
		return $this->getEvent()->getRouteMatch()->getParam("competition_id");
	}
	/**
	 * @return int
	 */
	protected function getCurrentParticipantId() {
		return $this->getEvent()->getRouteMatch()->getParam("participant_id");
	}



	/**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
        return new ApiProblem(405, 'The POST method has not been defined');
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for individual resources');
    }

    /**
     * Delete a collection, or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function deleteList($data)
    {
        return new ApiProblem(405, 'The DELETE method has not been defined for collections');
    }

    /**
     * Fetch a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function fetch($id)
    {
        return new ApiProblem(405, 'The GET method has not been defined for individual resources');
    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = array())
    {
		$competition_id = $this->getCurrentCompetitionId();
		$participant_id = $this->getCurrentParticipantId();
		$adapter = new CompetitionRatingPaginatorAdapter($this->storageMapper, $competition_id, $participant_id);
		$collection = new CompetitionRatingCollection($adapter);
		return $collection;
    }

    /**
     * Patch (partial in-place update) a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function patch($id, $data)
    {
        return new ApiProblem(405, 'The PATCH method has not been defined for individual resources');
    }

    /**
     * Replace a collection or members of a collection
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function replaceList($data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for collections');
    }

    /**
     * Update a resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function update($id, $data)
    {
        return new ApiProblem(405, 'The PUT method has not been defined for individual resources');
    }
}
