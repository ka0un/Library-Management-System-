<html>
<head>
    <title>PHP task</title>
</head>
<body>

<?php
    if(isset($_POST["submit"]))
    { 
        $conn = new mysqli("127.0.0.1:3306", "u14_gXTHhvqGZN", "W=kq.QZa+JAfxXL2gNzaS7Qb");

        if($conn->connect_error)
        {
            die("Connection failed:" . $conn->connect_error);
        }
        else
        {
            echo "Connection successfully";
        }

        $name = $_POST["name"];
        $id = $_POST["id"];

        $sql = "Create tabel form( Id varchar(15) , Name varchar(30),)"; 
        $sql = "INSERT INTO form (name,age) VALUES ('$id', '$name')";

        if($conn->query($sql) == true)
        {
            echo "New record inserted";
        }
        else
        {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
?>

</body>
</html>
