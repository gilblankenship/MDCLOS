<?php
        
        $HOST = 'localhost';   
        $DATABASE = 'LOSDB';
        $USER = 'bfokin';      
        $PASSWORD = 'obSJX=a*Oyk}';
        $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);
    
        //patient id calculation
        $sql = "SELECT MAX(`patient_id`) FROM `patient_table`";
        $result = $mysql->query($sql);
        $row = $result->fetch_assoc();
        $max_patient_id_found = $row['MAX(`patient_id`)'];
        $patient_id = $max_patient_id_found+1;
        
        $center_id = $_GET["medical_center"];
        $physician_id = $_GET["physician"];
        $gender = $_GET["gender"];
        $bmi = $_GET["bmi"];
        $admin_date = $_GET["admin_date"];
        $admin_time = $_GET["admin_time"];
        $surg_time = $_GET["surg_time"];
        $age = $_GET["age"];
        $cci = $_GET["cci"];
        $surgery_date = $_GET["surgery_date"];
        $transfer = $_GET["transfer"];
        $insurance = $_GET["insurance"];
        $moi = $_GET["moi"];
        $fracture_level = $_GET["fracture_level"];
        $fracture_morphology = $_GET["fracture_morphology"];
        $levels_fused = $_GET["levels_fused"];
        $blood_loss = $_GET["blood_loss"];
        $surgery_length = $_GET["surgery_length"];
        $surgical_technique = $_GET["surgical_technique"];
        $surgical_approach = $_GET["surgical_approach"];
        $discharge_location = $_GET["disharge_location"];
        $readmission = $_GET["readmission"];
        $reoperation = $_GET["reoperation"];
        $surgery_date .= ' '.$surg_time;
        $admin_date .= ' '.$admin_time;
        
        
        //Prepare and bind (Against SQL injections)
        $stmt = $mysql->prepare("INSERT INTO patient_table(patient_id, age, gender, bmi, cci, insurance, transfer, physician_id, center_id,
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
        $stmt_statistics->close();
?>