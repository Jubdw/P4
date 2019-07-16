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

	public function getUser($name)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id, email, DATE_FORMAT(register_date, \'%d/%m/%Y\') AS register_date_fr FROM users WHERE name = ?');
		$req->execute([$name]);
		$userInfo = $req->fetch();

		return $userInfo;
	}

	public function connectUser($name)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id, password FROM users WHERE name = ?');
		$req->execute([$name]);
		$userData = $req->fetch();
		
		return $userData;
	}

	public function createUser($name, $password, $email)
	{
		$db = $this->dbConnect();
		$newUser = $db->prepare('INSERT INTO users(name, password, email, status_id, register_date) VALUES(?, ?, ?, 3, CURDATE())');
		$createNew = $newUser->execute([$name, $password, $email]);
		
		return $createNew;
	}

	public function editName($id, $name)
	{
		$db = $this->dbConnect();
		$newName = $db->prepare('UPDATE users SET name = ? WHERE id = ?');
		$edit = $newName->execute([$name, $id]);

		return $edit;
	}
}