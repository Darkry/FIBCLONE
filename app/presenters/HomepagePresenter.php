<?php

namespace App\Presenters;

use Nette;
use App\Model;
use Nette\Application\UI;


class HomepagePresenter extends BasePresenter
{

	/** @var \App\Model\GameManager @inject */
    public $gameDb;

	public function renderDefault()
	{
		$this->template->games = $this->gameDb->getGames();
	}

	public function createComponentAddGameForm() {
		$form = new UI\Form;
		$form->addText('name', 'Jméno:');
		$form->addSubmit('submit', 'Vytvořit hru');
        $form->onSuccess[] = array($this, 'addGameFormSucceeded');
        return $form;
	}

	public function addGameFormSucceeded(UI\Form $form, $values) {
		$gameId = $this->gameDb->add($values->name);

		$this->login($gameId, false, true);

        $this->redirect('GamePrep:', $gameId);
	}



}
