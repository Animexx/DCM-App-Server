<?php
namespace DCM\V1\Rest\User;

use ZF\ApiProblem\ApiProblem;
use ZF\Rest\AbstractResourceListener;

class UserResource extends AbstractResourceListener
{
	/** @var UserStorageMapper $storageMapper */
	protected $storageMapper;

	/**
	 * @param UserStorageMapper $storageMapper
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
		return new ApiProblem(405, 'The GET method has not been defined for collections4');
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


	public static function Username2ID($username)
	{

	}
}
