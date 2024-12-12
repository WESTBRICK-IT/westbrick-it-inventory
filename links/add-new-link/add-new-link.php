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
        function convertApostrophe($string) { 
            $newString = str_replace("'", "`", $string); 
            return $newString; 
        }
        function getSelectedData() {
            $userFirstSelect = getUserFirstSelect();
            $userSecondSelect = getUserSecondSelect();
            $userFirstSelectType = getTheType($userFirstSelect);            
            $userSecondSelectType = getTheType($userSecondSelect);            
            $userFirstSelectID = getID($userFirstSelect);            
            $userSecondSelectID = getID($userSecondSelect);            
            $linkRemark = $_POST['remark'];
            $linkRemark = convertApostrophe($linkRemark);
            $dateAndTimeArray = getDateAndTime();
            $userSelectedArray = ['userFirstSelect' => $userFirstSelect, 'userSecondSelect' => $userSecondSelect, 'userFirstSelectType' => $userFirstSelectType, 'userSecondSelectType' => $userSecondSelectType, 'userFirstSelectID' => $userFirstSelectID, 'userSecondSelectID' => $userSecondSelectID, 'linkRemark' => $linkRemark, 'date' => $dateAndTimeArray['date'], 'time' => $dateAndTimeArray['time']];            
            return $userSelectedArray;
        }
        function createSQL_QueryString() {
            $userSelectedArray = getSelectedData();
            $userFirstSelectType = $userSelectedArray['userFirstSelectType'];
            $userSecondSelectType = $userSelectedArray['userSecondSelectType'];
            $userFirstSelectID = $userSelectedArray['userFirstSelectID'];
            $userSecondSelectID = $userSelectedArray['userSecondSelectID'];
            $date = $userSelectedArray['date'];
            $time = $userSelectedArray['time'];
            $linkRemark = $userSelectedArray['linkRemark'];
            $sql = "INSERT INTO links (first_type, second_type, first_id, second_id, date, time, link_remark) VALUES ('$userFirstSelectType', '$userSecondSelectType', '$userFirstSelectID', '$userSecondSelectID', '$date', '$time', '$linkRemark')";
            return $sql;
        }
        function executeSQL_Query($sql, $conn) {
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
        }  
        function mainFunction() {
            $conn = connectToDatabase();
            $sql = createSQL_QueryString();
            executeSQL_Query($sql, $conn);
            $conn->close();
        }
        mainFunction();
    ?>
</body>