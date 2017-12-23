<!-- Author : Abhinaya Ramachandran-->

<?php
  require_once 'config.php';
  if (!isset($_SESSION)) { session_start(); }
  if(!isset($_SESSION['username'])){
      header('location: login.php');
  }
?>


<html>
<head><title>Message Board</title>
<!-- Scripts below are for bootstrap styles and decoration -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body class="jumbotron" style="padding: 30px;">
<center><h1 >Chatter Box</h1></center>
<form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
<input type = "hidden" value="1" name="clear"/>
<input style="float: right;" class="btn-primary" type="submit" name="logout" value="Logout of ChatterBox"></input>
</form>

<style type="text/css">
.bubble 
{
position: relative;
padding: 10px;
background: white;
-webkit-border-radius: 10px;
-moz-border-radius: 10px;
border-radius: 10px;
}

</style>

<?php
print "<h3 >Welcome " . $_SESSION['fullname'] . " ! </h3>" ;
if(isset($_GET["clear"])){
        session_unset();
        session_destroy();
        header('location: login.php');
}
?>


<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
$message = $_POST["message"];
if (isset($_GET["replyto"] ) ){
  $reply =  $_GET["replyto"];
  }else{
    $reply = NULL;
  }
if ($message != "")
if (isset($message)) {
      $query= $conn->prepare("INSERT INTO posts values (:id, :replyto, :user, NOW(), :message);");
      $query->bindParam(':message',$_POST['message']);
      $id = uniqid();
      $query->bindParam(':replyto',$reply);
      $query->bindParam(':id',$id);
      $query->bindParam(':user',$_SESSION["username"]);
      $query->execute();
   }
}
?>

<form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' method="post" >
<?php

$results = $conn->prepare("SELECT postedby, datetime, replyto, id, message, users.username, users.email, users.fullname  from posts inner join users  on  posts.postedby = users.username  order by datetime DESC;");
$results->execute();
foreach ($results as  $row){
      if (isset($row["replyto"])){
        $replyto = "This is a reply to ".$row["replyto"];
      }else{
        $replyto = "";
      }
      print '<p class="bubble" >'.$replyto.'<br/>  Message:'.$row["id"]. "<br/> Posted by: ".$row["username"].",   " .$row["fullname"]. " at  ". $row["datetime"]."<br/><br/>". $row["message"] .'<br/>';
      print "<button class='btn-primary' style='float: right;' type='submit' formaction='board.php?replyto=".$row["id"]."'> Reply </button> <br/></p>";
    }

?>


<br/>
<br/>
<textarea class="form-control" name="message" placeholder="Start typing ..."></textarea>
<input class="btn-primary form-control" style="float: right;" type="submit" name="post" value="New Post" />
</form> 

</body>
</html>