<?php
namespace DCM\V1\Rest\Competition;

class CompetitionResourceFactory
{
	/**
	 * @param \Zend\ServiceManager\ServiceManager $services
	 * @return CompetitionResource
	 */
	public function __invoke($services)
	{
		/** @var CompetitionStorageMapper $mapper */
		$mapper = $services->get('DCM\V1\Rest\Competition\CompetitionStorageMapper');
		return new CompetitionResource($mapper);
	}
}
