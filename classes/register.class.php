<?php
class Register
{
	private $username;
	private $password;
	private $email;
	private $errors;
	private $pdo;

	function createUser($user, $pass, $email) {
		if ($this->validate($user, $pass, $email) && $this->checkUniqueness($user, $email)) 
			{
				// Are username and email unique?
				/*if ($this->check_uniqueness($user, $email)) 
				{
					// Show error message
					echo "The username or email has already been used!";
				}
				else
				{*/
					$pdo = $GLOBALS['pdo'];
					// Register a new user
					$stmt = $pdo->prepare("INSERT INTO users (username, email, password)
							VALUES (?, ?, ?)");
					$stmt->execute(array($user, $email, password_hash($pass, PASSWORD_DEFAULT)));
					return true;
				/*}*/
			}
		return false;
	}
	function validate($user, $pass, $email) {
		if(trim($user) == '') { 
			echo 'Enter valid username';
			return false;
		}
		if(trim($email) == '') { 
			echo 'Enter valid email';
			return false;
		}
		if(trim($pass) == '') {
			echo 'Enter valid password';
			return false;
		}
		return true;
	}
	function checkUniqueness($user, $email){
		$pdo = $GLOBALS['pdo'];
		$stmt = $pdo->prepare("SELECT * FROM `users` WHERE username = :name OR email = :email");
		$stmt->execute(array('name' => $user, 'email' => $email));
		$user = $stmt->fetch();
		if ($user) {
			echo "Username or password has been used.";
			return false;
		}
		return true;
	}
	/*function register(){
		$stmt = $this->pdo->prepare("INSERT INTO users (username, email, password)
							VALUES (?, ?, ?)");
		$stmt->execute(array($this->username, $this->email, password_hash($this->password, PASSWORD_DEFAULT)));
	}*/
}