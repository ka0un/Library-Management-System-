<?php

function setup() {

    //__DIR__ Returns the absulute path
    include(__DIR__ . '/../config.php');

    $conn = new mysqli($host, $username, $password, $database, $port);
    if($conn->connect_error){   
        echo "<H1>Database Connection Issue</H1><br>";
        echo "please check if your database credentials on <b>config.php</b> is correct";
        die("Info:" . $conn->connect_error);
    }

    $conn->query("USE $database");

    $users_tabel_create = "CREATE TABLE users (
        id INT AUTO_INCREMENT,
        name varchar(255),
        email varchar(255),
        nic varchar(255)
        password varchar(255),
        PRIMARY KEY (id)
    );";

    $conn->query($users_tabel_create);
    $conn->close();

}
?>