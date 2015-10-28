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

	public function renderDefault($id)
	{
		$this->game = $this->gameDb->getGame($id);
		$this->template->game = $this->game;
	}

	public function createComponentAddPlayerForm() {
		$form = new UI\Form;
		$form->addText('name', 'Jméno:');
		$form->addSubmit('submit', 'Přidat hráče');
        $form->onSuccess[] = array($this, 'addPlayerFormSucceeded');
        return $form;
	}

	public function addPlayerFormSucceeded(UI\Form $form, $values) {
		$gameId = $this->playerDb->add($values->name);

		if(!$this->isAjax())
        	$this->redirect('GamePrep:', $gameId);
        else {
        	$this->redrawControl("playerList");
        	$this->redrawControl("flashMessages");
        }

	}

}
