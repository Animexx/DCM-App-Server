<?php
namespace DCM\V1\Rpc\Import;

class ImportControllerFactory
{
	/**
	 * @param \Zend\Mvc\Controller\ControllerManager $controllers
	 * @return ImportController
	 */
    public function __invoke($controllers)
    {
		/** @var \Zend\Db\Adapter\Adapter $db */
		$db = $controllers->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
		$config = $controllers->getServiceLocator()->get("Config");
        return new ImportController($db, $config["dcm-import"]["password"], $config["dcm-import"]["url"]);
    }
}
