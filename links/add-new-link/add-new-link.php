<!-- Made by Christopher Barber July 2024 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Westbrick IT Inventory - Add New Link</title>
    <link rel="stylesheet" href="../../style/style.css">
    <script src="../../script/sub-menu-script.js" defer></script>
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">
</head>
<body>
    <?php
        $allowedIPs = array('206.174.198.58', '206.174.198.59', '50.99.132.206'); // Define the list of allowed IP addresses

        $remoteIP = $_SERVER['REMOTE_ADDR']; // Get the remote IP address of the client
        
        if (!in_array($remoteIP, $allowedIPs)) {
            // Unauthorized access - display an error message or redirect
            echo "Access denied. Your IP address is not allowed to submit this item.";
            exit();
        }
        
        // Process the form submission if the IP address is allowed
        // Your form processing code here...

        $servername = "localhost";
        $username = "cbarber";
        $password = "!!!Dr0w554p!!!";
        $dbname = "IT_Inventory_DB";
        
        $conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }    

        // function firstLinkSelectionIsUser() {
        //     echo "First Link Selection is User";
        //     $userFirstSelection = $_POST['select1-user'];
        //     echo "$userFirstSelection selected";
        // }        
        // function firstLinkSelectionIsEquipment() {
        //     echo "First Link Selection is Equipment";
        //     $equipmentFirstSelection = $_POST['select1-equipment'];
        //     echo "$equipmentFirstSelection selected";
        // }
        // function firstLinkSelectionIsIP() {

        // }

        $firstTypeDropdownSelection = $_POST['first-type-dropdown-selector'];        
        echo    "<h1>Hello World</h1>";
        echo "First Type Dropdown Selection: $firstTypeDropdownSelector";

        // if($firstTypeDropdownSelection == "user") {
        //     firstLinkSelectionIsUser();
        // }else if($firstTypeDropdownSelection == "equipment") {
        //     firstLinkSelectionIsEquipment();
        // }




        $linkRemark = $_POST['remark'];
        $date = date('Y-m-d');        
        date_default_timezone_set('America/Denver'); 
        $time = date('H:i:s', time());    
        
        // $sql = "INSERT INTO links (first_type, first_id, second_type, second_id,  date, time, link_remark) VALUES ('$type1', '$firstID', '$type2', '$secondID', '$date', '$time', '$linkRemark')"; 
        
        if ($conn->query($sql) === TRUE) {
            // echo "<h1>Article $title submitted successfully! Redirecting to articles page in 5 seconds.</h1>";
            echo "<div class='westbrick-success-svg-container'>";
            echo    "<img class='westbrick-success-svg' src='../../images/link-submitted-successfully.svg' alt='WESTBRICK SUCCESS SVG'>";
            echo    "<button class='home-button' type='button' onclick='window.location.href=`../`;'>Home</button>";
            echo "</div>";
            // echo "<br><h1>File name: $image" . "File tmp name: $image_tmp" . "</h1>";
            // Set the time delay in seconds
            // $timeDelay = 5; // 5 seconds
            // Wait for the specified amount of time before redirecting
            // header("refresh:".$timeDelay.";url=../articles/index.php");
        } else {
            echo "<div class='westbrick-success-svg-container'>";
            echo    "Error: " . $sql . "<br>" . $conn->error;
            echo    "<button class='home-button' type='button' onclick='window.location.href=`../`;'>Home</button>";
            echo "</div>";
        }
        $conn->close();
        
    ?>
</body>