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
                echo    "           <select class='dropdown select1 user-select1-dropdown second-type-dropdown-selector' id='select1-user' name='select1-user' required>";
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
                echo    "           <select class='dropdown type1 second-type-dropdown-selector' id='second-type-dropdown-selector' name='second-type-dropdown-selector' required>";
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
                echo    "           <label for='select1-user'>User Second Selection:</label>";
                echo    "           <select class='dropdown select1 user-select1-dropdown second-type-dropdown-selector' id='select1-user' name='select1-user' required>";
                for($i = 0; $i < mysqli_num_rows($result); $i++) {
                    echo"               <option class='user-$id' value'$firstName[$i] $lastName[$i] $id[$i]'>$firstName[$i] $lastName[$i]</option>";
                }
                echo    "           </select>";
                echo    "       </div>";
                echo    "   </div>";                
            }
            //MAIN

            function mainFunction() {
                $conn = connectToDatabase();            
                createFirstTypeSelectionDropdown();
                // I'm going to load all of the data from the sql server and then display it only when it's selected           
                createUserFirstSelectionDropdown($conn);
                createSecondTypeSelectionDropdown();            
                createUserSecondSelectionDropdown($conn);
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
        <input class="submit-button" type="submit" value="Link Items">
    </form>    
    <button class="button go-back-button" type="button">Go back</button>
</body>
</html>