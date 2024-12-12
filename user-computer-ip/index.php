<!-- Made by Christopher Barber July 2024 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Westbrick IT Inventory - User - Computer - IP</title>
    <link rel="stylesheet" href="../style/style.css">
    <script src="../script/sub-menu-script.js" defer></script>    
    <link rel="icon" href="../favicon.ico" type="image/x-icon">
</head>
<body>
    <a href="../"><img class="main-title" src="../images/westbrick-it-inventory.svg" alt="Westbrick IT Inventory"></a>
    <h1 class="sub-page-title">User - Computer - IP</h1>
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
                    <th>IP</th>
                    <th>Remote Desktop Port Number</th>
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
                    $query = "SELECT * FROM `equipment` WHERE id = $id AND type = 'computer'";
                    $result = mysqli_query($conn, $query);
                    if ($row = mysqli_fetch_assoc($result)) {                        
                        $equipmentType = $row['type'];                        
                        $modelName = $row['model_name'];
                        $name = $row['name'];
                        $warrantyEnd = $row['warranty_end'];
                        $serialNumber = $row['serial_number'];
                    } else {
                        echo "No equipment found with ID: " . htmlspecialchars($id);
                    }
                    $equipmentArray = ['equipmentType' => $equipmentType, 'modelName' => $modelName, 'name' => $name, 'warrantyEnd' => $warrantyEnd, 'serialNumber' => $serialNumber];
                    return $equipmentArray;
                }

                function getTheIP($id, $conn) {
                    $query = "SELECT * FROM `ip_and_ports` WHERE id = $id";
                    $result = mysqli_query($conn, $query);
                    if ($row = mysqli_fetch_assoc($result)) {                        
                        $iP = $row['ip'];                        
                        $port = $row['port'];
                    } else {
                        echo "No IP found with ID: " . htmlspecialchars($id);
                    }
                    $iP_Array = ['iP' => $iP, 'port' => $port];
                    return $iP_Array;
                }

                function executeComputerIP_Query($userAndEquipmentArray){
                    //$query = "SELECT * FROM `ip_and_ports` WHERE id = $id AND type = 'computer'";
                }

                function executeUserEquipmentNestedDatabaseQuery($typeAndID_Array, $conn) {
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
                    //executeComputerIP_Query($userAndEquipmentArray);
                    return $userAndEquipmentArray;
                }

                function executeNestedEquipmentIP_DatabaseQuery($typeAndID_Array, $conn){
                    if($typeAndID_Array['firstType'] == 'ip') {                                                
                        $iP_Array = getTheIP($typeAndID_Array['firstID'], $conn);                        
                    } else {                        
                        $iP_Array = getTheIP($typeAndID_Array['secondID'], $conn);
                    }
                    if($typeAndID_Array['secondType'] == 'equipment') {
                        $equipmentArray = getTheEquipment($typeAndID_Array['secondID'], $conn);
                    } else {
                        $equipmentArray = getTheEquipment($typeAndID_Array['firstID'], $conn);
                    }
                    $iP_AndEquipmentArray = array_merge($iP_Array, $equipmentArray);                    
                    return $iP_AndEquipmentArray;
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
                function doTheUserAndEquipmentQuery($conn, $userAndEquipmentLinkQueryString, $arrayOfUserAndEquipmentArrays) {                    
                    $result = mysqli_query($conn, $userAndEquipmentLinkQueryString);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)){
                            $typeAndID_Array = getTheTypeAndID($row);
                            $userAndEquipmentArray = executeUserEquipmentNestedDatabaseQuery($typeAndID_Array, $conn);
                            //add array to array of equipment arrays
                            $arrayOfUserAndEquipmentArrays[] = $userAndEquipmentArray;          
                                                      
                        }
                    }                    
                    return $arrayOfUserAndEquipmentArrays;
                }
                function doTheEquipmentAndIP_Query($conn, $equipmentIP_LinkQueryString, $arrayOfEquipmentAndIPArrays){
                    $result = mysqli_query($conn, $equipmentIP_LinkQueryString);                                        
                    if (mysqli_num_rows($result) > 0) {                                            
                        while($row = mysqli_fetch_assoc($result)){                            
                            $typeAndID_Array = getTheTypeAndID($row);
                            $equipmentAndIPArray = executeNestedEquipmentIP_DatabaseQuery($typeAndID_Array, $conn);
                            $arrayOfEquipmentAndIPArrays[] = $equipmentAndIPArray;
                        }
                    }
                    return $arrayOfEquipmentAndIPArrays;
                }

                function createTheUserAndEquipmentQueryString(){
                    $userAndEquipmentLinkQueryString = "SELECT * FROM `links` 
                        WHERE (first_type = 'user' AND second_type = 'equipment')
                        OR (first_type = 'equipment' AND second_type = 'user')
                        ORDER BY `date` DESC, `time` DESC";
                    return $userAndEquipmentLinkQueryString;
                }

                function createTheEquipmentIP_LinkQueryString(){
                    $equipmentIP_LinkQueryString = "SELECT * FROM `links` 
                        WHERE (first_type = 'ip' AND second_type = 'equipment')
                        OR (first_type = 'equipment' AND second_type = 'ip')
                        ORDER BY `date` DESC, `time` DESC";
                    return $equipmentIP_LinkQueryString;
                }
                function findIntersectionOfArrays($arrayOfUserAndEquipmentArrays, $arrayOfEquipmentAndIPArrays){
                    //finding the ones where computer matches
                    for($i = 0; $i < count($arrayOfUserAndEquipmentArrays); $i++) {
                        for($n = 0; $n < count($arrayOfEquipmentAndIPArrays); $n++) {
                            if($arrayOfUserAndEquipmentArrays[$i]['name'] == $arrayOfEquipmentAndIPArrays[$n]['name']){
                                echo    "<h1>WE FOUND A MATCH! at $i and $n</h1>";
                            }
                        }
                    }
                    
                }
                function executeDatabaseQuery($conn){
                    $arrayOfUserAndEquipmentArrays = [];
                    $arrayOfEquipmentAndIPArrays = [];
                    $userAndEquipmentLinkQueryString = createTheUserAndEquipmentQueryString();
                    $arrayOfUserAndEquipmentArrays = doTheUserAndEquipmentQuery($conn, $userAndEquipmentLinkQueryString, $arrayOfUserAndEquipmentArrays);
                    $equipmentIP_LinkQueryString = createTheEquipmentIP_LinkQueryString();
                    $arrayOfEquipmentAndIPArrays = doTheEquipmentAndIP_Query($conn, $equipmentIP_LinkQueryString, $arrayOfEquipmentAndIPArrays);                    
                    findIntersectionOfArrays($arrayOfUserAndEquipmentArrays, $arrayOfEquipmentAndIPArrays);                    
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