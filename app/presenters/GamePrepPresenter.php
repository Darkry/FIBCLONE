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

	public function renderDefault($id)
	{
		$this->game = $this->gameDb->getGame($id);
		$this->template->game = $this->game;
		$this->template->players = $this->gameDb->getGamePlayers($id);
	}

	public function renderJoinGame($id) {
		$this->game = $this->gameDb->getGame($id);
		$this->template->game = $this->game;
	}

	public function createComponentJoinGameForm() {
		$form = new UI\Form;
		$form->addText('name', 'Přezdívka:');
		$form->addSubmit('submit', 'Připojit se do hry');
        $form->onSuccess[] = array($this, 'joinGameFormSucceeded');
        return $form;
	}

	public function joinGameFormSucceeded(UI\Form $form, $values) {
		$this->playerDb->add($values->name, $this->getParameter("id"));
	}

	public function handleRefreshPlayersList() {
		if ($this->isAjax()) {
			$this->redrawControl('playersList');
		}
	}

}
