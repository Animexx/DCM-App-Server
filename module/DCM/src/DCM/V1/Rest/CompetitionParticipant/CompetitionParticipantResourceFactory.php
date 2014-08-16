<?php
namespace DCM\V1\Rest\CompetitionParticipant;

class CompetitionParticipantResourceFactory
{
	/**
	 * @param \Zend\ServiceManager\ServiceManager $services
	 * @return CompetitionParticipantResource
	 */
    public function __invoke($services)
    {
		/** @var CompetitionParticipantStorageMapper $mapper */
		$mapper = $services->get('DCM\V1\Rest\CompetitionParticipant\CompetitionParticipantStorageMapper');
		return new CompetitionParticipantResource($mapper);
    }
}
