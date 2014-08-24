<?php
namespace DCM\V1\Rest\User;

class UserResourceFactory
{
	/**
	 * @param \Zend\ServiceManager\ServiceManager $services
	 * @return UserResource
	 */
    public function __invoke($services)
    {
		/** @var UserStorageMapper $mapper */
		$mapper = $services->get('DCM\V1\Rest\User\UserStorageMapper');
        return new UserResource($mapper);
    }
}
