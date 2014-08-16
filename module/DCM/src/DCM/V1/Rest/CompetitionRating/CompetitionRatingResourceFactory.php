<?php
namespace DCM\V1\Rest\CompetitionRating;

class CompetitionRatingResourceFactory
{
    public function __invoke($services)
    {
        return new CompetitionRatingResource();
    }
}
