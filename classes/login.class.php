<?php
class Login
{
	private $username;
	private $password;
	private $pdo;
	public $user;

	function __construct($username, $pass) {
		$this->username = $username;
		$this->password = $pass;
		$this->pdo = $GLOBALS['pdo'];
	}
	function validate() {
		if(trim($this->username) == '')
		{ 
			echo 'Enter valid username';
			return false;
		}
		if(trim($this->password) == '')
		{
			echo 'Enter valid password';
			return false;
		}
		return true;
	}
	function find_user() {
		$stmt = $this->pdo->prepare("SELECT * FROM `users` WHERE username = ?");
		$stmt->execute([$this->username]);
		$this->user = $stmt->fetch();
		if($this->user)
		{
			return true;
		}
		else
		{
			echo "No such user";
			return false;
		}
	}
	function check_pass() {
			return password_verify($this->password, $this->user['password']);
	}
}