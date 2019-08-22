<?php
    define("DBHOST", "localhost");
    define("DBUSER", "database_user");
    define("DBPASS", "database_pass");
    define("DBNAME", "database_name");
    
    $conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
    if(!$conn){
        echo "Error connecting to the database: ".mysqli_connect_error();
    }
?>