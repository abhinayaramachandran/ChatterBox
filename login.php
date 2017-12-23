<!-- Author : Abhinaya Ramachandran-->


<?php
require_once 'config.php';
?>

<html>
<head> <title>Login to ChatterBox</title>
<!-- Scripts below are for bootstrap styles and decoration -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');

try{
	if($_SERVER["REQUEST_METHOD"] == "POST"){
	$username = $_POST['username'];
	$password= $_POST['pwd'];
	if (isset($username) && isset($password)){
		$conn->beginTransaction();
		$query= $conn->prepare("SELECT * FROM users WHERE username = :username AND password  = :password");
		$query->bindParam(':username',$username);
		$hashed_password = md5($password);
		$query->bindParam(':password', $hashed_password);
		$query->execute();
		if ($row = $query->fetch(PDO::FETCH_OBJ)){
			session_start();
			$_SESSION['username'] = $username;
			$_SESSION['fullname'] = $row->fullname;
			$_SESSION['email'] = $row->email;
			header("location: board.php");
		}
	}
	}
}
catch(PDOException $e){
	print "Error: ".$e->getMessage()."<br/>";
}

?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<div class= "jumbotron col-lg-6">
	<center><h2> Chatter Box </h2></center>
	<input type="text" class="form-control" name="username" placeholder= "Enter Username"></input> <br/>
	<input type="password" class="form-control"  name="pwd" placeholder="Enter Password"></input> <br/>
	<input type = "submit" name="Login"  class="form-control btn btn-primary" value="Login to ChatterBox" />
	</div>

</form>
</body>
</html>

