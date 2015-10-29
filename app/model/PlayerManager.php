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

	/**
	 * Adds new game.
	 * @param  string
	 * @param  string
	 * @return void
	 */

	/*public function add($name, $totalRounds=10)
	{
		try {
			$row = $this->database->table("game")->insert(array(
				"name" => $name,
				"totalRounds" => $totalRounds,
				"date" => new \DateTime,
				"round" => 1,
				"finished" => 0,
				"state" => 1
			));
		} catch (Nette\Database\UniqueConstraintViolationException $e) {
			throw new DuplicateNameException;
		}
		return $row->id;
	}*/

	public function getGames() {
		return $this->database->table("game")->order("date DESC");
	}

	public function getGame($id) {
		return $this->database->table("game")->get($id);
	}

	public function getPlayersList($value='') {
		# code...
	}

}