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
                    <th>Type 2</th>
                    <th>ID 2</th>     
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
                // Connect to the database
                $conn = mysqli_connect("localhost", "cbarber", "!!!Dr0w554p!!!", "IT_Inventory_DB");

                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                $query = "SELECT * FROM `links` ORDER BY `first_id` DESC, `second_id` DESC";
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
                        echo    "           <td>$type2</td>";
                        echo    "           <td>$id2</td>";
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