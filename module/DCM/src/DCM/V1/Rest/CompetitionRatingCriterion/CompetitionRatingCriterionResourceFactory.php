<?php
namespace DCM\V1\Rest\CompetitionRatingCriterion;

class CompetitionRatingCriterionResourceFactory
{
    public function __invoke($services)
    {
        return new CompetitionRatingCriterionResource();
    }
}
