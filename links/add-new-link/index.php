<!-- Made by Christopher Barber July 2024 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Westbrick IT Inventory - Add New Link</title>
    <link rel="stylesheet" href="../../style/style.css">
    <script src="../../script/sub-menu-script.js" defer></script>
    <script src="../../script/links-script.js" defer></script>
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">
</head>
<body>
    <a href="../"><img class="main-title" src="../../images/westbrick-it-inventory.svg" alt="Westbrick IT Inventory"></a>
    <h1 class="sub-page-title">Add New Link</h1>
    <form class="submission-form" method="post" action="add-new-link.php" enctype="multipart/form-data"> 
        <p class="link-opening-request">Please select the two items to be linked:</p>
                        
                       
        <?php

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

            function makeUserDatabaseQuery($conn) {
                $query = "SELECT * FROM `users` ORDER BY `first_name` DESC, `last_name` DESC";
                $result = mysqli_query($conn, $query);
                return $result;
            }
            function makeEquipmentDatabaseQuery($conn){
                $query = "SELECT * FROM `equipment` ORDER BY `date` DESC, `model_name` DESC";
                $result = mysqli_query($conn, $query);
                return $result;
            }

            function makeIP_DatabaseQuery($conn) {
                $query = "SELECT * FROM `ip_and_ports` ORDER BY `ip` DESC, `port` DESC";
                $result = mysqli_query($conn, $query);
                return $result;
            }

            function makeServerDatabaseQuery($conn) {
                $query = "SELECT * FROM `servers` ORDER BY `server_name` DESC";
                $result = mysqli_query($conn, $query);
                return $result;
            }

            function makeLocationsDatabaseQuery($conn) {
                $query = "SELECT * FROM `locations` ORDER BY `location_name` DESC";
                $result = mysqli_query($conn, $query);
                return $result;
            }

            function makePasswordsDatabaseQuery($conn) {
                $query = "SELECT * FROM `passwords` ORDER BY `password` DESC";
                $result = mysqli_query($conn, $query);
                return $result;
            }
            function createFirstTypeSelectionDropdown(){
                echo    "<div class='input-group'>";
                echo    "   <div class='top-stuff'>";
                echo    "       <div>";
                echo    "           <label for='first-type-dropdown-selector'>First Type:</label>";
                echo    "           <select class='dropdown type1 first-type-dropdown-selector' id='first-type-dropdown-selector' name='first-type-dropdown-selector' required>";
                echo    "               <option value=''>Choose an option...</option>";
                echo    "               <option value='user'>User</option>";
                echo    "               <option value='equipment'>Equipment</option>";
                echo    "               <option value='ip-and-port'>IP Number</option>";
                echo    "               <option value='server'>Server</option>";
                echo    "               <option value='location'>Location</option>";
                echo    "               <option value='password'>Password</option>";
                echo    "           </select>";
                echo    "       </div>";
            }

            function createUserFirstSelectionDropdown($conn) {

                $result = makeUserDatabaseQuery($conn);
                if (mysqli_num_rows($result) > 0) {  
                    $i = 0;
                    //loop through the number of rows               
                    while($row = mysqli_fetch_assoc($result)) {
                        $firstName[$i] = $row['first_name'];
                        $lastName[$i] = $row['last_name'];
                        $id[$i] = $row['id'];
                        $i++;                    
                    }
                }
                echo    "       <div class='links-user-first-selection-dropdown links-selection-dropdown'>";
                echo    "           <label for='select1-user'>User First Selection:</label>";
                echo    "           <select class='dropdown select1 user-select1-dropdown' id='select1-user' name='select1-user' required>";
                for($i = 0; $i < mysqli_num_rows($result); $i++) {
                    echo "              <option class='user-$id' value'$firstName[$i] $lastName[$i] $id[$i]'>$firstName[$i] $lastName[$i]</option>";
                }
                echo    "           </select>";
                echo    "       </div>";

            }

            function createSecondTypeSelectionDropdown(){
                echo    "   </div>";
                echo    "   <div class='middle-stuff'>";
                echo    "       <div class='second-type-dropdown-div'>";
                echo    "           <label for='second-type-dropdown-selector'>Second Type:</label>";
                echo    "           <select class='dropdown type1 second-type-dropdown-selector' id='second-type-dropdown-selector' name='second-type-dropdown-selector'>";
                echo    "               <option value=''>Choose an option...</option>";
                echo    "               <option value='user'>User</option>";
                echo    "               <option value='equipment'>Equipment</option>";
                echo    "               <option value='ip-and-port'>IP Number</option>";
                echo    "               <option value='server'>Server</option>";
                echo    "               <option value='location'>Location</option>";
                echo    "               <option value='password'>Password</option>";            
                echo    "           </select>";
                echo    "       </div>";
            }

            function createUserSecondSelectionDropdown($conn) {                                
                
                $result = makeUserDatabaseQuery($conn);
                if (mysqli_num_rows($result) > 0) {  
                    $i = 0;
                    //loop through the number of rows               
                    while($row = mysqli_fetch_assoc($result)) {
                        $firstName[$i] = $row['first_name'];
                        $lastName[$i] = $row['last_name'];
                        $id[$i] = $row['id'];
                        $i++;                    
                    }
                }
                echo    "       <div class='links-user-second-selection-dropdown links-selection-dropdown'>";
                echo    "           <label for='select2-user'>User Second Selection:</label>";
                echo    "           <select class='dropdown select2 user-select2-dropdown' id='select2-user' name='select2-user' required>";
                for($i = 0; $i < mysqli_num_rows($result); $i++) {
                    echo"               <option class='user-$id' value'$firstName[$i] $lastName[$i] $id[$i]'>$firstName[$i] $lastName[$i]</option>";
                }
                echo    "           </select>";
                echo    "       </div>";                          
            }

            function createEquipmentFirstSelectionDropdown($conn){
                $result = makeEquipmentDatabaseQuery($conn);
                if (mysqli_num_rows($result) > 0) {  
                    $i = 0;
                    //loop through the number of rows               
                    while($row = mysqli_fetch_assoc($result)) {
                        $modelName[$i] = $row['model_name'];
                        $name[$i] = $row['name'];
                        $id[$i] = $row['id'];
                        $i++;                    
                    }
                }
                echo    "       <div class='links-equipment-first-selection-dropdown links-selection-dropdown'>";
                echo    "           <label for='select1-equipment'>Equipment First Selection:</label>";
                echo    "           <select class='dropdown select1 equipment-select1-dropdown' id='select1-equipment' name='select1-equipment' required>";
                for($i = 0; $i < mysqli_num_rows($result); $i++) {
                    echo "              <option class='user-$id' value'$modelName[$i] $name[$i] $id[$i]'>$modelName[$i] $name[$i]</option>";
                }
                echo    "           </select>";
                echo    "       </div>";
            }

            function createEquipmentSecondSelectionDropdown($conn) {
                $result = makeEquipmentDatabaseQuery($conn);
                if (mysqli_num_rows($result) > 0) {  
                    $i = 0;
                    //loop through the number of rows               
                    while($row = mysqli_fetch_assoc($result)) {
                        $modelName[$i] = $row['model_name'];
                        $name[$i] = $row['name'];
                        $id[$i] = $row['id'];
                        $i++;                    
                    }
                }
                echo    "       <div class='links-equipment-second-selection-dropdown links-selection-dropdown'>";
                echo    "           <label for='select2-equipment'>Equipment First Selection:</label>";
                echo    "           <select class='dropdown select2 equipment-select2-dropdown' id='select2-equipment' name='select2-equipment'>";
                for($i = 0; $i < mysqli_num_rows($result); $i++) {
                    echo "              <option class='user-$id' value'$modelName[$i] $name[$i] $id[$i]'>$modelName[$i] $name[$i]</option>";
                }
                echo    "           </select>";
                echo    "       </div>";                
            }           

            function createIP_FirstSelectionDropdown($conn) {
                $result = makeIP_DatabaseQuery($conn);
                if (mysqli_num_rows($result) > 0) {  
                    $i = 0;
                    //loop through the number of rows               
                    while($row = mysqli_fetch_assoc($result)) {
                        $ip[$i] = $row['ip'];
                        $port[$i] = $row['port'];
                        $id[$i] = $row['id'];
                        $i++;                    
                    }
                }
                echo    "       <div class='links-ip-first-selection-dropdown links-selection-dropdown'>";
                echo    "           <label for='select1-ip'>Equipment First Selection:</label>";
                echo    "           <select class='dropdown select1 ip-select1-dropdown' id='select1-ip' name='select1-ip' required>";
                for($i = 0; $i < mysqli_num_rows($result); $i++) {
                    echo "              <option class='user-$id' value'$ip[$i] $port[$i] $id[$i]'>$ip[$i] $port[$i]</option>";
                }
                echo    "           </select>";
                echo    "       </div>";
            }

            function createIP_SecondSelectionDropdown($conn) {
                $result = makeIP_DatabaseQuery($conn);
                if (mysqli_num_rows($result) > 0) {  
                    $i = 0;
                    //loop through the number of rows               
                    while($row = mysqli_fetch_assoc($result)) {
                        $ip[$i] = $row['ip'];
                        $port[$i] = $row['port'];
                        $id[$i] = $row['id'];
                        $i++;                    
                    }
                }
                echo    "       <div class='links-ip-second-selection-dropdown links-selection-dropdown'>";
                echo    "           <label for='select2-ip'>Equipment Second Selection:</label>";
                echo    "           <select class='dropdown select2 ip-select2-dropdown' id='select2-ip' name='select2-ip' required>";
                for($i = 0; $i < mysqli_num_rows($result); $i++) {
                    echo "              <option class='user-$id' value'$ip[$i] $port[$i] $id[$i]'>$ip[$i] $port[$i]</option>";
                }
                echo    "           </select>";
                echo    "       </div>";
            }

            function createServerFirstSelectionDropdown($conn) {
                $result = makeServerDatabaseQuery($conn);
                if (mysqli_num_rows($result) > 0) {  
                    $i = 0;
                    //loop through the number of rows               
                    while($row = mysqli_fetch_assoc($result)) {
                        $serverName[$i] = $row['server_name'];                        
                        $id[$i] = $row['id'];
                        $i++;                    
                    }
                }
                echo    "       <div class='links-server-first-selection-dropdown links-selection-dropdown'>";
                echo    "           <label for='select1-server'>Server First Selection:</label>";                
                echo    "           <select class='dropdown select1 server-select1-dropdown' id='select1-server' name='select1-server' required>";
                for($i = 0; $i < mysqli_num_rows($result); $i++) {
                    echo "              <option class='user-$id' value'$serverName[$i] $serverName[$i]$id[$i]'>$serverName[$i]</option>";
                }
                echo    "           </select>";
                echo    "       </div>";
            }

            function createServerSecondSelectionDropdown($conn) {
                $result = makeServerDatabaseQuery($conn);
                if (mysqli_num_rows($result) > 0) {  
                    $i = 0;
                    //loop through the number of rows               
                    while($row = mysqli_fetch_assoc($result)) {
                        $serverName[$i] = $row['server_name'];                        
                        $id[$i] = $row['id'];
                        $i++;                    
                    }
                }
                echo    "       <div class='links-server-second-selection-dropdown links-selection-dropdown'>";
                echo    "           <label for='select2-server'>Server Second Selection:</label>";                
                echo    "           <select class='dropdown select2 server-select2-dropdown' id='select2-server' name='select2-server' required>";
                for($i = 0; $i < mysqli_num_rows($result); $i++) {
                    echo "              <option class='user-$id' value'$serverName[$i] $serverName[$i]$id[$i]'>$serverName[$i]</option>";
                }
                echo    "           </select>";
                echo    "       </div>";
            }

            function createLocationFirstSelectionDropdown($conn) {
                $result = makeLocationsDatabaseQuery($conn);
                if (mysqli_num_rows($result) > 0) {  
                    $i = 0;
                    //loop through the number of rows               
                    while($row = mysqli_fetch_assoc($result)) {
                        $locationName[$i] = $row['location_name'];                        
                        $id[$i] = $row['id'];
                        $i++;                    
                    }
                }
                echo    "       <div class='links-location-first-selection-dropdown links-selection-dropdown'>";
                echo    "           <label for='select1-server'>Location First Selection:</label>";                
                echo    "           <select class='dropdown select1 location-select1-dropdown' id='select1-location' name='select1-server' required>";
                for($i = 0; $i < mysqli_num_rows($result); $i++) {
                    echo "              <option class='user-$id' value'$locationName[$i] $locationName[$i]$id[$i]'>$locationName[$i]</option>";
                }
                echo    "           </select>";
                echo    "       </div>";
            }

            function createLocationSecondSelectionDropdown($conn) {
                $result = makeLocationsDatabaseQuery($conn);
                if (mysqli_num_rows($result) > 0) {  
                    $i = 0;
                    //loop through the number of rows               
                    while($row = mysqli_fetch_assoc($result)) {
                        $locationName[$i] = $row['location_name'];                        
                        $id[$i] = $row['id'];
                        $i++;                    
                    }
                }
                echo    "       <div class='links-location-second-selection-dropdown links-selection-dropdown'>";
                echo    "           <label for='select2-server'>Location Second Selection:</label>";                
                echo    "           <select class='dropdown select2 location-select2-dropdown' id='select2-location' name='select2-server' required>";
                for($i = 0; $i < mysqli_num_rows($result); $i++) {
                    echo "              <option class='user-$id' value'$locationName[$i] $locationName[$i]$id[$i]'>$locationName[$i]</option>";
                }
                echo    "           </select>";
                echo    "       </div>";
            }

            function createPasswordsFirstSelectionDropdown($conn) {
                $result = makePasswordsDatabaseQuery($conn);
                if (mysqli_num_rows($result) > 0) {  
                    $i = 0;
                    //loop through the number of rows               
                    while($row = mysqli_fetch_assoc($result)) {
                        $password[$i] = $row['password'];                        
                        $id[$i] = $row['id'];
                        $i++;                    
                    }
                }
                echo    "       <div class='links-passwords-first-selection-dropdown links-selection-dropdown'>";
                echo    "           <label for='select1-passwords'>Passwords First Selection:</label>";                
                echo    "           <select class='dropdown select1 passwords-select1-dropdown' id='select1-passwords' name='select1-passwords' required>";
                for($i = 0; $i < mysqli_num_rows($result); $i++) {
                    echo "              <option class='user-$id' value'$password[$i] $password[$i]$id[$i]'>$password[$i]</option>";
                }
                echo    "           </select>";
                echo    "       </div>";
            }

            function createPasswordsSecondSelectionDropdown($conn) {
                $result = makePasswordsDatabaseQuery($conn);
                if (mysqli_num_rows($result) > 0) {  
                    $i = 0;
                    //loop through the number of rows               
                    while($row = mysqli_fetch_assoc($result)) {
                        $password[$i] = $row['password'];                        
                        $id[$i] = $row['id'];
                        $i++;                    
                    }
                }
                echo    "       <div class='links-passwords-second-selection-dropdown links-selection-dropdown'>";
                echo    "           <label for='select2-passwords'>Passwords Second Selection:</label>";                
                echo    "           <select class='dropdown select2 passwords-select2-dropdown' id='select2-passwords' name='select2-passwords' required>";
                for($i = 0; $i < mysqli_num_rows($result); $i++) {
                    echo "              <option class='user-$id' value'$password[$i] $password[$i]$id[$i]'>$password[$i]</option>";
                }
                echo    "           </select>";
                echo    "       </div>";
            }

            function createFirstSelectionDropdowns($conn){
                createUserFirstSelectionDropdown($conn);
                createEquipmentFirstSelectionDropdown($conn);
                createIP_FirstSelectionDropdown($conn);
                createServerFirstSelectionDropdown($conn);
                createLocationFirstSelectionDropdown($conn);
                createPasswordsFirstSelectionDropdown($conn);
            }

            function createSecondSelectionDropdowns($conn) {
                createUserSecondSelectionDropdown($conn);
                createEquipmentSecondSelectionDropdown($conn);
                createIP_SecondSelectionDropdown($conn);
                createServerSecondSelectionDropdown($conn);
                createLocationSecondSelectionDropdown($conn);
                createPasswordsSecondSelectionDropdown($conn);
            }
            
            //MAIN
            function mainFunction() {
                $conn = connectToDatabase();
                // Top stuff
                createFirstTypeSelectionDropdown();
                createFirstSelectionDropdowns($conn);
                // End top stuff
                // Middle stuff
                createSecondTypeSelectionDropdown();
                // I'm going to load all of the data from the sql server and then display it only when it's selected with javascript
                createSecondSelectionDropdowns($conn);
                echo "</div>";
                // End Middle Stuff
                $conn->close();
            }           
            
            mainFunction();
            
        ?>                
            
            <div class="bottom-stuff">
                <div>
                    <label for="remark">Remark:</label>
                    <input class="remark" type="text" id="remark" name="remark"></input>
                </div>
            </div>          
        </div>      
        <!-- <input class="submit-button" type="submit" value="Link Items"> -->
        <input class="submit-button" value="Link Items">
    </form>    
    <button class="button go-back-button" type="button">Go back</button>
</body>
</html>