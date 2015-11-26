<?php

namespace App\Presenters;

use Nette;
use App\Model;
use Nette\Application\UI;


class GamePrepPresenter extends BasePresenter
{

	/** @var \App\Model\GameManager @inject */
    public $gameDb;

    /** @var \App\Model\PlayerManager @inject */
    public $playerDb;

    private $game;

    private $gameId;

    public function startup() {
    	parent::startup();
    	$this->gameId = $this->getParameter("id");
    }

	public function renderDefault($id)
	{
		$this->game = $this->gameDb->getGame($id);
		$this->template->game = $this->game;
		$this->template->players = $this->gameDb->getGamePlayers($id);
	}

	public function renderJoinGame($id) {
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
			$this->playerDb->add($values->name, $this->getParameter("id"));
		} else {
			$this->flashMessage("Bohužel už je hra plná, zkuste se připojit k nějaké jiné hře.", "error");
			$this->redirect("this");
		}
	}

	public function handleRefreshPlayersList() {
		if ($this->isAjax()) {
			$this->redrawControl('playersList');
		}
	}

}
