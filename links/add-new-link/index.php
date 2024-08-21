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
        <div class="input-group">
            <div class="top-stuff">                
                <div>
                    <label for="first-type-dropdown-selector">First Type:</label>
                    <select class="dropdown type1 firstTypeDropdownSelector" id="first-type-dropdown-selector" name="first-type-dropdown-selector" required>
                        <option value="">Choose an option...</option>
                        <option value="user">User</option>
                        <option value="equipment">Equipment</option>
                        <option value="ip-and-port">IP Number</option>
                        <option value="server">Server</option>
                        <option value="location">Location</option>
                        <option value="password">Password</option>
                        <!-- <option value="update">Update</option>
                        <option value="other">Other</option> -->
                    </select>                              
                </div>
        <?php
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

            // CREATING THE USER LIST

            $query = "SELECT * FROM `users` ORDER BY `first_name` DESC, `last_name` DESC";
            $result = mysqli_query($conn, $query);
            // I'm going to load all of the data from the sql server and then display it only when it's selected
            // echo $result;

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
            echo "  <div class='links-user-first-selection-dropdown links-selection-dropdown'>";
            echo "      <label for='select1-user'>User First Selection:</label>";
            echo "      <select class='dropdown select1 user-select1-dropdown' id='select1-user' name='select1' required>";
            for($i = 0; $i < mysqli_num_rows($result); $i++) {                             
                echo "          <option class='user-$id' value'$firstName[$i] $lastName[$i] $id[$i]'>$firstName[$i] $lastName[$i]</option>";
            }
            echo "      </select>";
            echo "  </div>";


            // CREATING THE EQUIPMENT LIST

            $query = "SELECT * FROM `equipment` ORDER BY `model_name` DESC, `serial_number` DESC";
            $result = mysqli_query($conn, $query);
            // I'm going to load all of the data from the sql server and then display it only when it's selected
            // echo $result;

            if (mysqli_num_rows($result) > 0) {  
                $i = 0;
                //loop through the number of rows               
                while($row = mysqli_fetch_assoc($result)) {
                    $name[$i] = $row['name'];
                    $modelName[$i] = $row['model_name'];
                    $serialNumber[$i] = $row['serial_number'];
                    $id[$i] = $row['id'];
                    $i++;                    
                }
            }
            echo "  <div class='links-equipment-first-selection-dropdown links-first-selection-dropdown links-selection-dropdown'>";
            echo "      <label for='select1-equipment'>Equipment First Selection:</label>";
            echo "      <select class='dropdown select1 equipment-select1-dropdown' id='select1-equipment' name='select1' required>";
            for($i = 0; $i < mysqli_num_rows($result); $i++) {                             
                echo "          <option class='first-equipment-$id equipment-$id' value'$name[$i] $modelName[$i] $serialNumber[$i] $id[$i]'>$name[$i] $modelName[$i] $serialNumber[$i]</option>";
            }
            echo "      </select>";
            echo "  </div>";

            // CREATING THE IP LIST

            $query = "SELECT * FROM `ip_and_ports` ORDER BY `ip` DESC, `port` DESC";
            $result = mysqli_query($conn, $query);
            // I'm going to load all of the data from the sql server and then display it only when it's selected
            // echo $result;

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
            echo "  <div class='links-ip-first-selection-dropdown links-first-selection-dropdown links-selection-dropdown'>";
            echo "      <label for='select1-ip'>IP and Port First Selection:</label>";
            echo "      <select class='dropdown select1 ip-select1-dropdown' id='select1-ip' name='select1' required>";
            for($i = 0; $i < mysqli_num_rows($result); $i++) {                             
                echo "          <option class='first-ip-$id ip-$id' value'$ip[$i] $port[$i] $id[$i]'>$ip[$i]:$port[$i]</option>";
            }
            echo "      </select>";
            echo "  </div>";


            // Creating Server List            

            $query = "SELECT * FROM `servers` ORDER BY `server_name` DESC";
            $result = mysqli_query($conn, $query);
            // I'm going to load all of the data from the sql server and then display it only when it's selected
            // echo $result;

            if (mysqli_num_rows($result) > 0) {  
                $i = 0;
                //loop through the number of rows               
                while($row = mysqli_fetch_assoc($result)) {
                    $serverName[$i] = $row['server_name'];                                        
                    $id[$i] = $row['id'];
                    $i++;
                }                    
            }
            echo "  <div class='links-server-first-selection-dropdown links-first-selection-dropdown links-selection-dropdown'>";
            echo "      <label for='select1-server'>Server First Selection:</label>";
            echo "      <select class='dropdown select1 server-select1-dropdown' id='select1-server' name='select1' required>";
            for($i = 0; $i < mysqli_num_rows($result); $i++) {                             
                echo "          <option class='first-server-$id server-$id' value'$serverName[$i] $id[$i]'>$serverName[$i]</option>";
            }
            echo "      </select>";
            echo "  </div>";


            //Creating Location List

            $query = "SELECT * FROM `locations` ORDER BY `location_name` DESC, 'city_town' DESC";
            $result = mysqli_query($conn, $query);
            // I'm going to load all of the data from the sql server and then display it only when it's selected
            // echo $result;

            if (mysqli_num_rows($result) > 0) {  
                $i = 0;
                //loop through the number of rows               
                while($row = mysqli_fetch_assoc($result)) {
                    $locationName[$i] = $row['location_name'];   
                    $cityTown = $row['city_town'];
                    $id[$i] = $row['id'];
                    $i++;
                }                    
            }
            echo "  <div class='links-locations-first-selection-dropdown links-first-selection-dropdown links-selection-dropdown'>";
            echo "      <label for='select1-location'>Location First Selection:</label>";
            echo "      <select class='dropdown select1 location-select1-dropdown' id='select1-location' name='select1' required>";
            for($i = 0; $i < mysqli_num_rows($result); $i++) {                             
                echo "          <option class='first-location-$id location-$id' value'$locationName[$i] $cityTown[$i] $id[$i]'>$locationName[$i] $cityTown[$i]</option>";
            }
            echo "      </select>";
            echo "  </div>";


            //Creating password list

            function decryptShiftCipher($string) {
                $SHIFT_DISTANCE = 2;     
                $newShiftedString = "";
                $stringLength = strlen($string);
                for($i = 0; $i < $stringLength; $i++) {
                    $singleChar = $string[$i];
                    $singleCharASCII = ord($singleChar);
                    $singlecharASCII_Shifted = $singleCharASCII - $SHIFT_DISTANCE;
                    $singlecharASCII_Shifted = chr($singlecharASCII_Shifted);
                    $newShiftedString .= $singlecharASCII_Shifted;
                }
                return $newShiftedString;
            }

            function decryptPassword($encodedPassword) {
                $encodedPassword = base64_decode($encodedPassword);
                $decryptedPassword = decryptShiftCipher($encodedPassword);
                return $decryptedPassword;
            }

            $query = "SELECT * FROM `passwords` ORDER BY `password` DESC";
            $result = mysqli_query($conn, $query);
            // I'm going to load all of the data from the sql server and then display it only when it's selected
            // echo $result;

            if (mysqli_num_rows($result) > 0) {  
                $i = 0;
                //loop through the number of rows               
                while($row = mysqli_fetch_assoc($result)) {
                    $encodedPassword = $row['password'];
                    $decryptedPassword = decryptPassword($encodedPassword);
                    $passwords[$i] = $decryptedPassword;
                    $id[$i] = $row['id'];
                    $i++;
                }                    
            }
            echo "  <div class='links-passwords-first-selection-dropdown links-first-selection-dropdown links-selection-dropdown'>";
            echo "      <label for='select1-passwords'>Password First Selection:</label>";
            echo "      <select class='dropdown select1 passwords-select1-dropdown' id='select1-passwords' name='select1' required>";
            for($i = 0; $i < mysqli_num_rows($result); $i++) {                             
                echo "          <option class='first-password-$id password-$id' value'$passwords[$i] $id[$i]'>$passwords[$i]</option>";
            }
            echo "      </select>";
            echo "  </div>";

        
        ?>

        

                <!-- <div>
                    <label for="select1">First Selection:</label>
                    <select class="dropdown select1" id="select1" name="select1" required></select>
                </div> -->
                            
            </div>
            <div class="middle-stuff">
                <div>
                    <label for="secondTypeDropdownSelector">Second Type:</label>
                    <select class="dropdown second-type secondTypeDropdownSelector" id="secondTypeDropdownSelector" name="secondTypeDropdownSelector" required>
                        <option value="">Choose an option...</option>
                        <option value="user2">User</option>
                        <option value="equipment2">Equipment</option>
                        <option value="ip2">IP Number</option>
                        <option value="server2">Server</option>
                        <option value="location2">Location</option>
                        <option value="password2">Password</option>
                        <!-- <option value="update2">Update</option>
                        <option value="other2">Other</option> -->
                    </select>                              
                </div>

        <?php
            // CREATING THE SECOND USER LIST

            $query = "SELECT * FROM `users` ORDER BY `first_name` DESC, `last_name` DESC";
            $result = mysqli_query($conn, $query);
            // I'm going to load all of the data from the sql server and then display it only when it's selected
            // echo $result;

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
            echo "  <div class='links-user-second-selection-dropdown links-selection-dropdown'>";
            echo "      <label for='select2-user'>User Second Selection:</label>";
            echo "      <select class='dropdown select2 user-select2-dropdown' id='select2-user' name='select2' required>";
            for($i = 0; $i < mysqli_num_rows($result); $i++) {                             
                echo "          <option class='second-user-$id user-$id' value'$firstName[$i] $lastName[$i] $id[$i]'>$firstName[$i] $lastName[$i]</option>";
            }
            echo "      </select>";
            echo "  </div>";           


            // CREATING THE SECOND EQUIPMENT LIST

            $query = "SELECT * FROM `equipment` ORDER BY `model_name` DESC, `serial_number` DESC";
            $result = mysqli_query($conn, $query);
            // I'm going to load all of the data from the sql server and then display it only when it's selected
            // echo $result;

            if (mysqli_num_rows($result) > 0) {  
                $i = 0;
                //loop through the number of rows               
                while($row = mysqli_fetch_assoc($result)) {
                    $name[$i] = $row['name'];
                    $modelName[$i] = $row['model_name'];
                    $serialNumber[$i] = $row['serial_number'];
                    $id[$i] = $row['id'];
                    $i++;                    
                }
            }
            echo "  <div class='links-equipment-second-selection-dropdown links-second-selection-dropdown links-selection-dropdown'>";
            echo "      <label for='select2-equipment'>Equipment Second Selection:</label>";
            echo "      <select class='dropdown select2 equipment-select2-dropdown' id='select2-equipment' name='select2' required>";
            for($i = 0; $i < mysqli_num_rows($result); $i++) {                             
                echo "          <option class='second-equipment-$id equipment-$id' value'$name[$i] $modelName[$i] $serialNumber[$i] $id[$i]'>$name[$i] $modelName[$i] $serialNumber[$i]</option>";
            }
            echo "      </select>";
            echo "  </div>";

            // Creating the second IP List select dropdown thingy

            $query = "SELECT * FROM `ip_and_ports` ORDER BY `ip` DESC, `port` DESC";
            $result = mysqli_query($conn, $query);
            // I'm going to load all of the data from the sql server and then display it only when it's selected
            // echo $result;

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
            echo "  <div class='links-ip-second-selection-dropdown links-second-selection-dropdown links-selection-dropdown'>";
            echo "      <label for='select2-ip'>IP and Port Second Selection:</label>";
            echo "      <select class='dropdown select2 ip-select2-dropdown' id='select2-ip' name='select2' required>";
            for($i = 0; $i < mysqli_num_rows($result); $i++) {                             
                echo "          <option class='second-ip-$id ip-$id' value'$ip[$i] $port[$i] $id[$i]'>$ip[$i]:$port[$i]</option>";
            }
            echo "      </select>";
            echo "  </div>";

            // Creating Server Second List            

            $query = "SELECT * FROM `servers` ORDER BY `server_name` DESC";
            $result = mysqli_query($conn, $query);
            // I'm going to load all of the data from the sql server and then display it only when it's selected
            // echo $result;

            if (mysqli_num_rows($result) > 0) {  
                $i = 0;
                //loop through the number of rows               
                while($row = mysqli_fetch_assoc($result)) {
                    $serverName[$i] = $row['server_name'];                                        
                    $id[$i] = $row['id'];
                    $i++;
                }                    
            }
            echo "  <div class='links-server-second-selection-dropdown links-second-selection-dropdown links-selection-dropdown'>";
            echo "      <label for='select2-server'>Server Second Selection:</label>";
            echo "      <select class='dropdown select2 server-select2-dropdown' id='select2-server' name='select2' required>";
            for($i = 0; $i < mysqli_num_rows($result); $i++) {                             
                echo "          <option class='second-server-$id server-$id' value'$serverName[$i] $id[$i]'>$serverName[$i]</option>";
            }
            echo "      </select>";
            echo "  </div>";


            //Creating Location Second List

            $query = "SELECT * FROM `locations` ORDER BY `location_name` DESC, 'city_town' DESC";
            $result = mysqli_query($conn, $query);
            // I'm going to load all of the data from the sql server and then display it only when it's selected
            // echo $result;

            if (mysqli_num_rows($result) > 0) {  
                $i = 0;
                //loop through the number of rows               
                while($row = mysqli_fetch_assoc($result)) {
                    $locationName[$i] = $row['location_name'];   
                    $cityTown = $row['city_town'];
                    $id[$i] = $row['id'];
                    $i++;
                }                    
            }
            echo "  <div class='links-locations-second-selection-dropdown links-second-selection-dropdown links-selection-dropdown'>";
            echo "      <label for='select2-location'>Location Second Selection:</label>";
            echo "      <select class='dropdown select2 location-select2-dropdown' id='select2-location' name='select2' required>";
            for($i = 0; $i < mysqli_num_rows($result); $i++) {                             
                echo "          <option class='second-location-$id location-$id' value'$locationName[$i] $cityTown[$i] $id[$i]'>$locationName[$i] $cityTown[$i]</option>";
            }
            echo "      </select>";
            echo "  </div>";


            // Creating passwords second list


            $query = "SELECT * FROM `passwords` ORDER BY `password` DESC";
            $result = mysqli_query($conn, $query);
            // I'm going to load all of the data from the sql server and then display it only when it's selected
            // echo $result;

            if (mysqli_num_rows($result) > 0) {  
                $i = 0;
                //loop through the number of rows               
                while($row = mysqli_fetch_assoc($result)) {
                    $encodedPassword = $row['password'];
                    $decryptedPassword = decryptPassword($encodedPassword);
                    $passwords[$i] = $decryptedPassword;
                    $id[$i] = $row['id'];
                    $i++;
                }                    
            }
            echo "  <div class='links-passwords-second-selection-dropdown links-second-selection-dropdown links-selection-dropdown'>";
            echo "      <label for='select2-passwords'>Password First Selection:</label>";
            echo "      <select class='dropdown select2 passwords-select2-dropdown' id='select2-passwords' name='select2' required>";
            for($i = 0; $i < mysqli_num_rows($result); $i++) {                             
                echo "          <option class='second-password-$id password-$id' value'$passwords[$i] $id[$i]'>$passwords[$i]</option>";
            }
            echo "      </select>";
            echo "  </div>";
        ?>

                
            </div>
            <div class="bottom-stuff">
                <div>
                    <label for="remark">Remark:</label>
                    <input class="remark" type="text" id="remark" name="remark"></input>
                </div>
            </div>          
        </div>      
        <input class="submit-button" type="submit" value="Link Items">
    </form>    
    <button class="button go-back-button" type="button">Go back</button>
</body>
</html>