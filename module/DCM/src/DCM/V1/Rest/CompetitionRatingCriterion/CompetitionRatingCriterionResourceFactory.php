<?php
namespace DCM\V1\Rest\CompetitionRatingCriterion;

class CompetitionRatingCriterionResourceFactory
{
	/**
	 * @param \Zend\ServiceManager\ServiceManager $services
	 * @return CompetitionRatingCriterionResource
	 */
    public function __invoke($services)
    {
		/** @var CompetitionRatingCriterionStorageMapper $mapper */
		$mapper = $services->get('DCM\V1\Rest\CompetitionRatingCriterion\CompetitionRatingCriterionStorageMapper');
		return new CompetitionRatingCriterionResource($mapper);
    }
}
