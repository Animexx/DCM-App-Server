<?php
namespace DCM\V1\Rpc\Import;

use Zend\Mvc\Controller\AbstractActionController;
use ZF\ContentNegotiation\ViewModel;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\ParameterContainer;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Adapter\Driver\ResultInterface;


class ImportController extends AbstractActionController
{
	/** @var Adapter */
	private $db;
	/** @var string */
	private $service_pw;
	private $service_url;


	/**
	 * @param Adapter $db
	 * @param string $service_pw
	 * @param string $service_url
	 */
	public function __construct($db, $service_pw, $service_url)
	{
		$this->db = $db;
		$this->service_pw = $service_pw;
		$this->service_url = $service_url;
	}

    public function importAction()
    {
		if (!isset($_REQUEST["password"]) || $_REQUEST["password"] != $this->service_pw) return new ViewModel(array(
			"error" => "Invalid password"
		));

		$ch = curl_init();
		$timeout = 5;
		curl_setopt($ch, CURLOPT_URL, $this->service_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$data = curl_exec($ch);
		curl_close($ch);
		$data = json_decode($data, true);

		$output = array(array("success" => true));

		$this->db->query("DELETE FROM competitions")->execute();

		$output["vorentscheide"] = array();
		foreach ($data["vorentscheide"] as $vorentscheid) {
			$this->db->createStatement("INSERT INTO competitions (id, preliminary_of, animexx_event_id, name, `date`,
			max_participants, group_id) VALUES (?, ?, ?, ?, ?, ?, ?)", new ParameterContainer(array(
				$vorentscheid["ID"], null, null,
				"Vorentscheid: " . $vorentscheid["Stadt"] . " (" . $vorentscheid["Veranstaltung"] . ")",
				$vorentscheid["Termin"], 25, 1
			)))->execute();
			$output["vorentscheide"][] = $vorentscheid["ID"];
		}

		$output["teams"] = array();
		$this->db->query("DELETE FROM competition_participants")->execute();
		foreach ($data["vorentscheide"] as $vorentscheid) {
			foreach ($vorentscheid["teams"] as $team) {
				$members = $team["members"];
				$this->db->createStatement("INSERT INTO competition_participants (competition_id, user_id, name, data) VALUES
					(?, ?, ?, ?)", new ParameterContainer(array(
					$vorentscheid["ID"], $members[0]["Userid"], $members[0]["Name"] . " & " . $members[1]["Name"], json_encode($team)
				)))->execute();
				$output["teams"][] = $team["ID"];
			}
		}

		return new ViewModel($output);
    }
}
