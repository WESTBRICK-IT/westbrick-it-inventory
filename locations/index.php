<!-- Made by Christopher Barber August 2024 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Westbrick IT Inventory - Location</title>
    <link rel="stylesheet" href="../style/style.css">
    <script src="../script/sub-menu-script.js" defer></script>
    <link rel="icon" href="../favicon.ico" type="image/x-icon">
</head>
<body>
    <a href="../"><img class="main-title" src="../images/westbrick-it-inventory.svg" alt="Westbrick IT Inventory"></a>
    <h1 class="sub-page-title">Location</h1>
    <button class="button" onclick="window.location.href='./add-new-location/'" type="button">Add New Location</button>
    <div class="table-wrapper">
        <table class="sub-menu-table">
            <thead>
                <tr>
                    <th>Location Name</th>
                    <th>City/Town</th>
                    <th>Room Number</th>
                    <th>LSD Coordinate</th>
                    <th>Latitude</th>
                    <th>Longitude</th>                    
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
            <?php

                $allowedIPs = array('206.174.198.58', '206.174.198.59', '50.99.132.206'); // Define the list of allowed IP addresses

                $remoteIP = $_SERVER['REMOTE_ADDR']; // Get the remote IP address of the client

                if (!in_array($remoteIP, $allowedIPs)) {
                    // Unauthorized access - display an error message or redirect
                    echo "<h1>Access denied. Your IP address is not allowed to view these items.</h1>";
                    exit();
                }
                function convertApostrophe($string) { 
                    $newString = str_replace("`", "'", $string); 
                    return $newString; 
                }
                // Connect to the database
                $conn = mysqli_connect("localhost", "cbarber", "!!!Dr0w554p!!!", "IT_Inventory_DB");

                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                $query = "SELECT * FROM `locations` ORDER BY `location_name` DESC, `city_town` DESC";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {                                            
                    while($row = mysqli_fetch_assoc($result)) {

                        $locationName = $row['location_name'];
                        $cityOrTown = $row['city_town'];
                        $roomNumber = $row['room_number'];
                        $lsdCoordinates = $row['lsd_coordinate'];
                        $latitude = $row['latitude'];
                        $longitude = $row['longitude'];
                        $id = $row['id'];                        
                        
                        echo    "       <tr>";
                        echo    "           <td>$locationName</td>";
                        echo    "           <td>$cityOrTown</td>";
                        echo    "           <td>$roomNumber</td>";
                        echo    "           <td>$lsdCoordinates</td>";
                        echo    "           <td>$latitude</td>";
                        echo    "           <td>$longitude</td>";
                        echo    "           <td><img class='garbage-can garbage-can$id equipment-garbage-can equipment-garbage-can$id' src='../images/garbage-can.svg' alt='equipment Garbage Can $id'></td>";
                        echo    "       </tr>"; 
                        
                    }
                }
            ?>
            </tbody>
        </table>
    </div>
    <button class="button go-back-button" type="button">Go back</button>
</body>
</html>