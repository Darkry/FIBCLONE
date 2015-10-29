<?php

namespace App\Model;

use Nette;

class PlayerManager extends Nette\Object
{

	/** @var Nette\Database\Context */
	private $database;


	public function __construct(Nette\Database\Context $database)
	{
		$this->database = $database;
	}

	public function add($name, $gameId)
	{
		$row = $this->database->table("player")->insert(array(
			"name" => $name,
			"game_id" => $gameId,
			"points" => 0,
		));
		return $row->id;
	}

}