<?php
// host = localhost because database hosted on the same server where PHP files are hosted
//everything prefixed with $ is a PHP variable
    $host = "localhost"; 
    $dbname = "meter";    // Database name
    $username = "admin";                    // Database username
    $password = "root";                        // Database password
    // Establish connection to MySQL database, using the inbuilt MySQLi library.
    $conn = new mysqli($host, $username, $password, $dbname);
    // Check if connection established successfully
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        echo "Connected to mysql database. ";
    }
 //$_POST is a PHP Superglobal that assists us to collect/access the data, that arrives in the form of a post request made to this script.
  // If values sent by NodeMCU are not empty then insert into MySQL database table
  if(!empty($_POST['sendval']) && !empty($_POST['sendval2']) && !empty($_POST['sendval3']) && !empty($_POST['sendval4'])){
        // "sendval" and "sendval2" are query parameters accessed from the HTTP POST Request made by the NodeMCU.
            $Vrms = $_POST['sendval'];
            $Irms = $_POST['sendval2'];
            $poweru = $_POST['sendval3'];
            $energy = $_POST['sendval4'];
        // Update your tablename here
        // A SQL query to insert data into table -> INSERT INTO table_name (col1, col2, ..., colN) VALUES (' " .$col1. " ', '".col2."', ..., ' ".colN." ')
                $sql = "INSERT INTO readings (Vrms, Irms, poweru, energy) VALUES ('".$Vrms."','".$Irms."','".$poweru."','".$energy."')";
                        if ($conn->query($sql) === TRUE) {
                            // If the query returns true, it means it ran successfully
                            echo "Values inserted in MySQL database table.";
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
            }
    // Close MySQL connection
    $conn->close();
?>