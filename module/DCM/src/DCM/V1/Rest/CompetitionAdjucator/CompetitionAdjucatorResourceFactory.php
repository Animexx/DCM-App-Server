<?php
namespace DCM\V1\Rest\CompetitionAdjucator;

class CompetitionAdjucatorResourceFactory
{
	/**
	 * @param \Zend\ServiceManager\ServiceManager $services
	 * @return CompetitionAdjucatorResource
	 */
	public function __invoke($services)
	{
		/** @var CompetitionAdjucatorStorageMapper $mapper */
		$mapper = $services->get('DCM\V1\Rest\CompetitionAdjucator\CompetitionAdjucatorStorageMapper');
		return new CompetitionAdjucatorResource($mapper);
	}
}
