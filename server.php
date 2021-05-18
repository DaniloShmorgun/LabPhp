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

$sql2 = "CREATE TABLE IF NOT EXISTS `USERS`(
    `id` INT(1) NOT NULL AUTO_INCREMENT,
    `first_name` CHAR(30) NOT NULL,
    `last_name` CHAR(30) NOT NULL,
    `email` CHAR(30) NOT NULL,
    `number` CHAR(50) NOT NULL,
    PRIMARY KEY (id)
)";
 $conn->query($sql2);

if (isset($post["delete_table"])) {
    $sql7 = "TRUNCATE TABLE `USERS`";
 $conn->query($sql7);  
exit();
}
// SELECT StudentMarks, count(*) as SameValue from RowWithSameValue GROUP BY StudentMarks;

if (isset($post["count"])) {
    $sql20 = "SELECT first_name, count(*) as SameName FROM `USERS` GROUP BY first_name";
    $result5 = mysqli_query($conn,$sql20);
    while($row = mysqli_fetch_array($result5))
    {
    echo "<h4> . $row[1] . 'Однакових `Данила` в таблиці </h4>";
    }
    
 $conn->query($sql20);  
exit();
}

if (isset($post["create_table"])) {
    $sql11 = "SELECT * FROM USERS ORDER BY id LIMIT 10" ;
    $result1 = mysqli_query($conn,$sql11);
   
   echo "<table border='1'>
   <tr>
   <th>Id</th>
   <th>Firstname</th>
   <th>Lastname</th>
   <th>email</th>
   <th>number</th>
   </tr>";
   
   while($row = mysqli_fetch_array($result1))
   {
   echo "<tr>";
   echo "<td>" . $row['id'] . "</td>";
   echo "<td>" . $row['first_name'] . "</td>";
   echo "<td>" . $row['last_name'] . "</td>";
   echo "<td>" . $row['email'] . "</td>";
   echo "<td>" . $row['number'] . "</td>";
   echo "</tr>";
   }
   echo "</table>"; 
exit();
}

if (isset($post["show_table"])) {
    
 $sql4 = "SELECT * FROM USERS ORDER BY `first_name`" ;
 $result = mysqli_query($conn,$sql4);

echo "<table border='1'>
<tr>
<th>Id</th>
<th>Firstname</th>
<th>Lastname</th>
<th>email</th>
<th>number</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
echo "<tr>";
echo "<td>" . $row['id'] . "</td>";
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

$first_name = $post['first_name'];
$last_name = $post['last_name'];
$email = $post['email'];
$number = $post['number'];

//   $sql3 = "INSERT INTO `USERS`(first_name,last_name,email,number)
//   VALUES('$first_name','$last_name','$email','$number')";
$sql3 = "INSERT  INTO `USERS`(first_name,last_name,email,number)
   VALUES('$first_name','$last_name','$email','$number')";
$conn->query($sql3);

$sql9 = "DELETE FROM `USERS` WHERE first_name = ''";
 $conn->query($sql9);  
 $sql10 = "DELETE FROM `USERS` WHERE last_name = ''";
 $conn->query($sql10);



$sql5 = "DELETE t1 FROM `USERS` t1
INNER JOIN `USERS` t2 
WHERE 
   t1.id > t2.id AND t1.first_name = t2.first_name AND 
   t1.email = t2.email AND  
   t1.last_name = t2.last_name AND  
   t1.number= t2.number";
 $conn->query($sql5);   
 
$sql6 = "DELETE FROM `USERS` WHERE email = ''";
 $conn->query($sql6);  
 



mysqli_close($conn);
// echo json_encode($post, JSON_UNESCAPED_UNICODE);



// 1. Підготувати SQL-запит, що створюватиме базу (CREATE DATABASE) даних відповідно
// то тематики сайту, а також створити необхідні таблиці (CREATE TABLE) з відповідними
// параметрами. В таблицях, де це є необхідним, вказати первинні ключі з
// автоінкрементом.   +
// 2. Створити SQL-запити до бази, що додають дані у кожну з таблиць бази даних,
// використовуючи інструкцію INSERT.    + 
// 3. Внести зміни в базу даних, використовуючи інструкцію ALTER, додавши поле до
// однієї з таблиць. Заповнити всі значення доданого поля значенням за замовчуванням,
// використовуючи інструкцію UPDATE.
// 4. Вибрати всі значення із таблиць (SELECT) із різними модифікаціями:
// 1. Вибрати всі значення з таблиці.
// 2. Вибрати перші 10 значень з таблиці, відсортовані у зростаючому порядку за
// одним із полів
// 3. Вибрати кількість значень із таблиць.
// 5. Видалити одну із таблиць із використанням інструкції DELETE.     +


?>




