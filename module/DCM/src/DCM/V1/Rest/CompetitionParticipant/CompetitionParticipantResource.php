<?php
namespace DCM\V1\Rest\CompetitionParticipant;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;

class CompetitionParticipantResource extends AbstractResourceListener
{
	/** @var CompetitionParticipantStorageMapper $storageMapper */
	protected $storageMapper;

	/**
	 * @return int
	 */
	protected function getCurrentCompetitionId() {
		return $this->getEvent()->getRouteMatch()->getParam("competition_id");
	}

	/**
	 * @param CompetitionParticipantStorageMapper $storageMapper
	 */
	public function __construct($storageMapper)
	{
		$this->storageMapper = $storageMapper;
	}

    /**
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
		if (property_exists($data, "id")) {
			return $this->storageMapper->updateItem(CompetitionParticipantEntity::fromArray($data));
		} else {
			return $this->storageMapper->insertItem(CompetitionParticipantEntity::fromArray($data));
		}
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
    public function fetch($id, $par)
    {
		$competion_id = $this->getCurrentCompetitionId();

    }

    /**
     * Fetch all or a subset of resources
     *
     * @param  array $params
     * @return ApiProblem|mixed
     */
    public function fetchAll($params = array())
    {
		$competion_id = $this->getCurrentCompetitionId();
		$adapter = new CompetitionParticipantPaginatorAdapter($this->storageMapper, $competion_id);
		$collection = new CompetitionParticipantCollection($adapter);
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
