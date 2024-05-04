<?php
   require_once __DIR__ . '/../database/database.php';
   require_once __DIR__ . '/../config.php';
   require_once __DIR__ . '/../sql/copies.php';
   require_once __DIR__ . '/../sql/checkouts.php';

   $conn= getconnection();
   /* ..................... books_report table functions..........................................................*/
function add_reservation_report($bookid, $uuid)
{
    global $conn;
     $action ="Reserve";
    $sql = "INSERT INTO books_report (copyid, action, uuid, date, time) VALUES (?, ?, ?, DATE(NOW()), TIME(NOW()))";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $bookid, $action,$uuid);

    if (!mysqli_stmt_execute($stmt)) {
        echo "Error adding reservation: " . mysqli_error($conn);
    }

    $stmt->close();
}

function add_checkout_report($copyid, $uuid)
{
    global $conn;
    $action = "Checkout";
    // Prepare SQL statement
    $sql = "INSERT INTO books_report (copyid, action, uuid, date, time) VALUES (?, ?, ?, DATE(NOW()), TIME(NOW()))";


    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $copyid, $action, $uuid);

    // Execute the statement
    if (!$stmt->execute()) {
        echo "Error adding reservation: " . mysqli_error($conn);
    }

    $stmt->close();
}

function add_return_report($copyid, $uuid)
{
    global $conn;
     $action ="Return";
    // Prepare SQL statement
    $sql = "INSERT INTO books_report (copyid, action, uuid, date, time) VALUES (?, ?, ?, DATE(NOW()), TIME(NOW()))";


    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $copyid, $action,$uuid);

    // Execute the statement
    if (!$stmt->execute()) {
        echo "Error adding reservation: " . mysqli_error($conn);
    }

    $stmt->close();
}



function filterByDate_fromReport($startDate, $endDate)
{
    global $conn;

    $sqlTruncate = "TRUNCATE TABLE report";
    if (!$conn->query($sqlTruncate)) {
        echo "Error truncating table: " . $conn->error;
        // Handle error gracefully, e.g., log it or return false
        return false;
    }

    // Prepare the SQL statement with placeholders
    $sql = "SELECT * FROM books_report WHERE date >= ? AND date <= ? ORDER BY date DESC";

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $startDate, $endDate);

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if there are rows returned
    if ($result->num_rows > 0) {
        // Loop through the result set and display data
        while ($row = $result->fetch_assoc()) {
            $copyid = $row["copyid"];
            $uuid = $row["uuid"];
            $date = $row["date"];
            $time = $row["time"];
            $action = $row["action"];
            echo "<tr>";
            echo "<td>" . $copyid. "</td>";
            echo "<td>" . $uuid. "</td>";
            echo "<td>" . $action. "</td>";
            echo "<td>" . $date. "</td>";
            echo "<td>" . $time. "</td>";
            echo "</tr>";



            $sql2 = "INSERT INTO tempory_books_report (copyid, action, uuid, date, time)values(?,?,?,?,?)";
            $stmt = $conn->prepare($sql2);
            $stmt->bind_param("ssss", $copyid, $action,$uuid,$date,$time);


            if (!$stmt->execute()) {
            echo "Error adding for temporary table: " . $conn->error;
            }
        }
    } else {
        echo "No records found.";
    }
}




function filter_borrowed_books_count()
{
    global $conn;

    // Prepare the SQL statement with placeholders
    $sql = "SELECT COUNT(*) AS borrowed_count FROM tempory_books_report WHERE action = 'Checkout'";

    // Execute the SQL query
    $result = $conn->query($sql);

    // Check if the query executed successfully
    if ($result) {
        // Fetch the row as an associative array
        $row = $result->fetch_assoc();

        // Get the borrowed book count from the fetched row
        $borrowed_count = $row['borrowed_count'];

        // Output the borrowed book count
        echo $borrowed_count;
    } else {
        // If there was an error with the query
        echo "Error: " . $conn->error;
    }
}

