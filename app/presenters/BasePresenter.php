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

	protected function isLoggedIn() {
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

	public function getPlayerName() {
		if($this->isLoggedIn())
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

	protected function logIn($gameId, $userName=false, $creator=false) {
		$this->logout();
		if($this->playerDb->findPlayerByName($gameId, $userName) === false) {
			$id = $this->playerDb->add($userName, $gameId);

			$player = $this->session->getSection("player");
			$player->name = $userName;
			$player->id = $id;
			$player->gameId = $gameId;
			$player->creator = false;
		} else {
			throw new Exception("Hráč s tímto jménem už existuje!");
		}
	}

}
