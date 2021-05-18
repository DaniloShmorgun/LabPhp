<?php

$post = json_decode(file_get_contents('php://input'), true);



$hostname = "us-cdbr-east-03.cleardb.com";
$username = "bbc93c3fea8b85";
$password = "b3e30e86";
$db =  "heroku_6ec5d5a4394527d";

$conn = mysqli_connect($hostname, $username,$password,$db);

if(!$conn){
    die("Connection faile: " .mysqli_connect_error());
}


if (isset($post["delete_table"])) {
    $sql7 = "TRUNCATE TABLE `USERS`";
 $conn->query($sql7);  
exit();
}

if (isset($post["create_table"])) {
    $sql11 = "SELECT * FROM USERS ORDER BY `first_name`" ;
    $result = mysqli_query($conn,$sql11);
   
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
exit();
}


$db = mysqli_select_db($conn, "USERS");

if ($hostname === "localhost") {
    $sql1 = "CREATE DATABASE `USERS`";
    $conn->query($sql1);
}



$sql2 = "CREATE TABLE IF NOT EXISTS `USERS`(
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

//   $sql3 = "INSERT INTO `USERS`(first_name,last_name,email,number)
//   VALUES('$first_name','$last_name','$email','$number')";
$sql3 = "INSERT  INTO `USERS`(first_name,last_name,email,number)
   VALUES('$first_name','$last_name','$email','$number')";
$conn->query($sql3);

$sql9 = "DELETE FROM `USERS2` WHERE first_name = ''";
 $conn->query($sql9);  
 $sql10 = "DELETE FROM `USERS2` WHERE last_name = ''";
 $conn->query($sql10);



$sql5 = "DELETE t1 FROM `USERS` t1
INNER JOIN `USERS` t2 
WHERE 
   t1.id < t2.id AND t1.first_name = t2.first_name AND 
   t1.email = t2.email AND  
   t1.last_name = t2.last_name AND  
   t1.number= t2.number";
 $conn->query($sql5);   
 
$sql6 = "DELETE FROM `USERS` WHERE email = ''";
 $conn->query($sql6);  
 

 $sql4 = "SELECT * FROM USERS ORDER BY `first_name`" ;
 $result = mysqli_query($conn,$sql4);

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

$sql7 = "SELECT * FROM `USERS` ORDER BY `first_name` LIMIT 10";
$first_10_by_name = mysqli_query($conn,$sql7);

echo "<h5>ПЕРШІ 10 В АЛФАВІТНОМУ ПОРЯДКУ ЗА ІМ'ЯМ</h5>";

echo "<table border='1'>
<tr>
<th>Firstname</th>
<th>Lastname</th>
<th>email</th>
<th>number</th>
</tr>";

while($row = mysqli_fetch_array($first_10_by_name))
{
echo "<tr>";
echo "<td>" . $row['first_name'] . "</td>";
echo "<td>" . $row['last_name'] . "</td>";
echo "<td>" . $row['email'] . "</td>";
echo "<td>" . $row['number'] . "</td>";
echo "</tr>";
} 
echo "</table>";


$sql8 = "SELECT u2.first_name, u2.last_name,
 u.first_name, u.last_name FROM `USERS2` AS u2
 LEFT JOIN `USERS` AS u ON u2.id = u.id";
 $multiple_table_query = mysqli_query($conn,$sql8);

echo "<h5>2 ЗАПИТИ З РІЗНИХ ТАБЛИЦЬ (ШУКАВ ПО СХОЖИМ ІМЕНАМ В 2 ТАБИЛЦЯХ)</h5>";

echo "<table border='1'>
<tr>
<th>Firstname</th>
<th>Lastname</th>
</tr>";

while($row = mysqli_fetch_array($multiple_table_query))
{
    if ($row['first_name'] != '') {
        echo "<tr>";
echo "<td>" . $row['first_name'] . "</td>";
echo "<td>" . $row['last_name'] . "</td>";
echo "</tr>";
    }

} 
echo "</table>";



mysqli_close($conn);
// echo json_encode($post, JSON_UNESCAPED_UNICODE);

?>




