<?php

namespace App\Presenters;

use Nette;
use App\Model;
use Nette\Application\UI;


class GamePrepPresenter extends BasePresenter
{

	/** @var \App\Model\GameManager @inject */
    public $gameDb;

    private $game;

    private $gameId;

    public function startup() {
    	parent::startup();
    	$this->gameId = $this->getParameter("id");
    }

    public function checkGameExistence($id) {
    	if ($this->gameDb->getGame($id) == NULL) {
			$this->flashMessage("Tato hra bohužel neexistuje.", "error");
			$this->redirect("Homepage:");
		}

    	if ($this->gameDb->isGameStarted($this->gameDb->getGame($this->getParameter("id"))) != 1) {
			$this->flashMessage("Bohužel hra již začala.", "error");
			$this->redirect("Homepage:");
		}
    }

	public function renderDefault($id) {
		$this->checkGameExistence($id);
		$this->game = $this->gameDb->getGame($id);
		$this->template->game = $this->game;
		$this->template->players = $this->gameDb->getGamePlayers($id);
		$this->template->state = $this->gameDb->isGameStarted($id);
		$this->template->isLoggedIn = $this->isLoggedIn();
	}

	public function renderJoinGame($id) {
		$this->checkGameExistence($id);
		$this->game = $this->gameDb->getGame($id);
		$this->template->game = $this->game;
		$this->template->players = $this->gameDb->getPlayersCount($id);
	}

	public function createComponentJoinGameForm() {
		$form = new UI\Form;
		$form->addText('name', 'Přezdívka:')
			 ->addRule(function($input) {
			 	return $this->playerDb->findPlayerByName($this->gameId, $input->value) === false;
			 }, "Hráč s tímto jménem už je ve hře.");
		$form->addSubmit('submit', 'Připojit se do hry');
        $form->onSuccess[] = array($this, 'joinGameFormSucceeded');
        return $form;
	}

	public function joinGameFormSucceeded(UI\Form $form, $values) {
		if ($this->gameDb->getPlayersCount($this->gameDb->getGame($this->getParameter("id"))) < 10) {
			$this->logIn($this->getParameter("id"), $values->name, false);
			$this->redirect('GamePrep:', $this->getParameter("id"));
		} else {
			$this->flashMessage("Bohužel už je hra plná, zkuste se připojit k nějaké jiné hře.", "error");
			$this->redirect("Homepage:");
		}
	}

	public function handleRefreshPlayersList() {
		if ($this->isAjax()) {
			$this->redrawControl('playersList');
		}
	}

	public function handleStartGame($id) {
		if($this->isLoggedIn()) {
			if($this->isCreator() && $id == $this->getPlayer()->gameId) {
				//TODO: Dodělat zahájení hry
			} else {
				$this->flashMessage("Hru může zahájit jen její tvůrce.");
				$this->redirect("default", $this->gameId);
			}
		}
		else {
			$this->flashMessage("Pro zahájení hry musíte být přihlášen.");
			$this->redirect("default", $this->gameId);
		}
	}

}
