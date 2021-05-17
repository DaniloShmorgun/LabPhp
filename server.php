<?php

$post = json_decode(file_get_contents('php://input'), true);

$servername = "localhost";
$username = "root";
$password = "root";

$conn = mysqli_connect($servername, $username,$password);

if(!$conn){
    die("Connection faile: " .mysqli_connect_error());
}

if ($servername === "localhost") {
    $sql1 = "CREATE DATABASE `USERS`";
    $conn->query($sql1);
}

$db = mysqli_select_db($conn, "USERS");

$sql2 = "CREATE TABLE IF NOT EXISTS `users`(
    `id`MEDIUMINT NOT NULL AUTO_INCREMENT,
    `first_name` CHAR(30) NOT NULL,
    `last_name` CHAR(30) NOT NULL,
    `email` CHAR(30) NOT NULL,
    `number` CHAR(50) NOT NULL,
    PRIMARY KEY (id)
)";
 $conn->query($sql2);
 

$first_name = $post['first_name'];
$last_name = $post['last_name'];
$email = $post['email'];
$number = $post['number'];

  $sql3 = "INSERT INTO `USERS`(first_name,last_name,email,number)
  VALUES('$first_name','$last_name','$email','$number')";
$conn->query($sql3);

$sql4 = "SELECT * FROM USERS ORDER BY `first_name`" ;
$result = mysqli_query($conn,$sql4);


$sql5 = "DELETE t1 FROM `USERS` t1
INNER JOIN `USERS` t2 
WHERE 
    t1.id < t2.id AND 
    t1.email = t2.email";
 $conn->query($sql5);   
 
$sql6 = "DELETE FROM `USERS` WHERE email = ''";
 $conn->query($sql6);  
 
echo "<table border='1'>
<tr>
<th>Firstname</th>
<th>Lastname</th>
<th>email</th>
<th>number</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['first_name'] . "</td>";
echo "<td>" . $row['last_name'] . "</td>";
echo "<td>" . $row['email'] . "</td>";
echo "<td>" . $row['number'] . "</td>";
echo "</tr>";
}
echo "</table>";


mysqli_close($conn);
// echo json_encode($post, JSON_UNESCAPED_UNICODE);

?>




