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

        function getType($string) {
            $array = explode(" ", $string);
            $type = $array[0];
            return $type;
        }
        function getID($string) {
            $array = explode(" ", $string);
            $iD = $array[1];
            return $iD;
        }

        function getTypeID_AndRemark() {
            $userFirstSelect = $_POST['user-first-select-payload'];
            $userSecondSelect = $_POST['user-second-select-payload'];

            $userFirstSelectType = getType($userFirstSelect);
            $userSecondSelectType = getType($userSecondSelect);
            $userFirstSelectID = getID($userFirstSelect);
            $userSecondSelectID = getID($userSecondSelect);

            $linkRemark = $_POST['remark'];

            echo    "<h1>User First Select: $userFirstSelect</h1>";
            echo    "<h1>User Second Select: $userSecondSelect</h1>";
            
            $valuesArray[0] = $userFirstSelectType;
            $valuesArray[1] = $userFirstSelectID;
            $valuesArray[2] = $userSecondSelectType;
            $valuesArray[3] = $userSecondSelectID;
            $valuesArray[4] = $linkRemark;

            return $valuesArray;
        }
        
        function getDateAndTime() {
            $date = date('Y-m-d');        
            date_default_timezone_set('America/Denver'); 
            $time = date('H:i:s', time());  
            $valuesArray[0] = $date;
            $valuesArray[1] = $time;
            return $valuesArray;
        }
        
        function executeSQL_Query($valuesArray, $conn){
            echo "Values Array: $valuesArray";

            $sql = "INSERT INTO links (first_type, second_type, date, time) VALUES ('$valuesArray[0]', '$valuesArray[1]', '$valuesArray[2]', '$valuesArray[3]')";
        
            if ($conn->query($sql) === TRUE) {            
                echo "<div class='westbrick-success-svg-container'>";
                echo    "<img class='westbrick-success-svg' src='../../images/link-submitted-successfully.svg' alt='WESTBRICK SUCCESS SVG'>";
                echo    "<button class='home-button' type='button' onclick='window.location.href=`../`;'>Home</button>";
                echo "</div>";            
            } else {
                echo "<div class='westbrick-success-svg-container'>";
                echo    "Error: " . $sql . "<br>" . $conn->error;
                echo    "<button class='home-button' type='button' onclick='window.location.href=`../`;'>Home</button>";
                echo "</div>";
            }
        }      
        
        function mainFunction(){
            $conn = connectToDatabase();
            $valuesArray = getTypeID_AndRemark();
            $valuesArray = $valuesArray + getDateAndTime();
            $valuesArray = str($valuesArray);
            echo "Values Array: $valuesArray";
            //executeSQL_Query($valuesArray, $conn);
            $conn->close();
        }
        mainFunction();
    ?>
</body>