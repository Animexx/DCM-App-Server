<?php
namespace DCM\V1\Rest\CompetitionGroup;

class CompetitionGroupResourceFactory
{
    public function __invoke($services)
    {
        return new CompetitionGroupResource();
    }
}
