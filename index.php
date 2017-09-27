<!DOCTYPE html>
<html>
<head><title>PHP Flerebrugesystem eksempel</title></head>
<body>
<?php
/**
 * Kodeeksempler fra klassen 27/09/2017
 * af András Ács, med hjælp fra holdet :-D
 */


echo "<h1> User login system </h1>";
echo "<p> Welcome! </p>";

/*
   TRIN 1 - Opretter forbindelse til databasen
   https://www.w3schools.com/php/php_mysql_connect.asp
*/
echo "<h1>TRIN 1 - Connecting to DB</h1>";

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

/*
   TRIN 2 - Sender forespørgsel til databasen, modtager data og viser data
   https://www.w3schools.com/php/php_mysql_select.asp
*/
echo "<h1>TRIN 2 - Querying DB</h1>";
$sql = "SELECT * FROM users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<br />" . $row["id"] . ". " . $row["name"];
    }
} else {
    echo "0 results";
}

/* TRIN 3 - Viser data i en velformateret tabel */
// Eksempel på en SQL forespørgsel
// SELECT name, rolle FROM users, userRoles, roles
// WHERE users.id = userRoles.userID
// AND roles.id = userRoles.roleID
?>
<h1>TRIN 3 - Show data in table</h1>
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
        while ($row = $result->fetch_assoc()) {
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

<?php
/*
 TRIN 4 -  Create user form
 https://www.w3schools.com/php/php_forms.asp
*/
?>
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
// TRIN 5 - Nu skal vi blot gemme navn og email i databasen
// https://www.w3schools.com/php/php_mysql_insert.asp
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
