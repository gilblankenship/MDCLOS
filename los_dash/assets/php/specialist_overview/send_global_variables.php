<?php
    /* This code gets the variables from the AJAX call to print them in the card header of the 'Specialist comparison graph'*/
    $min_los = $_GET["min_los"];
    $max_los = $_GET["max_los"];
    
    //Print them in the card header
    echo"<b>Specialist Comparison | Estimated LOS range from $min_los to $max_los days</b>";
?>