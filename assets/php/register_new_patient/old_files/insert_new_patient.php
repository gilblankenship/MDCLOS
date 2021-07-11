<?php
    //If review is clicked, just send the written answers to the corresponding variables. 
    // establish the database connection
    $HOST = 'localhost';   
    $DATABASE = 'LOSDB';
    $USER = 'bfokin';      
    $PASSWORD = 'obSJX=a*Oyk}';
    $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);
    
    // create a prepared statement, (safety :D)

    if (isset($_GET["select_physician"]) and isset($_GET["select_center"]) and isset($_GET["gender"]) and isset($_GET["insurance"])
        and isset($_GET["transfer"]) and isset($_GET["bmi"]) and isset($_GET["cci"]) and isset($_GET["age"]) and isset($_GET["admin_date"])
        and isset($_GET["admin_time"]) and isset($_GET["surgery_date"]) and isset($_GET["surgery_time"]) and isset($_GET["moi"]) and isset($_GET["fract_level"]) 
        and isset($_GET["fract_morph"]) and isset($_GET["surg_technique"]) and isset($_GET["surg_approach"]) and isset($_GET["surgery_length"]) and isset($_GET["blood_loss"]) and isset($_GET["readmission"]) and isset($_GET["reoperation"]) and isset($_GET["levels_fused"])) {                          
        
        //patient id calculation
        $sql = "SELECT MAX(`patient_id`) FROM `patient_table`";
        $result = $mysql->query($sql);
        $row = $result->fetch_assoc();
        $max_patient_id_found = $row['MAX(`patient_id`)'];
        $patient_id = $max_patient_id_found+1;
        
        //Collect variables from the source page
        $center_id = $_GET["select_center"];
        $physician_id = $_GET["select_physician"];
        $gender = $_GET["gender"];
        $bmi = $_GET["bmi"];
        $insurance = $_GET["insurance"];
        $transfer = $_GET["transfer"];
        $age = $_GET["age"];
        $cci = $_GET["cci"];
        
        //calculating age
        /*$birthDate = explode("-", $dob);
        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
        ? ((date("Y") - $birthDate[0]) - 1)
        : (date("Y") - $birthDate[0]));*/
        
        
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
        
        
        $moi = $_GET["moi"];
        $fracture_level = $_GET["fract_level"];
        $fracture_morphology = $_GET["fract_morph"];
        $levels_fused = $_GET["levels_fused"];
        $blood_loss = $_GET["blood_loss"];
        $surgery_length = $_GET["surgery_length"];
        $surgical_technique = $_GET["surg_technique"];
        $surgical_approach = $_GET["surg_approach"];
        $readmission = $_GET["readmission"];
        $reoperation = $_GET["reoperation"];
        
    
        //Prepare and bind (Against SQL injections)
        /*$stmt = $mysql->prepare("INSERT INTO patient_table(patient_id, age, gender, bmi, cci, insurance, transfer, physician_id, center_id,
                         admin_date, surgery_date) VALUES (?,?,?,?,?,?,?,?,?,?,?)");

        $stmt->bind_param("iisddssiiss", $patient_id, $age, $gender, $bmi, $cci, $insurance, $transfer, $physician_id, $center_id,
                        $admin_date, $surgery_date);
        
        $stmt_statistics = $mysql->prepare("INSERT INTO statistics_table(patient_id, moi, fracture_level, morphology, surgical_technique, surgical_approach, surgery_length, est_blood_loss, readmission, reoperation, levels_fused) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
        $stmt_statistics->bind_param("isssssiiiis", $patient_id, $moi, $fracture_level, $fracture_morphology, $surgical_technique, $surgical_approach, $surgery_length, $blood_loss, $readmission, $reoperation, $levels_fused);
    
        $stmt->execute();
        $stmt_statistics->execute();
        // return back to the page and signal its success
            header("Location: https://connectedcaresystems.com/los/los_dash/data_new_patient.php?signup=success");

        $stmt->close();
        $stmt_statistics->close();*/

   }
    else {
        echo "FAILURE: Please fill out all fields";
        echo "<br>";
        echo "end data";
    }
    ?>