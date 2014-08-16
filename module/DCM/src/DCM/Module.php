<?php
namespace DCM;

use ZF\Apigility\Provider\ApigilityProviderInterface;

class Module implements ApigilityProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'ZF\Apigility\Autoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__,
                ),
            ),
        );
    }

	public function getServiceConfig()
	{
		return array(
			'factories' => array(
				'DCM\V1\Rest\Competition\CompetitionStorageMapper' =>  function ($sm) {
						/** @var \Zend\ServiceManager\ServiceManager $sm */
						$db = $sm->get('Zend\Db\Adapter\Adapter');
						return new \DCM\V1\Rest\Competition\CompetitionStorageMapper($db);
					},
				'DCM\V1\Rest\CompetitionParticipant\CompetitionParticipantStorageMapper' =>  function ($sm) {
						/** @var \Zend\ServiceManager\ServiceManager $sm */
						$db = $sm->get('Zend\Db\Adapter\Adapter');
						return new \DCM\V1\Rest\CompetitionParticipant\CompetitionParticipantStorageMapper($db);
					},
			),
		);
	}
}
