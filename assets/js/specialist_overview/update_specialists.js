$(document).ready(function() {

 $("[id=row_1]").hide();
 $("[id=row_2]").hide();

window.button = 'false';
window.min = 2;
window.max = 5;

console.log(window.min);
console.log(window.max);
 
 function update_comparison_card_header(){
     //Send global variables to php code to print them in HTML
        $.ajax({
                        type: 'GET',
                        url: './assets/php/specialist_overview/send_global_variables.php',
                        data: {'min_los': window.min, 'max_los': window.max},
                        success: function(result) {
                            document.getElementById("los_range").innerHTML = result;
                        },
                        error: function(data) {
                            alert('Failure on the AJAX of update reduction factor comparison specialists!');
                        }
        });
 }
 
 function updateQuestionnaire() {
        var id = document.getElementById("select_specialist").value.toString();
        console.log(id);
        action = 'inactive';
        
        if (id === "") {
            alert("Invalid Input, Please Select A Specialist")
        }
        
        else { 
            $("[id=row_1]").show();
            $("[id=row_2]").show();

            // Used to populate patient info card ------------------------------
            $.ajax({
                type: 'GET',
                url: './assets/php/specialist_overview/update_specialist_info.php',
                data: {'id': id},
                success: function (result) {
                    document.getElementById("specialist_info").innerHTML = result;
                },
                error: function (result) {
                    alert('Failure on the AJAX: Specialist Information Card!');
                }
            });
            

            // Used to populate the user history card -------------------
                $.ajax({
                    type: 'GET',
                    url:'./assets/php/specialist_overview/update_specialist_history.php',
                    data:{'id': id}, 
                    success:function(result) {
                        document.getElementById("specialist_history").innerHTML = result;
                    },
                    error: function (result) {
                        alert('Failure on the AJAX: Specialist History (Patients trated) Card!');
                    }
                });
                
            // Used to populate the user history card -------------------
                $.ajax({
                    type: 'GET',
                    url:'./assets/php/specialist_overview/update_specialist_quality.php',
                    data:{'id': id}, 
                    success:function(result) {
                        document.getElementById("specialist_quality").innerHTML = result;
                    },
                    error: function (result) {
                        alert('Failure on the AJAX: Specialist Quality Card!');
                    }
                });
            
            //Specialist comparison graph    
                var data_comparison = specialist_comparison.config.data;
                $.ajax({
                        type: 'GET',
                        url: './assets/php/specialist_overview/update_reduction_factor.php',
                        data: {'id': id, 'button': window.button, 'min_los': window.min, 'max_los': window.max},
                        success: function(result) {
                            result_array = JSON.parse(result);
                            data_comparison.datasets[0].data = result_array[1];
                            data_comparison.labels = result_array[0];
                            specialist_comparison.update();
                        },
                        error: function(data) {
                            alert('Failure on the AJAX of update reduction factor comparison specialists!');
                        }
                    });
              
              //Type of produre comparison vs reduction in LOS     
                var data_reduction = chart_type_procedure.config.data;
                $.ajax({
                        type: 'GET',
                        url: './assets/php/specialist_overview/update_type_procedures.php',
                        data: {'id': id, 'min_los': window.min, 'max_los': window.max},
                        success: function(result) {
                            result_array = JSON.parse(result);
                            data_reduction.datasets[0].data = result_array[0];
                            data_reduction.labels = result_array[1];
                            chart_type_procedure.update();
                        },
                        error: function(data) {
                            alert('Failure on the AJAX of update Specialist reduction in days per procedure!');
                        }
                    });
        }
 }
 
    $("#select_limits").click(function() {
        //When the 'Apply changes' button is selected, the window.button gets a 'True' value so that inside the update_reduction_factor.php we can apply thr limits.
        window.button = 'true';
        console.log(window.button); //Display in the console
        
        //Get the inputs min and max los
        var min_los = document.getElementById("minimum_los");
        var max_los = document.getElementById("maximum_los");
        //Store them in global variables
        window.min = min_los.value;
        window.max = max_los.value;
        //Print them in the console
        console.log(window.min);
        console.log(window.max);
        updateQuestionnaire();
        update_comparison_card_header();
        //Hide modal
        $('#filter_comparison_graph').modal('hide');
        
    });

    //When a specialist is selected  print the id in the console and run the function to update the cards.
    $('#select_specialist').change(function() {
        //Print the id in the console
        console.log(window.button);
        //Call function to update cards
        updateQuestionnaire();
        update_comparison_card_header();
    });
});