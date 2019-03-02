<?php
class Register
{
	private $username;
	private $password;
	private $email;
	private $errors;
	private $pdo;

	function __construct($user, $pass, $email) {
		$this->username = $user;
		$this->password = $pass;
		$this->email = $email;
		$this->pdo = $GLOBALS['pdo'];
	}
	function validate() {
		if(trim($this->username) == '') { 
			echo 'Enter valid username';
			return false;
		}
		if(trim($this->email) == '') { 
			echo 'Enter valid email';
			return false;
		}
		if(trim($this->password) == '') {
			echo 'Enter valid password';
			return false;
		}
		return true;
	}
	function show_errors(){
		echo array_shift($this->errors);
	}
	function check_uniqueness(){
		$stmt = $this->pdo->prepare("SELECT * FROM `users` WHERE username = :name OR email = :email");
		$stmt->execute(array('name' => $this->username, 'email' => $this->email));
		$user = $stmt->fetch();
		return $user;
	}
	function register(){
		$stmt = $this->pdo->prepare("INSERT INTO users (username, email, password)
							VALUES (?, ?, ?)");
		$stmt->execute(array($this->username, $this->email, password_hash($this->password, PASSWORD_DEFAULT)));
	}
}