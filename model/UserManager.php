<?php

namespace Ju\Blog\Model;

require_once("model/Manager.php");

class UserManager extends Manager
{
	public function getUsers()
	{
		$db = $this->dbConnect();
		$req = $db->query('SELECT id, name, email, status, DATE_FORMAT(register_date, \'%d/%m/%Y\') AS register_date_fr FROM users');

		return $req;
	}

	public function getUser($id)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT name, email, status, DATE_FORMAT(register_date, \'%d/%m/%Y\') AS register_date_fr FROM users WHERE id = ?');
		$req->execute([$id]);
		$userInfo = $req->fetch();

		return $userInfo;
	}

	public function connectUser($name)
	{
		$db = $this->dbConnect();
		$req = $db->prepare('SELECT id, password, status FROM users WHERE name = ?');
		$req->execute([$name]);
		$userData = $req->fetch();
		
		return $userData;
	}

	public function createUser($name, $password, $email)
	{
		$db = $this->dbConnect();
		$newUser = $db->prepare('INSERT INTO users(name, password, email, status, register_date) VALUES(?, ?, ?, "user", CURDATE())');
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

	public function editEmail($id, $email)
	{
		$db = $this->dbConnect();
		$newEmail = $db->prepare('UPDATE users SET email = ? WHERE id = ?');
		$edit = $newEmail->execute([$email, $id]);

		return $edit;
	}

	public function editPassword($id, $password)
	{
		$db = $this->dbConnect();
		$newEmail = $db->prepare('UPDATE users SET password = ? WHERE id = ?');
		$edit = $newEmail->execute([$password, $id]);

		return $edit;
	}

	public function blockUser($id)
	{
		$db = $this->dbConnect();
		$block = $db->prepare('UPDATE users SET status = "blocked" WHERE id = ?');
		$edit = $block->execute([$id]);

		return $edit;
	}

	public function unblockUser($id)
	{
		$db = $this->dbConnect();
		$unblock = $db->prepare('UPDATE users SET status = "user" WHERE id = ?');
		$edit = $unblock->execute([$id]);

		return $edit;
	}
}