function filter_returned_books_count()
{
    global $conn;

    // Prepare the SQL statement with placeholders
    $sql = "SELECT COUNT(*) AS return_count FROM tempory_books_report WHERE action = 'Return'";

    // Execute the SQL query
    $result = $conn->query($sql);

    // Check if the query executed successfully
    if ($result) {
        // Fetch the row as an associative array
        $row = $result->fetch_assoc();

        // Get the borrowed book count from the fetched row
        $return_count = $row['return_count'];

        // Output the borrowed book count
        echo $return_count;
    } else {
        // If there was an error with the query
        echo "Error: " . $conn->error;
    }
}

function filter_reserve_books_count()
{
    global $conn;

    // Prepare the SQL statement with placeholders
    $sql = "SELECT COUNT(*) AS reserve_count FROM tempory_books_report WHERE action = 'Reserve'";

    // Execute the SQL query
    $result = $conn->query($sql);

    // Check if the query executed successfully
    if ($result) {
        // Fetch the row as an associative array
        $row = $result->fetch_assoc();

        // Get the borrowed book count from the fetched row
        $reserve_count = $row['reserve_count'];

        // Output the borrowed book count
        echo $reserve_count;
    } else {
        // If there was an error with the query
        echo "Error: " . $conn->error;
    }
}

function display_filter_checkoutBooks($startdate,$enddate)
{
    $action = "Checkout";
    global $conn;
    $sql = "SELECT * FROM tempory_books_report WHERE action = ? ";

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $action);

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if there are rows returned
    if ($result->num_rows > 0) {
        // Loop through the result set and display data
        while ($row = $result->fetch_assoc()) {
            $copyid = $row["copyid"];
            $uuid = $row["uuid"];
            $date = $row["date"];

            $sql2 = "SELECT uuid as UUID FROM (SELECT * FROM staff_action_system WHERE date > $startdate AND date < $enddate) AS sas WHERE copyid = $copyid and action =$action";

            $result = $conn->query($sql);

            if ($result) {
                // Fetch the row as an associative array
                $row = $result->fetch_assoc();

                // Get the borrowed book count from the fetched row
                $staff = $row['UUID'];

            } else {
                // If there was an error with the query
                echo "Error: " . $conn->error;
            }
            echo "<tr>";
            echo "<td>" . $copyid. "</td>";
            echo "<td>" . $uuid. "</td>";
            echo "<td>" . $staff. "</td>";
            echo "<td>" . $date. "</td>";
            echo "</tr>";

        }
    } else {
        echo "No records found.";
    }
}

function display_filtered_returnedBooks($startdate,$enddate)
{
    $action = "Return";
    global $conn;
    $sql = "SELECT * FROM tempory_books_report WHERE action = ? ";

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $action);

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if there are rows returned
    if ($result->num_rows > 0) {
        // Loop through the result set and display data
        while ($row = $result->fetch_assoc()) {
            $copyid = $row["copyid"];
            $uuid = $row["uuid"];
            $date = $row["date"];

            $sql2 = "SELECT uuid as UUID FROM (SELECT * FROM staff_action_system WHERE date > $startdate AND date < $enddate) AS sas WHERE copyid = $copyid and action =$action";

            $result = $conn->query($sql);

            if ($result) {
                // Fetch the row as an associative array
                $row = $result->fetch_assoc();

                // Get the borrowed book count from the fetched row
                $staff = $row['UUID'];

            } else {
                // If there was an error with the query
                echo "Error: " . $conn->error;
            }
            echo "<tr>";
            echo "<td>" . $copyid. "</td>";
            echo "<td>" . $uuid. "</td>";
            echo "<td>" . $staff. "</td>";
            echo "<td>" . $date. "</td>";
            echo "</tr>";

        }
    } else {
        echo "No records found.";
    }
}

function display_filtered_reservedBooks($startdate,$enddate)
{
    $action = "Reserve";
    global $conn;
    $sql = "SELECT * FROM tempory_books_report WHERE action = ? ";

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $action);

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if there are rows returned
    if ($result->num_rows > 0) {
        // Loop through the result set and display data
        while ($row = $result->fetch_assoc()) {
            $copyid = $row["copyid"];
            $uuid = $row["uuid"];
            $date = $row["date"];
            $deadline = date("Y-m-d", strtotime($date . " +5 days"));;
            echo "<tr>";
            echo "<td>" . $copyid. "</td>";
            echo "<td>" . $uuid. "</td>";
            echo "<td>" . $date. "</td>";
            echo "<td>" . $deadline. "</td>";
            echo "</tr>";

        }
    } else {
        echo "No records found.";
    }
}



