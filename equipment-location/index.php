<!-- Made by Christopher Barber July 2024 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Westbrick IT Inventory - Equipment - Location</title>
    <link rel="stylesheet" href="../style/style.css">
    <script src="../script/sub-menu-script.js" defer></script>    
    <link rel="icon" href="../favicon.ico" type="image/x-icon">
</head>
<body>
    <a href="../"><img class="main-title" src="../images/westbrick-it-inventory.svg" alt="Westbrick IT Inventory"></a>
    <h1 class="sub-page-title">Equipment - Location</h1>
    <div class="table-wrapper">
        <table class="sub-menu-table">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Name</th>
                    <th>Model Name</th>
                    <th>Model Number</th>
                    <th>Serial Number</th>
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

                function getTheEquipment($id, $conn){
                    // echo    "<h1>User ID: $id</h1>";
                    $query = "SELECT * FROM `equipment` WHERE id = $id";
                    $result = mysqli_query($conn, $query);
                    if ($row = mysqli_fetch_assoc($result)) {
                        $type = $row['type'];
                        $name = $row['name'];                        
                        $modelName = $row['model_name'];
                        $modelNumber = $row['model_number'];
                        $serialNumber = $row['serial_number'];
                    } else {
                        echo "No equipment found with ID: " . htmlspecialchars($id);
                    }                                        
                    $equipmentDataArray = ['type' => $type, 'name' => $name, 'modelName' => $modelName, 'modelNumber' => $modelNumber, 'serialNumber' => $serialNumber];
                    return $equipmentDataArray;
                }
                function getTheLocation($id, $conn) {
                    $query = "SELECT * FROM `locations` WHERE id = $id";
                    $result = mysqli_query($conn, $query);
                    if ($row = mysqli_fetch_assoc($result)) {
                        $locationName = $row['location_name'];
                        $cityTown = $row['city_town'];
                        $roomNumber = $row['room_number'];                        
                    } else {
                        echo "No location found with ID: " . htmlspecialchars($id);
                    }
                    $locationArray = ['locationName' => $locationName, 'cityTown' => $cityTown, 'roomNumber' => $roomNumber];
                    return $locationArray;
                }

                function executeNestedEquipmentLocationDatabaseQuery($typeAndID_Array, $conn) {
                    if($typeAndID_Array['firstType'] == 'equipment') {
                        $equipmentDataArray = getTheEquipment($typeAndID_Array['firstID'], $conn);
                    } else {
                        $equipmentDataArray = getTheEquipment($typeAndID_Array['secondID'], $conn);
                    }
                    if($typeAndID_Array['secondType'] == 'location') {
                        $locationArray = getTheLocation($typeAndID_Array['secondID'], $conn);
                    } else {
                        $locationArray = getTheLocation($typeAndID_Array['firstID'], $conn);
                    }
                    $equipmentAndLocationArray = array_merge($equipmentDataArray, $locationArray);
                    return $equipmentAndLocationArray;
                }

                function displayTableRow($equipmentAndLocationArray) {
                    $type = $equipmentAndLocationArray['type'];
                    $name = $equipmentAndLocationArray['name'];
                    $modelName = $equipmentAndLocationArray['modelName'];
                    $modelNumber = $equipmentAndLocationArray['modelNumber'];
                    $serialNumber = $equipmentAndLocationArray['serialNumber'];
                    $locationName = $equipmentAndLocationArray['locationName'];
                    $cityTown = $equipmentAndLocationArray['cityTown'];
                    $roomNumber = $equipmentAndLocationArray['roomNumber'];
                    echo    "       <tr>";
                    echo    "           <td>$type</td>";
                    echo    "           <td>$name</td>";
                    echo    "           <td>$modelName</td>";
                    echo    "           <td>$modelNumber</td>";
                    echo    "           <td>$serialNumber</td>";
                    echo    "           <td>$locationName</td>";
                    echo    "           <td>$cityTown</td>";
                    echo    "           <td>$roomNumber</td>";
                    echo    "       </tr>";
                }
                function executeDatabaseQuery($conn){
                    $query = "SELECT * FROM `links` 
                        WHERE (first_type = 'equipment' AND second_type = 'location')
                        OR (first_type = 'location' AND second_type = 'equipment')
                        ORDER BY `date` DESC, `time` DESC";
                    $result = mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) > 0) {                                 
                        while($row = mysqli_fetch_assoc($result)){
                            $firstType = $row["first_type"];
                            $secondType = $row["second_type"];
                            $firstID = $row["first_id"];
                            $secondID = $row["second_id"];
                            
                            $typeAndID_Array = ['firstType' => $firstType, 'secondType' => $secondType, 'firstID' => $firstID, 'secondID' => $secondID];

                            $equipmentAndLocationArray = executeNestedEquipmentLocationDatabaseQuery($typeAndID_Array, $conn);

                            displayTableRow($equipmentAndLocationArray);
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