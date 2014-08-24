<?php
namespace DCM\V1\Rpc\Authenticate;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Db\Adapter\Adapter;
use ZF\ContentNegotiation\ViewModel;

class AuthenticateController extends AbstractActionController
{
	/** @var Adapter */
	private $db;


	/**
	 * @param Adapter $db
	 */
	public function __construct($db)
	{
		$this->db = $db;
	}

	public function authenticateAction()
	{
		$username = $_SERVER["PHP_AUTH_USER"];
		$id       = 1;
		return new ViewModel(array(
			"username" => $username,
			"user_id"  => $id,
		));
	}
}
