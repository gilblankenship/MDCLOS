/*******************************************************************************
* Functions used for discharging a patient                                     *
*******************************************************************************/

function patient_has_been_discharged() { 
            window.location.href="http://los.connectedcaresystems.com/old_patient_overview.php"; 
}
// Will discharge a patient
function myFunction() {
  if (confirm("Would you like to discharge patient?") === true) {
    if (confirm("Are you sure?") === true) { 
     confirm("Successfully discharged patient");
    
    var pid = document.getElementById("select_patient").value.toString();
    
     $.ajax({
        url:"./assets/php/old_patient_overview/update_patient_discharge.php",
        method:"GET",
        data:{'id': pid}, 
        cache:false, 
        success:function(data) {
            patient_has_been_discharged();
        }
        });
    }
    else {
        alert("Feel free to discharge patient later");
        
    }
  }
  else {
    alert("Discharge canceled");
  }
}


/*******************************************************************************
* Document handled functions                                                   *
* Includes ajax requests and handles when objs are visable                     *
*******************************************************************************/
$(document).ready(function() {

 $("[id=row_1]").hide();
 $("[id=row_2]").hide();
 $("[id=row_3]").hide();
 $("[id=row_4]").hide();
 $("[id=supp_action]").hide(); 
 
 
 
 
 function updateQuestionnaire() {
        var id = document.getElementById("select_patient").value.toString();
        
        if (id === "") {
            alert("Invalid Input, Please Select A Patient")
        }
        
        else { 
            $("[id=row_1]").show();
            $("[id=row_2]").show();
            $("[id=row_3]").show();
            $("[id=row_4]").show();
            $("[id=supp_action]").show();
            
            document.getElementById("patient_admission").value = document.getElementById("select_patient").value;
            
            

            // Used to populate patient info card ------------------------------
            $.ajax({
                type: 'GET',
                url: './assets/php/old_patient_overview/update_patient_info.php',
                data: {'id': id},
                success: function (result) {
                    document.getElementById("patient_info").innerHTML = result;
                },
                error: function (result) {
                    alert('Failure on the AJAX: Patient Information Card!');
                }
            });
            
            // Used to populate Initial pre op card-----------------------------
            $.ajax({
                type: 'GET',
                url: './assets/php/old_patient_overview/update_pre_op.php',
                data: {'id': id},
                success: function (result) {
                    document.getElementById("pre_op").innerHTML = result;
                },
                error: function (result) {
                    alert('Failure on the AJAX: Pre op Information Card!');
                }
            });
            
            // Used to populate initial post op card--------------------------
            $.ajax({
                type: 'GET',
                url: './assets/php/old_patient_overview/update_post_op.php',
                data: {'id': id},
                success: function (result) {
                    document.getElementById("post_op").innerHTML = result;
                },
                error: function (result) {
                    alert('Failure on the AJAX: Post op Information Card!');
                }
            });

            // Used to populate the patient history card ----[------------------
                $.ajax({
                    url:"./assets/php/old_patient_overview/update_patient_history.php",
                    method:"POST",
                    data:{'id': id}, 
                    cache:false, 
                    success:function(data) {
                        document.getElementById("patient_history").innerHTML = data;
                    }
                });
                
            // Used to update the discharge button -----------------------------
                $.ajax({
                    url:"./assets/php/old_patient_overview/update_discharge_btn.php",
                    method:'GET',
                    data:{'id': id}, 
                    cache:false, 
                    success:function(data) {
                        // This will set up the discharge button.
                        if (data === '0') {
                             $('#load_dis_button').html("<button type='button' class='btn discharge body_2' onclick='myFunction()'>Discharge Patient</button>");
                        }
                        
                        else {
                         $('#load_dis_button').html("");
                        }
                    }
                });                

        }
 }
    
    $('#select_patient').change(function() {
    updateQuestionnaire();
    update_cards();
    });
});