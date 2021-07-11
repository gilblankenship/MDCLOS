<!-- Code not in use: The registration page was moved from the estimator to the 'New Patient Registration' page -->
<?php

    // establish the database connection
    $HOST = 'localhost';   
    $DATABASE = 'LOSDB';
    $USER = 'bfokin';      
    $PASSWORD = 'obSJX=a*Oyk}';
    $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);
    
    // create a prepared statement, (safety :D)
    
    
    $stmt = $mysql->prepare("INSERT INTO patient_table(age, gender, bmi, insurance, transfer, physician_id, center_id,
                            mrn, dob, admin_date, surgery_date) 
                            VALUES (?,?,?,?,?,?,?,?,?,?,?)");
                    
    // bind our parameters to the statement        
    $stmt->bind_param("isdssiissss", $age, $gender, $bmi, $insurance, $transfer, $physician_id, $center_id,
                        $mrn, $dob, $admin_date, $surgery_date);
    
        
    if (isset($_GET["select_physician"]) and isset($_GET["select_center"]) and isset($_GET["gender"]) and isset($_GET["insurance"])
        and isset($_GET["transfer"]) and isset($_GET["bmi"]) and isset($_GET["mrn"]) and isset($_GET["dob"]) and isset($_GET["admin_date"])
        and isset($_GET["admin_time"]) and isset($_GET["surgery_date"]) and isset($_GET["surgery_time"])) {                            
        
        //Collect variables from the source page
        $center_id = $_GET["select_center"];
        $physician_id = $_GET["select_physician"];
        $gender = $_GET["gender"];
        $bmi = $_GET["bmi"];
        $insurance = $_GET["insurance"];
        $transfer = $_GET["transfer"];
        $mrn = $_GET["mrn"];
        $dob = $_GET["dob"];
        
        //calculating age
        $birthDate = explode("-", $dob);
        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
        ? ((date("Y") - $birthDate[0]) - 1)
        : (date("Y") - $birthDate[0]));
        
        
        //admin_date
        $admin_date = $_GET["admin_date"];
        //admin_time
        $admin_time = $_GET["admin_time"];
        //concat the strings 
        $admin_date .= ' '.$admin_time;
        
        //surgery_date
        $surgery_date = $_GET["surgery_date"];
        //surgery_time
        $surgery_time = $_GET["surgery_time"];
        //concat the strings 
        $surgery_date .= ' '.$surgery_time;
        
        // UNCOMMENT THESE TO REACTIVATE THE QUERY
        if($stmt->execute()) {
        // return back to the page and signal its success
            header("Location: ../?signup=success");            
        }

        $stmt->close();
        

    }
    else {
        echo "FAILURE: Please fill out all fields";
        echo "<br>";

        echo "end data";
        
    }
?>