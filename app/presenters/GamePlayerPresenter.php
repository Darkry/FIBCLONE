<?php

namespace App\Presenters;

use Nette;
use App\Model;
use Nette\Application\UI;


class GamePlayerPresenter extends BasePresenter
{

	/** @var \App\Model\GameManager @inject */
    public $gameDb;

	public function renderDefault($id)
	{
		
	}
}
