<!-- Made by Christopher Barber August 2024 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Westbrick IT Inventory - Links</title>
    <link rel="stylesheet" href="../style/style.css">
    <script src="../script/sub-menu-script.js" defer></script>
    <link rel="icon" href="../favicon.ico" type="image/x-icon">
</head>
<body>
    <a href="../"><img class="main-title" src="../images/westbrick-it-inventory.svg" alt="Westbrick IT Inventory"></a>
    <h1 class="sub-page-title">Links</h1>
    <button class="button" onclick="window.location.href='./add-new-link/'" type="button">Add New Link</button>
    <div class="table-wrapper">
        <table class="sub-menu-table">
            <thead>
                <tr>
                    <th>Type 1</th>
                    <th>ID 1</th>
                    <th>Link Item Name 1</th>
                    <th>Type 2</th>
                    <th>ID 2</th>  
                    <th>Link Item Name 2</th>
                    <th>Remark</th>     
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
                function getTheNameOfID1($type1, $id1, $conn) {
                    if($type1 == 'ip') {                        
                        $iP = getTheIP($id1, $conn);                        
                        $name = $iP;
                    }else if($type1 == 'user') {
                        $user = getTheUser($id1, $conn);
                        $name = $user;
                    }else if($type1 == 'equipment') {
                        $equipment = getTheEquipment($id1, $conn);
                        $name = $equipment;
                    }else if($type1 == 'server') {
                        $server = getTheServer($id1, $conn);
                        $name = $server;
                    }else if($type1 == 'location') {
                        $location = getTheLocation($id1, $conn);
                        $name = $location;
                    }else if($type1 == 'password') {
                        $password = getThePassword($id1, $conn);
                        $name = $password;
                    }
                    return $name;
                }

                function shiftDeCipher($string) {
                    $SHIFT_DISTANCE = -2;     
                    $newShiftedString = "";
                    $stringLength = strlen($string);
                    for($i = 0; $i < $stringLength; $i++) {
                        $singleChar = $string[$i];
                        $singleCharASCII = ord($singleChar);
                        $singlecharASCII_Shifted = $singleCharASCII + $SHIFT_DISTANCE;
                        $singlecharASCII_Shifted = chr($singlecharASCII_Shifted);
                        $newShiftedString .= $singlecharASCII_Shifted;
                    }
                    return $newShiftedString;
                }
    
                function decodePassword($password){
                    $decodedPassword = base64_decode($password);
                    $decodedPassword = shiftDeCipher($decodedPassword);
                    return $decodedPassword;
                }
                function getThePassword($id, $conn) {
                    $query = "SELECT * FROM `passwords` WHERE id = $id";
                    $result = mysqli_query($conn, $query);
                    if ($row = mysqli_fetch_assoc($result)) {                        
                        $password = $row['password'];                        
                    } else {
                        echo "No password found with ID: " . htmlspecialchars($id);
                    }
                    $password = decodePassword($password);                    
                    return $password;
                }

                function getTheLocation($id, $conn) {
                    $query = "SELECT * FROM `locations` WHERE id = $id";
                    $result = mysqli_query($conn, $query);
                    if ($row = mysqli_fetch_assoc($result)) {
                        $locationName = $row['location_name'];                                               
                    } else {
                        echo "No location found with ID: " . htmlspecialchars($id);
                    }                    
                    return $locationName;
                }

                function getTheServer($id, $conn) {
                    $query = "SELECT * FROM `servers` WHERE id = $id";
                    $result = mysqli_query($conn, $query);
                    if ($row = mysqli_fetch_assoc($result)) {
                        $serverName = $row['server_name'];                        
                    } else {
                        echo "No server found with ID: " . htmlspecialchars($id);
                    }                    
                    return $serverName;
                }

                function getTheEquipment($id, $conn){                    
                    $query = "SELECT * FROM `equipment` WHERE id = $id";
                    $result = mysqli_query($conn, $query);
                    if ($row = mysqli_fetch_assoc($result)) {                        
                        $name = $row['name'];
                    } else {
                        echo "No equipment found with ID: " . htmlspecialchars($id);
                    }                    
                    return $name;
                }

                function getTheUser($id, $conn){                    
                    $query = "SELECT * FROM `users` WHERE id = $id";
                    $result = mysqli_query($conn, $query);
                    if ($row = mysqli_fetch_assoc($result)) {
                        $userName = $row['username'];                        
                    } else {
                        echo "No user found with ID: " . htmlspecialchars($id);
                    }                    
                    return $userName;
                }

                function getTheIP($id, $conn) {
                    $query = "SELECT * FROM `ip_and_ports` WHERE id = $id";
                    $result = mysqli_query($conn, $query);
                    if ($row = mysqli_fetch_assoc($result)) {
                        $iP = $row['ip'];                                               
                    } else {
                        echo "No IP found with ID: " . htmlspecialchars($id);
                    }
                    return $iP;
                }
                function getTheNameOfID2($type2, $id2, $conn){
                    if($type2 == 'ip') {                        
                        $iP = getTheIP($id2, $conn);                        
                        $name = $iP;
                    }else if($type2 == 'user') {
                        $user = getTheUser($id2, $conn);
                        $name = $user;
                    }else if($type2 == 'equipment') {
                        $equipment = getTheEquipment($id2, $conn);
                        $name = $equipment;
                    }else if($type2 == 'server') {
                        $server = getTheServer($id2, $conn);
                        $name = $server;
                    }else if($type2 == 'location') {
                        $location = getTheLocation($id2, $conn);
                        $name = $location;
                    }else if($type2 == 'password') {
                        $password = getThePassword($id2, $conn);
                        $name = $password;
                    }
                    return $name;
                }

                // Connect to the database
                $conn = mysqli_connect("localhost", "cbarber", "!!!Dr0w554p!!!", "IT_Inventory_DB");

                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                $query = "SELECT * FROM `links` ORDER BY `date` DESC, `time` DESC";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {                                            
                    while($row = mysqli_fetch_assoc($result)) {

                        $type1 = $row['first_type'];
                        $id1 = $row['first_id'];
                        $type2 = $row['second_type'];
                        $id2 = $row['second_id']; 
                        $linkRemark = $row['link_remark'];
                        $id = $row['id'];
                        
                        echo    "       <tr>";
                        echo    "           <td>$type1</td>";
                        echo    "           <td>$id1</td>";
                        $name1 = getTheNameOfID1($type1, $id1, $conn);
                        echo    "           <td>$name1</td>";
                        echo    "           <td>$type2</td>";
                        echo    "           <td>$id2</td>";
                        $name2 = getTheNameOfID2($type2, $id2, $conn);
                        echo    "           <td>$name2</td>";
                        echo    "           <td>$linkRemark</td>";
                        echo    "           <td><img class='garbage-can garbage-can$id links-garbage-can links-garbage-can$id' src='../images/garbage-can.svg' alt='links Garbage Can $id'></td>";
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