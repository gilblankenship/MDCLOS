<!DOCTYPE html>
<html>
<body>

<?php
$servername = "localhost";
$username = "gil";
$password = "bob";
$dbname = "losdb";
//$dbhost = '127.0.0.1';

/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect($servername, $username, $password);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Print host information
echo "Connect Successfully. Host info: " . mysqli_get_host_info($link);
?>

// $sql = "SELECT patient_id, gender, age FROM patient_table";
// $result = $conn->query($sql);

// if ($result->num_rows > 0) {
//     // output data of each row
//     while($row = $result->fetch_assoc()) {
//         echo "<br> id: ". $row["id"]. " - Name: ". $row["firstname"]. " " . $row["lastname"] . "<br>";
//     }
// } else {
//     echo "0 results";
// }

$conn->close();
?>
