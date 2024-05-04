<?php
  require_once __DIR__ . '/../database/database.php';
  require_once __DIR__ . '/../config.php';
  require_once __DIR__ . '/../sql/copies.php';
  require_once __DIR__ . '/../sql/checkouts.php';

  global $conn;
  $conn = getConnection();
  $reservedCopies = array();
  function get_data_forReport($action, $table_name)
  {
      global $conn;

      $sql = "SELECT uuid, bookid, DATE(start) AS start_date, TIME(start) AS start_time FROM $table_name";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              $uuid = $row["uuid"];
              $copyid = $row["bookid"];
              $date = $row["start_date"];
              $time = $row["start_time"];


              insert_data_For_Report($copyid, $action, $uuid, $date, $time);
          }
      } else {
          echo "error";
      }
  }

function get_data_forReport_from_checkout($action, $table_name)
  {
      global $conn;

      $sql = "SELECT uuid, copyid, DATE(start) AS start_date, TIME(start) AS start_time FROM $table_name";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              $uuid = $row["uuid"];
              $copyid = $row["bookid"];
              $date = $row["start_date"];
              $time = $row["start_time"];


              insert_data_For_Report($copyid, $action, $uuid, $date, $time);
          }
      } else {
          echo "error";
      }
  }


  function addReservedCopy($copy) {
    global $reservedCopies;
    $reservedCopies[] = $copy;
}


function isReserved($copy)
{
    global $reservedCopies;
    $reservation = in_array($copy, $reservedCopies);
    if (!$reservation) {
        return "can reserve";
    } else {
        return "copy already reserved";
    }
}


function insert_data_For_Report($copyid, $action, $uuid, $date, $time)
{
    global $conn; // Assuming $conn is your database connection object

    // Using prepared statements to prevent SQL injection
    $sqlTruncate = "TRUNCATE TABLE report";
    if (!$conn->query($sqlTruncate)) {
        echo "Error truncating table: " . $conn->error;
        // Handle error gracefully, e.g., log it or return false
        return false;
    }

    $sql = "INSERT INTO report (copyid, action, uuid, date, time) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiss", $copyid, $action, $uuid, $date, $time);
    if (!$stmt->execute()) {
        echo "Error inserting data: " . $stmt->error;
        // Handle error gracefully, e.g., log it or return false
        return false;
    }

    // Close prepared statement
    $stmt->close();

    return true; // Insertion successful
}


function read_data_fromReport()
{
    global $conn;
    $sql = "SELECT * FROM report";
    $result = $conn->query($sql);

    if (!$result) {
        echo "Error: " . $conn->error;
        // Handle error gracefully, e.g., log it or return false
        return;
    }

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["copyid"] . "</td>";
            echo "<td>" . $row["action"] . "</td>";
            echo "<td>";
            // Check if $uuid is empty before echoing
            echo $row["uuid"] ? $row["uuid"] : "No UUID"; // If $uuid is empty, print "No UUID"
            echo "</td>";
            echo "<td>" . $row["date"] . "</td>";
            echo "<td>" . $row["time"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "No records found.";
    }
}


function filterByDate_fromReport($startDate, $endDate)
{
    global $conn;

    // Prepare the SQL statement with placeholders
    $sql = "SELECT * FROM report WHERE date > ? AND date < ? ORDER BY date DESC";

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
            echo "<tr>";
            echo "<td>" . $row["copyid"] . "</td>";
            echo "<td>" . $row["uuid"] . "</td>";
            echo "<td>" . $row["action"] . "</td>";
            echo "<td>" . $row["date"] . "</td>";
            echo "<td>" . $row["time"] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "No records found.";
    }

    // Close the statement
    $stmt->close();
}



?>



