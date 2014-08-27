<?php
namespace DCM\V1\Rpc\Authenticate;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\Db\Adapter\Adapter;
use ZF\ContentNegotiation\ViewModel;
use Zend\Db\Adapter\ParameterContainer;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Adapter\Driver\ResultInterface;

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

	/**
	 * @param string $sql
	 * @param array $params
	 * @return array
	 * @throws \Exception
	 */
	protected function sqlSelect($sql, $params)
	{
		$stmt   = $this->db->createStatement($sql, new ParameterContainer($params));
		$result = $stmt->execute();
		if ($result instanceof ResultInterface && $result->isQueryResult()) {
			$resultSet = new ResultSet;
			$resultSet->initialize($result);
			$result = array();
			while ($ret = $resultSet->current()) {
				$result[] = (array)$ret;
				$resultSet->next();
			}
			return $result;
		} else {
			throw new \Exception("Internal error");
		}
	}

	/**
	 * @return ViewModel
	 */
	public function authenticateAction()
	{
		$username = $_SERVER["PHP_AUTH_USER"];
		$password = sha1($_SERVER["PHP_AUTH_PW"]);
		$res = $this->sqlSelect("SELECT * FROM users WHERE username = ? AND password = ?", array($username, $password));
		if ($res) {
			$res = $res[0];
			$res["success"] = true;
		} else $res = array("success" => false);
		return new ViewModel($res);
	}
}
