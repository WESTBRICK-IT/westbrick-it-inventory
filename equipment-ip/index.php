<!-- Made by Christopher Barber July 2024 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Westbrick IT Inventory - Equipment - IP</title>
    <link rel="stylesheet" href="../style/style.css">
    <script src="../script/sub-menu-script.js" defer></script>    
    <link rel="icon" href="../favicon.ico" type="image/x-icon">
</head>
<body>
    <a href="../"><img class="main-title" src="../images/westbrick-it-inventory.svg" alt="Westbrick IT Inventory"></a>
    <h1 class="sub-page-title">Equipment - IP</h1>
    <div class="table-wrapper">
        <table class="sub-menu-table">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Name</th>
                    <th>Model Name</th>
                    <th>Model Number</th>
                    <th>Serial Number</th>
                    <th>IP</th>
                    <th>Port</th>                    
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
                function getTheIP($id, $conn) {
                    $query = "SELECT * FROM `ip_and_ports` WHERE id = $id";
                    $result = mysqli_query($conn, $query);
                    if ($row = mysqli_fetch_assoc($result)) {
                        $iP = $row['ip'];
                        $port = $row['port'];                        
                    } else {
                        echo "No user found with ID: " . htmlspecialchars($id);
                    }
                    // echo    "<h1>Location Name: $locationName</h1>";
                    // echo    "<h1>Room Number: $roomNumber</h1>";
                    // echo    "<h1>City or Town: $cityTown</h1>";
                    $iP_Array = ['iP' => $iP, 'port' => $port];
                    return $iP_Array;
                }

                function executeNestedEquipmentIP_DatabaseQuery($typeAndID_Array, $conn) {
                    if($typeAndID_Array['firstType'] == 'equipment') {
                        $equipmentDataArray = getTheEquipment($typeAndID_Array['firstID'], $conn);
                    } else {
                        $equipmentDataArray = getTheEquipment($typeAndID_Array['secondID'], $conn);
                    }
                    if($typeAndID_Array['secondType'] == 'ip') {
                        $iP_Array = getTheIP($typeAndID_Array['secondID'], $conn);
                    } else {
                        $iP_Array = getTheIP($typeAndID_Array['firstID'], $conn);
                    }
                    $equipmentAndIP_Array = array_merge($equipmentDataArray, $iP_Array);
                    return $equipmentAndIP_Array;
                }

                function displayTableRow($equipmentAndIP_Array) {
                    $type = $equipmentAndIP_Array['type'];
                    $name = $equipmentAndIP_Array['name'];
                    $modelName = $equipmentAndIP_Array['modelName'];
                    $modelNumber = $equipmentAndIP_Array['modelNumber'];
                    $serialNumber = $equipmentAndIP_Array['serialNumber'];
                    $iP = $equipmentAndIP_Array['iP'];
                    $port = $equipmentAndIP_Array['port'];                                        
                    echo    "       <tr>";
                    echo    "           <td>$type</td>";
                    echo    "           <td>$name</td>";
                    echo    "           <td>$modelName</td>";
                    echo    "           <td>$modelNumber</td>";
                    echo    "           <td>$serialNumber</td>";
                    echo    "           <td>$iP</td>";
                    echo    "           <td>$port</td>";                    
                    echo    "       </tr>";
                }
                function executeDatabaseQuery($conn){
                    $query = "SELECT * FROM `links` 
                        WHERE (first_type = 'equipment' AND second_type = 'ip')
                        OR (first_type = 'ip' AND second_type = 'equipment')
                        ORDER BY `date` DESC, `time` DESC";
                    $result = mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) > 0) {                                 
                        while($row = mysqli_fetch_assoc($result)){
                            $firstType = $row["first_type"];
                            $secondType = $row["second_type"];
                            $firstID = $row["first_id"];
                            $secondID = $row["second_id"];
                            
                            $typeAndID_Array = ['firstType' => $firstType, 'secondType' => $secondType, 'firstID' => $firstID, 'secondID' => $secondID];

                            $equipmentAndIP_Array = executeNestedEquipmentIP_DatabaseQuery($typeAndID_Array, $conn);

                            displayTableRow($equipmentAndIP_Array);
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