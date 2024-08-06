<!-- Made by Christopher Barber July 2024 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Westbrick IT Inventory - Equipment</title>
    <link rel="stylesheet" href="../style/style.css">
    <script src="../script/sub-menu-script.js" defer></script>
    <link rel="icon" href="../favicon.ico" type="image/x-icon">
</head>
<body>
    <a href="../"><img class="main-title" src="../images/westbrick-it-inventory.svg" alt="Westbrick IT Inventory"></a>
    <h1 class="sub-page-title">Equipment</h1>
    <button class="button" onclick="window.location.href='./add-new-equipment/'" type="button">Add New Equipment</button>
    <div class="table-wrapper">
        <table class="sub-menu-table">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Name</th>
                    <th>Model Name</th>
                    <th>Model Number</th>
                    <th>Serial Number</th>
                    <th>Purchase Date</th>                    
                    <th>Purchase Price</th>
                    <th>Warranty Start</th>
                    <th>Warranty End</th>                    
                    <th>Delete</th>
                </tr>
            </thead>
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

                $query = "SELECT * FROM `equipment` ORDER BY `type` DESC, `name` DESC";
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {                                            
                    while($row = mysqli_fetch_assoc($result)){
                    
                        $name = $row["name"];
                        $modelNumber = $row["model_number"];
                        $purchaseDate = $row["purchase_date"];
                        $purchasePrice = $row["purchase_price"];
                        $serialNumber = $row["serial_number"];
                        $type = $row["type"];
                        $warrantyEnd = $row["warranty_end"];
                        $warrantyStart = $row["warranty_start"];
                        $modelName = $row["model_name"];

                        echo    "   <tbody>";
                        echo    "       <tr>";
                        echo    "           <td>$type</td>";
                        echo    "           <td>$name</td>";
                        echo    "           <td>$modelName</td>";
                        echo    "           <td>$modelNumber</td>";
                        echo    "           <td>$serialNumber</td>";
                        echo    "           <td>$purchaseDate</td>";
                        echo    "           <td>$purchasePrice</td>";                        
                        echo    "           <td>$warrantyStart</td>";
                        echo    "           <td>$warrantyEnd</td>";
                        echo    "           <td>Delete</td>";
                        echo    "       </tr>";
                        echo    "   </tbody>";
                    }
                }
            ?>
        </table>
    </div>
    <button class="button go-back-button" type="button">Go back</button>
</body>
</html>