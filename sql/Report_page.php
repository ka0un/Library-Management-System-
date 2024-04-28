<?php
  require_once __DIR__ . '/../database/database.php';
  require_once __DIR__ . '/../config.php';
  require_once __DIR__ . '/../sql/copies.php';
   require_once __DIR__ . '/../sql/checkouts.php';

  $conn = getConnection();
  $reservedCopies = array();
  function get_data_forReport($action,$tabel_name){
      Global $conn;
      $sql = "SELECT uuid , bookid , DATE(start) AS start_date, TIME(start) AS start_time From $tabel_name";
      $result = $conn->query($sql);
      if($result ->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              $bookID = $row["bookid"];
              $copies = get_array_of_copyids($bookID);

              foreach ($copies as $copyid) {
                  $Non_available = is_copy_alredy_checked_out($copyid);

                  if ($Non_available == 0) {
                      if (isReserved($copyid) == "can reserve") {
                          $copyID = $copyid;
                          addReservedCopy($copyid);
                          break;
                      }
                  }
              }

              $uuid = $row["uuid"];
              $date = $row["start_date"];
              $time = $row["start_time"];


          }
      }
      else{
          echo"Error";
      }
      $conn->close();

  }

  function addReservedCopy($copy) {
    global $reservedCopies;
    $reservedCopies[] = $copy;
}

function isReserved($copy)
{
    global $reservedCopies;
    $resavation = in_array($copy, $reservedCopies);
    if ($resavation == 0) {
        return "can reserve";
    }
}

function insert_data_For_Report($copyid,$action,$userid,$date,$time)
{
    global $conn;
    $sql = "Insert into report values($copyid,$action,$userid,$date,$time);";
    if ($conn->query($sql) !== TRUE) return true; // Return true if insertion was successful
    {
        echo"Cant record insert!!";
    }

}


function read_data_fromReport()
{
    global $conn;
    $sql = "select * from report";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["copyid"] . "</td>";
            echo "<td>" . $row["userid"] . "</td>";
            echo "<td>" . $row["action"] . "</td>";
            echo "<td>" . $row["start_date"] . "</td>";
            echo "<td>" . $row["start_time"] . "</td>";
            echo "</tr>";
        }
    }

}

function fiterByDate_fromReport($startDate,$endDate)
{
    global $conn;
    $sql = "select * from report where date > $startDate and date < $endDate order by date desc";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["copyid"] . "</td>";
            echo "<td>" . $row["userid"] . "</td>";
            echo "<td>" . $row["action"] . "</td>";
            echo "<td>" . $row["start_date"] . "</td>";
            echo "<td>" . $row["start_time"] . "</td>";
            echo "</tr>";
        }
    }
}


get_data_forReport("reserve", "reservations");



