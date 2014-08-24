<?php
namespace DCM\V1\Rpc\Authenticate;

use Zend\Db\Adapter\Adapter;

class AuthenticateControllerFactory
{
	/**
	 * @param \Zend\Mvc\Controller\ControllerManager $controllers
	 * @return AuthenticateController
	 */
    public function __invoke($controllers)
    {
		/** @var \Zend\Db\Adapter\Adapter $db */
		$db = $controllers->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		return new AuthenticateController($db);
	}
}