/*
function display_filtered_overdue_books()
{
    $action = "Return";
    $action2 = "Checkout";
    global $conn;
    $sql = "SELECT * FROM tempory_books_report WHERE action = ? ";

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $action);

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if there are rows returned
    if ($result->num_rows > 0) {
        // Loop through the result set and display data
        while ($row = $result->fetch_assoc()) {
            $copyid = $row["copyid"];
            $uuid = $row["uuid"];
            $returndate = $row["date"];

            $sql2 = "SELECT date as checkoutdate from tempory_books_report WHERE copyid = $copyid and action =$action2";

            $result = $conn->query($sql);

            if ($result) {
                // Fetch the row as an associative array
                $row = $result->fetch_assoc();

                // Get the borrowed book count from the fetched row
                $checkoutdate = $row["checkoutdate"];

                $checkoutDateTime = new DateTime($checkoutdate);
                $returnDateTime = new DateTime($returndate);
                $overdueInterval = $returnDateTime->diff($checkoutDateTime);
                $overdueTime = $overdueInterval->days;

            } else {
                // If there was an error with the query
                echo "Error: " . $conn->error;
            }
            echo "<tr>";
            echo "<td>" . $copyid . "</td>";
            echo "<td>" . $uuid . "</td>";
            echo "<td>" . $checkoutdate . "</td>";
            echo "<td>" . $overdueTime . "</td>";
            echo "</tr>";

        }
    } else {
        echo "No records found.";
    }
}



overdue fiter function hreeee.................................................*/



/*..........................USER ACTIONS......................................................*/

function  userlogin($userID)
{
    global $conn;
    $sql = "INSERT INTO user_access_system (uuid,access,date,time) values(?,'LOGIN',DATE(NOW()), TIME(NOW()))";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",$userID);

    // Execute the statement
    if (!$stmt->execute()) {
        echo "Error adding reservation: " . mysqli_error($conn);
    }

    $stmt->close();

}

function  userlogout($userID)
{
    global $conn;
    $sql = "INSERT INTO user_access_system (uuid,access,date,time) values(?,'LOGOUT',DATE(NOW()), TIME(NOW()))";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",$userID);

    // Execute the statement
    if (!$stmt->execute()) {
        echo "Error adding reservation: " . mysqli_error($conn);
    }

    $stmt->close();

}

/* ....................Staff actions with books..................................................................*/
function staff_action_with_book($uuid,$copyid,$action)
{

    global $conn;
    $sql ="INSERT INTO staff_action_system(uuid,action,copyid,date,time) values(?,?,?,DATE(NOW()), TIME(NOW()))";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss",$uuid,$action,$copyid);

    // Execute the statement
    if (!$stmt->execute()) {
        echo "Error adding reservation: " . mysqli_error($conn);
    }

    $stmt->close();
}





/*........................past_user..................................*/

function add_past_user($uuid,$admin_id)
{
    global $conn;

    $sql = "SELECT * FROM user WHERE uuid = ?";

    // Prepare and bind parameters
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",$uuid);

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if there are rows returned
    if ($result->num_rows > 0) {
        // Loop through the result set and display data
        while ($row = $result->fetch_assoc()) {
            $nic=$row["nic"];
            $name=$row["name"];
            $email=$row["email"];

            $sql2 = "INSERT INTO past_users (nic,name,email,banned_date,admin_id)values(?,?,?,DATE(now()),?)";
            $stmt = $conn->prepare($sql2);
            $stmt->bind_param("ssss", $nic, $name,$email,$date,$admin_id);


            if (!$stmt->execute()) {
            echo "Error adding for past_user table: " . $conn->error;
            }
        }
    } else {
        echo "No records found.";
    }

}


?>