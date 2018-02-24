<!DOCTYPE HTML>  
<html>
<head>
</head>
<body>  

<?php

$servername = "localhost";
$user = "root";
$pass = "secret";
$dbname = "database";
$u_name="";
$u_pass="";
$conn = mysqli_connect($servername, $user, $pass, $dbname);
//var_dump($_POST);
if(isset($_POST["submit"]))
{
	$u_name=$_POST["name"];
	$u_pass=$_POST["pass"];
	
	$res = mysqli_query($conn,"select * from login where username = '{$u_name}' and password ='{$u_pass}' limit 1");
	//var_dump($res);
    if(mysqli_num_rows($res)>0) {
        foreach ($res as $r) {
            echo "Username: " . $r["username"] . "<br>";
            echo "password: " . $r["password"] . "<br>";
        }
    }
}

?>

<h2>PHP Form Validation Example</h2>
<form method="post" action="sql_injection.php">  
  Name: <input type="text" name="name">
  <br><br>
  Password: <input type="text" name="pass">
  <br><br>
  <input type="submit" name="submit" value="Submit"> 
</form>
<?php

?>
</body>
</html>