<?php
    
    /* fetch_specialist_options.php
    This page fetches to grab all the specialists name in the dropdown menu. The dropdown will show the name and surname, but when selecting the ID will be stored */
    
                                                $HOST = 'localhost';
                                                $DATABASE = 'LOSDB';
                                                $USER = 'bfokin';
                                                $PASSWORD = 'obSJX=a*Oyk}';
                                                $mysql = mysqli_connect($HOST,$USER,$PASSWORD,$DATABASE);
    
                                                $query = "SELECT DISTINCT surname, name, specialist_id FROM specialist_table";
                                                $result_set = $mysql->query($query);
                                                
                                                while($rows = $result_set->fetch_assoc()) {
                                                    
                                                    //Pick out the data of the patients from the query result set
                                                        $surname = $rows['surname'];
                                                        $name = $rows['name'];
                                                        $specialist_id = $rows['specialist_id'];
                                                        
                                                    //Complete name
                                                        $name=$surname." , ".$name;
                                                        
                                                    //Show name, store ID
                                                        echo "<option value='$specialist_id'>$name</option>";
                                                        
                                                }
?>