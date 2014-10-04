<?php
namespace DCM\V1\Rest\CompetitionAdjucator;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;

class CompetitionAdjucatorResource extends AbstractResourceListener
{

	/** @var CompetitionAdjucatorStorageMapper $storageMapper */
	protected $storageMapper;

	/**
	 * @param CompetitionAdjucatorStorageMapper $storageMapper
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
     * Create a resource
     *
     * @param  mixed $data
     * @return ApiProblem|mixed
     */
    public function create($data)
    {
		/** TODO Sicherstellen, dass $id auch die ID des aktuellen Nutzers ist */
		$item = CompetitionAdjucatorEntity::fromArray($data);
		$ret = $this->storageMapper->insertItem($item);
		return $ret;
    }

    /**
     * Delete a resource
     *
     * @param  mixed $id
     * @return ApiProblem|mixed
     */
    public function delete($id)
    {
		$competition_id = $this->getCurrentCompetitionId();
		$this->storageMapper->deleteItem($competition_id, $id);
		return true;
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
		$competition_id = $this->getCurrentCompetitionId();
		$adapter = new CompetitionAdjucatorPaginationAdapter($this->storageMapper, $competition_id);
		return $adapter->getItem($id);
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
		$adapter = new CompetitionAdjucatorPaginationAdapter($this->storageMapper, $competition_id);
		$collection = new CompetitionAdjucatorCollection($adapter);
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
