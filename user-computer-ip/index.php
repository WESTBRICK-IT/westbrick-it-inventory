<!-- Made by Christopher Barber July 2024 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Westbrick IT Inventory - User - Equipment - IP</title>
    <link rel="stylesheet" href="../style/style.css">
    <script src="../script/sub-menu-script.js" defer></script>    
    <link rel="icon" href="../favicon.ico" type="image/x-icon">
</head>
<body>
    <a href="../"><img class="main-title" src="../images/westbrick-it-inventory.svg" alt="Westbrick IT Inventory"></a>
    <h1 class="sub-page-title">User - Equipment - IP</h1>
    <div class="table-wrapper">
        <table class="sub-menu-table">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Type</th>
                    <th>Model Name</th>
                    <th>Name</th>
                    <th>Serial Number</th>
                    <th>Warranty End</th>
                </tr>
            </thead>
            <tbody>
            <?php
                include '../common-functions/common-functions.php';
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
                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }
                    return $conn;
                }

                function getTheUser($id, $conn){                    
                    $query = "SELECT * FROM `users` WHERE id = $id";
                    $result = mysqli_query($conn, $query);
                    if ($row = mysqli_fetch_assoc($result)) {
                        $userName = $row['username'];
                        $firstName = $row['first_name'];
                        $lastName = $row['last_name'];
                    } else {
                        echo "No user found with ID: " . htmlspecialchars($id);
                    }
                    $userDataArray = ['userName' => $userName, 'firstName' => $firstName, 'lastName' => $lastName];
                    return $userDataArray;
                }
                function getTheEquipment($id, $conn) {
                    $query = "SELECT * FROM `equipment` WHERE id = $id";
                    $result = mysqli_query($conn, $query);
                    if ($row = mysqli_fetch_assoc($result)) {                        
                        $equipmentType = $row['type'];
                        $modelName = $row['model_name'];
                        $name = $row['name'];
                        $warrantyEnd = $row['warranty_end'];
                        $serialNumber = $row['serial_number'];
                    } else {
                        echo "No user found with ID: " . htmlspecialchars($id);
                    }
                    $equipmentArray = ['equipmentType' => $equipmentType, 'modelName' => $modelName, 'name' => $name, 'warrantyEnd' => $warrantyEnd, 'serialNumber' => $serialNumber];
                    return $equipmentArray;
                }

                function executeNestedDatabaseQuery($typeAndID_Array, $conn) {
                    if($typeAndID_Array['firstType'] == 'user') {
                        $userDataArray = getTheUser($typeAndID_Array['firstID'], $conn);
                    } else {
                        $userDataArray = getTheUser($typeAndID_Array['secondID'], $conn);
                    }
                    if($typeAndID_Array['secondType'] == 'equipment') {
                        $equipmentArray = getTheEquipment($typeAndID_Array['secondID'], $conn);
                    } else {
                        $equipmentArray = getTheEquipment($typeAndID_Array['firstID'], $conn);
                    }
                    $userAndEquipmentArray = array_merge($userDataArray, $equipmentArray);
                    return $userAndEquipmentArray;
                }

                function displayTableRow($userAndEquipmentArray) {
                    $userName = $userAndEquipmentArray['userName'];
                    $firstName = $userAndEquipmentArray['firstName'];
                    $lastName = $userAndEquipmentArray['lastName'];
                    $equipmentType = $userAndEquipmentArray['equipmentType'];
                    $modelName = $userAndEquipmentArray['modelName'];
                    $name = $userAndEquipmentArray['name'];
                    $warrantyEnd = $userAndEquipmentArray['warrantyEnd'];
                    $serialNumber = $userAndEquipmentArray['serialNumber'];
                    echo    "       <tr>";
                    echo    "           <td>$userName</td>";
                    echo    "           <td>$firstName</td>";
                    echo    "           <td>$lastName</td>";
                    echo    "           <td>$equipmentType</td>";
                    echo    "           <td>$modelName</td>";
                    echo    "           <td>$name</td>";
                    echo    "           <td>$serialNumber</td>";
                    echo    "           <td>$warrantyEnd</td>";
                    echo    "       </tr>";
                }
                function getTheTypeAndID($row){
                    $firstType = $row["first_type"];
                    $secondType = $row["second_type"];
                    $firstID = $row["first_id"];
                    $secondID = $row["second_id"];                            
                    $typeAndID_Array = ['firstType' => $firstType, 'secondType' => $secondType, 'firstID' => $firstID, 'secondID' => $secondID];
                    return $typeAndID_Array;
                }

                function doTheUserEquipmentQuery($conn, $userEquipmentQueryString, $userAndEquipmentArrayOfArrays) {
                    $result = mysqli_query($conn, $userEquipmentQueryString);
                    if (mysqli_num_rows($result) > 0) {                                            
                        while($row = mysqli_fetch_assoc($result)){                            
                            $typeAndID_Array = getTheTypeAndID($row);
                            $userAndEquipmentArray = executeNestedDatabaseQuery($typeAndID_Array, $conn);
                            array_push($userAndEquipmentArrayOfArrays, $userAndEquipmentArray);                            
                        }
                    }
                    return $userAndEquipmentArrayOfArrays;
                }

                function createTheUserEquipmentDatabaseQueryString(){
                    $queryString = "SELECT * FROM `links` 
                        WHERE (first_type = 'user' AND second_type = 'equipment')
                        OR (first_type = 'equipment' AND second_type = 'user')
                        ORDER BY `date` DESC, `time` DESC";
                    return $queryString;
                }

                function createTheEquipmentIP_DatabasequeryString() {
                    $equipmentIP_QueryString = "SELECT * FROM `links` 
                    WHERE (first_type = 'equipment' AND second_type = 'ip')
                    OR (first_type = 'ip' AND second_type = 'equipment')
                    ORDER BY `date` DESC, `time` DESC";
                    return $equipmentIP_QueryString;
                }

                function doTheEquipmentIP_Query($conn, $equipmentIP_QueryString, $equipmentIP_ArrayOfArrays){
                    $result = mysqli_query($conn, $equipmentIP_QueryString);
                    if (mysqli_num_rows($result) > 0) {                                 
                        while($row = mysqli_fetch_assoc($result)){
                            $firstType = $row["first_type"];
                            $secondType = $row["second_type"];
                            $firstID = $row["first_id"];
                            $secondID = $row["second_id"];                            
                            $typeAndID_Array = ['firstType' => $firstType, 'secondType' => $secondType, 'firstID' => $firstID, 'secondID' => $secondID];
                            $equipmentAndIP_Array = executeNestedEquipmentIP_DatabaseQuery($typeAndID_Array, $conn);
                            array_push($equipmentIP_ArrayOfArrays, $equipmentAndIP_Array);                            
                        }
                    }
                    return $equipmentIP_ArrayOfArrays;
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

                function findIntersectEquipmentUserIP(){
                    
                }
                function executeDatabaseQuery($conn){
                    $userEquipmentArrayOfArrays = [];
                    $equipmentIP_ArrayOfArrays = [];
                    $intersectEquipmentUserIP_Array = [];
                    $userEquipmentQueryString = createTheUserEquipmentDatabaseQueryString();
                    $userEquipmentArrayOfArrays = doTheUserEquipmentQuery($conn, $userEquipmentQueryString, $userEquipmentArrayOfArrays);
                    $equipmentIP_QueryString = createTheEquipmentIP_DatabasequeryString();
                    $equipmentIP_ArrayOfArrays = doTheEquipmentIP_Query($conn, $equipmentIP_QueryString, $equipmentIP_ArrayOfArrays);
                    $intersectEquipmentUserIP_Array = findIntersectEquipmentUserIP($intersectEquipmentUserIP_Array, $userEquipmentArrayOfArrays, $equipmentIP_ArrayOfArrays);
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