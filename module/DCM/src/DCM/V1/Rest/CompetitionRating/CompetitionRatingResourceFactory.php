<?php
namespace DCM\V1\Rest\CompetitionRating;

class CompetitionRatingResourceFactory
{
	/**
	 * @param \Zend\ServiceManager\ServiceManager $services
	 * @return CompetitionRatingResource
	 */
	public function __invoke($services)
	{
		/** @var CompetitionRatingStorageMapper $mapper */
		$mapper = $services->get('DCM\V1\Rest\CompetitionRating\CompetitionRatingStorageMapper');
		return new CompetitionRatingResource($mapper);
	}
}
