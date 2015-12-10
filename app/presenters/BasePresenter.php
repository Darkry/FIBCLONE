<?php

namespace App\Presenters;

use Nette;
use App\Model;


/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{

	private $session;

	/** @var \App\Model\PlayerManager @inject */
    public $playerDb;

    public function startup() {
    	parent::startup();
    	$this->session = $this->getSession();
    }

	public function isLoggedIn() {
		return $this->session->hasSection("player");
	}

	protected function logout() {
		$this->session->getSection("player")->remove();
	}

	public function getPlayer() {
		if($this->isLoggedIn())
			return $this->session->getSection("player");
		else
			return NULL;
	}

	public function checkPlayerExistence() {
		if($this->isLoggedIn()) {
			if($this->isCreator())
				return TRUE;
			else
				return ($this->playerDb->getPlayer($this->getPlayerId()) != NULL);
		} else
			throw new \Exception("Checking Db existence of not logged-in player.");
	}

	public function getPlayerName() {
		if($this->isLoggedIn() && $this->isCreator == false)
			return $this->getPlayer()->name;
		else
			return NULL;
	}

	public function isCreator() {
		if($this->isLoggedIn())
			return $this->getPlayer()->creator;
		else
			return NULL;
	}

	public function getPlayerId() {
		if($this->isLoggedIn() && $this->isCreator() == false)
			return $this->getPlayer()->id;
		else
			return NULL;
	}

	protected function logIn($gameId, $userName=false, $creator=false) {
		$this->logout();

		if($creator === true) {
			if($userName !== false)
				throw new \Exception("U zakladatele hry nesmí být uvedeno jméno.");

				$player = $this->session->getSection("player");
				$player->creator = true;
				$player->gameId = $gameId;

		}
		else if($this->playerDb->findPlayerByName($gameId, $userName) === false && $creator === false) {
			if($userName !== false) {
				$id = $this->playerDb->add($userName, $gameId);

				$player = $this->session->getSection("player");
				$player->name = $userName;
				$player->id = $id;
				$player->gameId = $gameId;
				$player->creator = false;
			} else {
				throw new \Exception("Jméno hráče nebylo zadáno!");
			}
		} else {
			throw new \Exception("Hráč s tímto jménem už existuje nebo má proměnná 'creator' neplatnou hodnotu!");
		}
	}

}
