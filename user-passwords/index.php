<!-- Made by Christopher Barber July 2024 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Westbrick IT Inventory - User - Passwords</title>
    <link rel="stylesheet" href="../style/style.css">
    <script src="../script/sub-menu-script.js" defer></script>    
    <link rel="icon" href="../favicon.ico" type="image/x-icon">
</head>
<body>
    <a href="../"><img class="main-title" src="../images/westbrick-it-inventory.svg" alt="Westbrick IT Inventory"></a>
    <h1 class="sub-page-title">User - Passwords</h1>
    <div class="table-wrapper">
        <table class="sub-menu-table">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>First Name</th>
                    <th>Last Name</th>                    
                    <th>Password</th>
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
                    $equipmentArray = ['password' => $password];
                    return $equipmentArray;
                }

                function executeNestedDatabaseQuery($typeAndID_Array, $conn) {
                    if($typeAndID_Array['firstType'] == 'user') {
                        $userDataArray = getTheUser($typeAndID_Array['firstID'], $conn);
                    } else {
                        $userDataArray = getTheUser($typeAndID_Array['secondID'], $conn);
                    }
                    if($typeAndID_Array['secondType'] == 'password') {
                        $passwordArray = getThePassword($typeAndID_Array['secondID'], $conn);
                    } else {
                        $passwordArray = getThePassword($typeAndID_Array['firstID'], $conn);
                    }
                    $userAndPasswordArray = array_merge($userDataArray, $passwordArray);
                    return $userAndPasswordArray;
                }

                function displayTableRow($userAndPasswordArray) {
                    $userName = $userAndPasswordArray['userName'];
                    $firstName = $userAndPasswordArray['firstName'];
                    $lastName = $userAndPasswordArray['lastName'];
                    $password = $userAndPasswordArray['password'];
                    echo    "       <tr>";
                    echo    "           <td>$userName</td>";
                    echo    "           <td>$firstName</td>";
                    echo    "           <td>$lastName</td>";
                    echo    "           <td>$password</td>";
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

                function doTheQuery($conn, $query) {
                    $result = mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) > 0) {                                            
                        while($row = mysqli_fetch_assoc($result)){                            
                            $typeAndID_Array = getTheTypeAndID($row);
                            $userAndPasswordArray = executeNestedDatabaseQuery($typeAndID_Array, $conn);
                            displayTableRow($userAndPasswordArray);
                        }
                    }
                }
                function executeDatabaseQuery($conn){
                    $query = "SELECT * FROM `links` 
                        WHERE (first_type = 'user' AND second_type = 'password')
                        OR (first_type = 'password' AND second_type = 'user')
                        ORDER BY `date` DESC, `time` DESC";                    
                    doTheQuery($conn, $query);
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