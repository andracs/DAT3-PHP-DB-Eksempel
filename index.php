<!DOCTYPE html>
<html>
<head></head>
<body>
<?php
    echo "<h1>
    User login system
    </h1><p>
    Welcome!
    </p>";

    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "userSystem";
    $port = "3306";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname, $port);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    } else {
      echo "Connected successfully";
    }

    // TRIN 2
    $sql = "SELECT * FROM users"; /***/
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<br />" .  $row["id"] . ". " .$row["name"] ;
    }
    } else {
      echo "0 results";
    }

    // TRIN 3
    // SELECT name, rolle FROM users, userRoles, roles
    // WHERE users.id = userRoles.userID
    // AND roles.id = userRoles.roleID


?>
<h1>TRIN 3 - Data vises i tabellen</h1>
<table>
  <tr>
    <td style="border:1px solid;">
      Navn
    </td>
    <td style="border:1px solid;">
      Email
    </td>
  </tr>
<?php
  $sql = "SELECT * FROM users"; /***/
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo "<td style='border:1px solid;'>";
      echo $row["name"];
      echo "</td>";
      echo "<td style='border:1px solid;'>";
      echo $row["email"];
      echo "</td>";
      echo "</tr>";
  }
  } else {
    echo "0 results";
  }


?>

</table>
<h1>Trin 4 - Create user</h1>
<form action="index.php" method="post">
Name: <input type="text" name="name"><br>
E-mail: <input type="text" name="email"><br>
<input type="submit">
</form>
<!--
Welcome <?php echo $_POST["name"]; ?><br>
Your email address is: <?php echo $_POST["email"]; ?>
-->
<?php
  // Nu skal vi blot gemme navn og email i databasen
  // INSERT INTO `users` (`id`, `name`, `email`, `password`)
  // VALUES (NULL, 'Test', 'Test', 'Test')
  $navn = $_POST["name"];
  $email = $_POST["email"];

  $sql = "INSERT INTO users (id, name, email)
  VALUES (NULL, '$navn', '$email')";

    // DEBUG echo $sql;

  if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
  } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
  }


  $conn->close();

?>

</body>
</html>
