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

	

}
