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

        function connectToDatabase() {
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

            return $conn;
        }
        
        $conn = connectToDatabase();        
        function getUserFirstSelect() {
            $userFirstSelect = $_POST['user-first-select-payload'];
            return $userFirstSelect;
        }
        function getUserSecondSelect() {
            $userSecondSelect = $_POST['user-second-select-payload'];
            return $userSecondSelect;
        }

        function getTheType($string) {
            $array = explode(" ", $string);
            $type = $array[0];
            return $type;
        }
        function getID($string) {
            $array = explode(" ", $string);
            $iD = $array[1];
            return $iD;
        }

        function getDateAndTime() {
            $date = date('Y-m-d');        
            date_default_timezone_set('America/Denver'); 
            $time = date('H:i:s', time());
            $dateAndTimeArray = ['date' => $date, 'time' => $time];
            return $dateAndTimeArray;
        }

        function getSelectedData() {
            $userFirstSelect = getUserFirstSelect();
            $userSecondSelect = getUserSecondSelect();
            $userFirstSelectType = getTheType($userFirstSelect);
            echo "<h1>UFST: $userFirstSelectType</h1>";
            $userSecondSelectType = getTheType($userSecondSelect);
            echo "<h1>USST: $userSecondSelectType</h1>";
            $userFirstSelectID = getID($userFirstSelect);
            echo "<h1>UFSID: $userFirstSelectID</h1>";
            $userSecondSelectID = getID($userSecondSelect);
            echo "<h1>USSID: $userSecondSelectID</h1>";
            $linkRemark = $_POST['remark'];
            echo "<h1>Link Remark: $linkRemark</h1>";
            $dateAndTimeArray = getDateAndTime();

            $userSelectedArray = ['userFirstSelect' => $userFirstSelect, 'userSecondSelect' => $userSecondSelect, 'userFirstSelectType' => $userFirstSelectType, 'userSecondSelectType' => $userSecondSelectType, 'userFirstSelectID' => $userFirstSelectID, 'userSecondSelectID' => $userSecondSelectID, 'linkRemark' => $linkRemark, 'date' => $dateAndTimeArray['date'], 'time' => $dateAndTimeArray['time']];
            //$userSelectedArray = ['userFirstSelect' => $userFirstSelect, 'userSecondSelect' => $userSecondSelect];
            return $userSelectedArray;
        }        

        
        
        // $userFirstSelect = $userSelectedArray['userFirstSelect'];
        // $userSecondSelect = $userSelectedArray['userSecondSelect'];
        
        // echo    "<h1>User First Select: $userFirstSelect</h1>";
        // echo    "<h1>User Second Select: $userSecondSelect</h1>"; 
        function sqlQuery() {
            $userSelectedArray = getSelectedData();
            $sql = "INSERT INTO links (first_type, second_type, first_id, second_id, date, time, link_remark) VALUES ('$userFirstSelect', '$userSecondSelect', '$date', '$time')";


        }
            
        sqlQuery();
        
        
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
        
        function mainFunction() {

        }
        mainFunction();
    ?>
</body>