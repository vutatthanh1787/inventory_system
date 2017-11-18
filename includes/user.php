<?php


/**
* 
*/
class User
{
	
	private $con;

	function __construct()
	{
		include_once "../database/db.php";
		$db = new Database();
		$this->con = $db->connectDB();
	}

	public function emailExists($email){
		$pre_stmt = $this->con->prepare("SELECT user_id FROM users WHERE email = ?");
		$pre_stmt->bind_param("s",$email);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		if($result->num_rows > 0) {
			return 0;
		}
		return 1;
	}

	public function createUser($username,$email,$password,$usertype){

		if (!$this->emailExists($email)) {
			return "email_exists";
		}

		$hash = password_hash($password,PASSWORD_BCRYPT,["cost"=>8]);

		$sql = "INSERT INTO `users`(`username`, `email`, `password`, `usertype`,`register_date`, `last_login`, `notes`) VALUES (?,?,?,?,?,?,?)";
		
		$pre_stmt = $this->con->prepare($sql);

		//date format 2017-10-09 04:19:34

		$date = date("Y-m-d h:m:s");
		$notes = "";

		$pre_stmt->bind_param("sssssss",$username,$email,$hash,$usertype,$date,$date,$notes);

		$result = $pre_stmt->execute() or die($this->con->error);

		if($result){
			return $this->con->insert_id;
		}

	}

	public function userLogin($email,$password){

		$sql = "SELECT user_id,username,password,last_login FROM users WHERE email = ? LIMIT 1";
		$pre_stmt = $this->con->prepare($sql);
		$pre_stmt->bind_param("s",$email);
		$pre_stmt->execute();

		$result = $pre_stmt->get_result();

		if ($result->num_rows < 1) {
			return "NOT_REGISTERED";
		}

		$row = $result->fetch_assoc();

		if(password_verify($password,$row["password"])){
			$_SESSION["user_id"] = $row["user_id"];
			$_SESSION["username"] = $row["username"];
			$_SESSION["email"] = $email;
			$_SESSION["last_login"] = $row["last_login"];

			$last_login = date("Y-m-d h:m:s");

			$p_stmt = $this->con->prepare("UPDATE users SET last_login = ? WHERE email = ?");
			$p_stmt->bind_param("ss",$last_login,$email);
			$p_stmt->execute();

		}else{
			return "NO_PASSWORD_MATCH";
		}
		return true;

	}
}

//$user=new User();
//echo $user->userLogin("rizwan@gmail.com","123456789");

?>