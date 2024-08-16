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
        <div class="input-group">
            <div class="top-stuff">                
                <div>
                    <label for="type1">First Type:</label>
                    <select class="dropdown type1" id="type1" name="type1" required>
                        <option value="">Choose an option...</option>
                        <option value="user">User</option>
                        <option value="equipment">Equipment</option>
                        <option value="ip">IP Number</option>
                        <option value="server">Server</option>
                        <option value="location">Location</option>
                        <option value="password">Password</option>
                        <option value="update">Update</option>
                        <option value="other">Other</option>
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

            $query = "SELECT * FROM `links` ORDER BY `first_id` DESC, `second_id` DESC";
            $result = mysqli_query($conn, $query);

            // echo $result;

            if (mysqli_num_rows($result) > 0) {  
                $i = 0;
                //loop through the number of rows               
                while($row = mysqli_fetch_assoc($result)) {
                    $type1[$i] = $row['first_type'];
                    $id2[$i] = $row['first_id'];
                    $i++;
                    // $id1 .= $row['first_id'];
                    // $type2 .= $row['second_type'];
                    // $id2 .= $row['second_id']; 
                    // $linkRemark .= $row['link_remark'];
                    // $id .= $row['id'];
                }
            }
                echo "  <div>";
                echo "      <label for='select1'>First Selection:</label>";
                echo "      <select class='dropdown select1' id='select1' name='select1' required>";
            for($i = 0; $i < count($type1); $i++) {                             
                echo "          <option value'$type1[$i] $id2[$i]'>Type: $type1[$i] ID: $id2[$i]</option>";                
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
                    <label for="type2">Second Type:</label>
                    <select class="dropdown second-type" id="type2" name="type2" required>
                        <option value="">Choose an option...</option>
                        <option value="user2">User</option>
                        <option value="equipment2">Equipment</option>
                        <option value="ip2">IP Number</option>
                        <option value="server2">Server</option>
                        <option value="location2">Location</option>
                        <option value="password2">Password</option>
                        <option value="update2">Update</option>
                        <option value="other2">Other</option>
                    </select>                              
                </div>
                <div>
                    <label for="second-select">Second Selection:</label>
                    <select class="dropdown second-select" id="second-select" name="second-select" required>                        
                    </select>                              
                </div>
            </div>
            <div class="bottom-stuff">
                <div>
                    <label for="remark">Remark:</label>
                    <input class="remark" type="text" id="remark" name="remark"></input>
                </div>
            </div>          
        </div>      
        <input class="submit-button" type="submit" value="Post Item">
    </form>    
    <button class="button go-back-button" type="button">Go back</button>
</body>
</html>