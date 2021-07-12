<!DOCTYPE html>
<html>
<body>

<?php
$servername = "localhost:3308";
$username = "gil";
$password = "bob";
$dbname = "losdb";

$mysqli = new mysqli($servername, $username, $password, $dbname);

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

if ($result = $mysqli->query("SELECT patient_id, gender, age FROM patient_table")) {

    /* determine number of rows result set */
    $row_cnt = $result->num_rows;

    printf("Result set has %d rows.\n", $row_cnt);
    echo generateTableFromResult($result);
    /* close result set */
    $result->close();
}

/* close connection */
$mysqli->close();

function generateTableFromResult($result) {
    $html = "";
    $i = 0;
    $header = "<tr>";
    $body = "";
    while($row = mysqli_fetch_assoc($result)) {
       $i += 1;
       
       $body .= "<tr>\n";
       foreach($row as $column => $value) {
           if ($i == 1){
               $header .= "<th>$column</th>\n";
           }
          $body .= "<td>$value</td>\n";
       }
       $body .= "</tr>\n";
    }
    $header .= "</tr>\n";
    $html .= "<table> $header $body</table>";
    return $html;
 }
?>

<!-- 
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect($servername, $username, $password);
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Print host information
echo "Connect Successfully. Host info: " . mysqli_get_host_info($link);

// $sql = "SELECT patient_id, gender, age FROM patient_table";
// if ($result = $mysqli->query("SELECT patient_id, gender, age FROM patient_table")) {

//     /* determine number of rows result set */
//     $row_cnt = $result->num_rows;

//     printf("Result set has %d rows.\n", $row_cnt);

//     /* close result set */
//     $result->close();
// }

// if ($result->num_rows > 0) {
//     // output data of each row
//     while($row = $result->fetch_assoc()) {
//         echo "<br> id: ". $row["id"]. " - Name: ". $row["firstname"]. " " . $row["lastname"] . "<br>";
//     }
// } else {
//     echo "0 results";
// }

$link->close();
?> -->

</body>
</html>