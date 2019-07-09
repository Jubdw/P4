<?php

namespace Ju\Blog\Model;

require_once("model/Manager.php");

class UserManager extends Manager
{
	public function getUsers()
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT id, name, email FROM users');

		return $req;
	}

	public function createUser($name, $password, $email)
	{
		$db = $this->dbConnect();
		$newUser = $db->prepare('INSERT INTO users(name, password, email, status_id, register_date) VALUES(?, ?, ?, 3, CURDATE())');
		$createNew = $newUser->execute([$name, $password, $email]);
		
		return $createNew;
	}
}