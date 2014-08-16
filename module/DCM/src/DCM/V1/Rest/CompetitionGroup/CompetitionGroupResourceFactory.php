<?php
namespace DCM\V1\Rest\CompetitionGroup;

class CompetitionGroupResourceFactory
{
	/**
	 * @param \Zend\ServiceManager\ServiceManager $services
	 * @return CompetitionGroupResource
	 */
	public function __invoke($services)
	{
		/** @var CompetitionGroupStorageMapper $mapper */
		$mapper = $services->get('DCM\V1\Rest\CompetitionGroup\CompetitionGroupStorageMapper');
		return new CompetitionGroupResource($mapper);
	}
}
