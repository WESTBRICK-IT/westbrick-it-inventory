<!-- Made by Christopher Barber July 2024 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Westbrick IT Inventory - User - Location</title>
    <link rel="stylesheet" href="../style/style.css">
    <script src="../script/sub-menu-script.js" defer></script>    
    <link rel="icon" href="../favicon.ico" type="image/x-icon">
</head>
<body>
    <a href="../"><img class="main-title" src="../images/westbrick-it-inventory.svg" alt="Westbrick IT Inventory"></a>
    <h1 class="sub-page-title">User - Location</h1>    
    <div class="table-wrapper">
        <table class="sub-menu-table">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>First Name</th>
                    <th>Last Name</th>                                        
                    <th>Location Name</th>
                    <th>City/Town</th>
                    <th>Room Number</th>
                </tr>
            </thead>
            <tbody>
            <?php
                function convertApostrophe($string) { 
                    $newString = str_replace("`", "'", $string); 
                    return $newString; 
                }
                function connectToDatabase(){
                    $allowedIPs = array('206.174.198.58', '206.174.198.59', '50.99.132.206'); // Define the list of allowed IP addresses
                    $remoteIP = $_SERVER['REMOTE_ADDR']; // Get the remote IP address of the client        
                    if (!in_array($remoteIP, $allowedIPs)) {
                        // Unauthorized access - display an error message or redirect
                        echo "<h1>Access denied. Your IP address is not allowed to view these items.</h1>";
                        exit();
                    }                    
                    // Connect to the database
                    $conn = mysqli_connect("localhost", "cbarber", "!!!Dr0w554p!!!", "IT_Inventory_DB");            
                    // Check connection
                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }
                    return $conn;
                }

                function getTheUser($id, $conn){
                    // echo    "<h1>User ID: $id</h1>";
                    $query = "SELECT * FROM `users` WHERE id = $id";
                    $result = mysqli_query($conn, $query);
                    if ($row = mysqli_fetch_assoc($result)) {
                        $userName = $row['username'];
                        $firstName = $row['first_name'];
                        $lastName = $row['last_name'];
                    } else {
                        echo "No user found with ID: " . htmlspecialchars($id);
                    }                    
                    // echo    "<h1>Username: $userName</h1>";
                    // echo    "<h1>First Name: $firstName</h1>";
                    // echo    "<h1>Last Name: $lastName</h1>";
                    $userDataArray = ['userName' => $userName, 'firstName' => $firstName, 'lastName' => $lastName];
                    return $userDataArray;
                }
                function getTheLocation($id, $conn) {
                    $query = "SELECT * FROM `locations` WHERE id = $id";
                    $result = mysqli_query($conn, $query);
                    if ($row = mysqli_fetch_assoc($result)) {
                        $locationName = $row['location_name'];
                        $roomNumber = $row['room_number'];
                        $cityTown = $row['city_town'];
                    } else {
                        echo "No user found with ID: " . htmlspecialchars($id);
                    }
                    // echo    "<h1>Location Name: $locationName</h1>";
                    // echo    "<h1>Room Number: $roomNumber</h1>";
                    // echo    "<h1>City or Town: $cityTown</h1>";
                    $locationArray = ['locationName' => $locationName, 'roomNumber' => $roomNumber, 'cityTown' => $cityTown];
                    return $locationArray;
                }

                function executeNestedDatabaseQuery($typeAndID_Array, $conn) {
                    if($typeAndID_Array['firstType'] == 'user') {
                        $userDataArray = getTheUser($typeAndID_Array['firstID'], $conn);
                    } else {
                        $userDataArray = getTheUser($typeAndID_Array['secondID'], $conn);
                    }
                    if($typeAndID_Array['secondType'] == 'location') {
                        $locationArray = getTheLocation($typeAndID_Array['secondID'], $conn);
                    } else {
                        $locationArray = getTheLocation($typeAndID_Array['firstID'], $conn);
                    }
                    $userAndLocationArray = array_merge($userDataArray, $locationArray);                    
                    return $userAndLocationArray;
                }

                function displayTableRow($userAndLocationArray) {
                    $userName = $userAndLocationArray['userName'];
                    $firstName = $userAndLocationArray['firstName'];
                    $lastName = $userAndLocationArray['lastName'];
                    $locationName = $userAndLocationArray['locationName'];
                    $cityTown = $userAndLocationArray['cityTown'];
                    $roomNumber = $userAndLocationArray['roomNumber'];
                    echo    "       <tr>";
                    echo    "           <td>$userName</td>";
                    echo    "           <td>$firstName</td>";
                    echo    "           <td>$lastName</td>";
                    echo    "           <td>$locationName</td>";
                    echo    "           <td>$cityTown</td>";
                    echo    "           <td>$roomNumber</td>";
                    echo    "       </tr>";
                }
                function executeDatabaseQuery($conn){
                    $query = "SELECT * FROM `links` 
                        WHERE (first_type = 'user' AND second_type = 'location')
                        OR (first_type = 'location' AND second_type = 'user')
                        ORDER BY `date` DESC, `time` DESC";
                    $result = mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) > 0) {                                            
                        while($row = mysqli_fetch_assoc($result)){
                            $firstType = $row["first_type"];
                            $secondType = $row["second_type"];
                            $firstID = $row["first_id"];
                            $secondID = $row["second_id"];
                            
                            $typeAndID_Array = ['firstType' => $firstType, 'secondType' => $secondType, 'firstID' => $firstID, 'secondID' => $secondID];

                            $userAndLocationArray = executeNestedDatabaseQuery($typeAndID_Array, $conn);

                            displayTableRow($userAndLocationArray);
                        }
                    }
                }
                function mainFunction(){
                    $conn = connectToDatabase();
                    executeDatabaseQuery($conn);
                    $conn->close();
                }
                mainFunction();                
            ?>
            </tbody>
        </table>
    </div>
    <button class="button go-back-button" type="button">Go back</button>
</body>
</html>