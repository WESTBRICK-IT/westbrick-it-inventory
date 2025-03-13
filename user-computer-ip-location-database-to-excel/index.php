<?php
    //include "../common-functions/common-functions.php";    

    function doTheDatabaseQuery($conn, $databaseQueryString){
        $result = mysqli_query($conn, $databaseQueryString);
        if (mysqli_num_rows($result) > 0) {                                 
            while($row = mysqli_fetch_assoc($result)){                
            }
        }
        //return $equipmentIP_ArrayOfArrays;
    }
    function createDatabaseQueryStringEquipmentTable() {
        $equipmentDatabaseQueryString = 'SELECT * FROM equipment';
        return $equipmentDatabaseQueryString;
    }
    function createDatabaseQueryStringIP_AndPortsTable() {
        $iP_AndPortsDatabaseQueryString = 'SELECT * FROM ip_and_ports';
        return $iP_AndPortsDatabaseQueryString;
    }
    function createDatabaseQueryStringLinksTable() {
        $linksDatabaseQueryString = 'SELECT * FROM links';
        return $linksDatabaseQueryString;
    }
    function createDatabaseQueryStringLocationsTable() {
        $locationsDatabaseQueryString = 'SELECT * FROM locations';
        return $locationsDatabaseQueryString;
    }
    function createDatabaseQueryStringPasswordsTable() {
        $passwordsDatabaseQueryString = 'SELECT * FROM passwords';
        return $passwordsDatabaseQueryString;
    }
    function createDatabaseQueryStringServersTable() {
        $serversDatabaseQueryString = 'SELECT * FROM servers';
        return $serversDatabaseQueryString;
    }
    function createDatabaseQueryStringUsersTable() {
        $usersDatabaseQueryString = 'SELECT * FROM users';
        return $usersDatabaseQueryString;
    }
    function executeEquipmentDatabaseQuery($conn, $databaseQueryStringsArray, $equipmentArrayOfArrays) {
        $equipmentDatabaseQueryString = $databaseQueryStringsArray['equipmentQueryString'];  
        $equipmentArray = [];        
        $result = mysqli_query($conn, $equipmentDatabaseQueryString);
            if (mysqli_num_rows($result) > 0) {                                 
                while($row = mysqli_fetch_assoc($result)){                    
                    $equipmentArray = ['iD' => $row["id"], 'name' => $row['name'], 'type' => $row["type"], 'modelNumber' => $row['model_number'], 'serialNumber' => $row['serial_number'], 'purchaseDate' => $row['purchase_date'], 'purchasePrice' => $row['purchase_price'], 'warrantyStart' => $row['warranty_start'], 'warrantyEnd' => $row['warranty_end'], 'modelName' => $row['model_name'], 'date' => $row['date'], 'time' => $row['time']];                    
                    array_push($equipmentArrayOfArrays, $equipmentArray);
                }
            }         
        return $equipmentArrayOfArrays;
    }   
    
    function outputEquipmentDatabaseToExcel($equipmentArrayOfArrays){
        $fileName = "it_inventory__equipment_data.xls";
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header("Content-Type: application/vnd.ms-excel");
        echo implode("\t", array_keys($equipmentArrayOfArrays[0])) . "\n";
        foreach ($equipmentArrayOfArrays as $row) {
            echo implode("\t", $row) . "\n";
        }
        exit;
    }

    function outputIP_AndPortsDatabaseToExcel($iP_AndPortsArrayOfArrays){
        $fileName = "it_inventory_ip_data.xls";
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header("Content-Type: application/vnd.ms-excel");
        echo implode("\t", array_keys($iP_AndPortsArrayOfArrays[0])) . "\n";
        foreach ($iP_AndPortsArrayOfArrays as $row) {
            echo implode("\t", $row) . "\n";
        }
        exit;
    }
    function outputLinksDatabaseToExcel($linksArrayOfArrays){
        $fileName = "it_inventory_links_data.xls";
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header("Content-Type: application/vnd.ms-excel");
        echo implode("\t", array_keys($linksArrayOfArrays[0])) . "\n";
        foreach ($linksArrayOfArrays as $row) {
            echo implode("\t", $row) . "\n";
        }
        exit;
    }

    function outputLocationsDatabaseToExcel($locationsArrayOfArrays){
        $fileName = "it_inventory_locations_data.xls";
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header("Content-Type: application/vnd.ms-excel");
        echo implode("\t", array_keys($locationsArrayOfArrays[0])) . "\n";
        foreach ($locationsArrayOfArrays as $row) {
            echo implode("\t", $row) . "\n";
        }
        exit;
    }

    function outputPasswordsDatabaseToExcel($passwordArrayOfArrays){
        $fileName = "it_inventory_password_data.xls";
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header("Content-Type: application/vnd.ms-excel");
        echo implode("\t", array_keys($passwordArrayOfArrays[0])) . "\n";
        foreach ($passwordArrayOfArrays as $row) {
            echo implode("\t", $row) . "\n";
        }
        exit;
    }

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

    function outputServerDatabaseToExcel($serverArrayOfArrays){
        $fileName = "it_inventory_server_data.xls";
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header("Content-Type: application/vnd.ms-excel");
        echo implode("\t", array_keys($serverArrayOfArrays[0])) . "\n";
        foreach ($serverArrayOfArrays as $row) {
            echo implode("\t", $row) . "\n";
        }
        exit;
    }
    function outputUsersDatabaseToExcel($usersArrayOfArrays){
        $fileName = "it_inventory_users_data.xls";
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header("Content-Type: application/vnd.ms-excel");
        echo implode("\t", array_keys($usersArrayOfArrays[0])) . "\n";
        foreach ($usersArrayOfArrays as $row) {
            echo implode("\t", $row) . "\n";
        }
        exit;
    }
    function getTheUser($id, $conn){                    
        $query = "SELECT * FROM `users` WHERE id = $id";
        $result = mysqli_query($conn, $query);
        if ($row = mysqli_fetch_assoc($result)) {
            $userName = $row['username'];
            $firstName = $row['first_name'];
            $lastName = $row['last_name'];
            $cellPhoneNum = $row['cell_phone_num'];
            $officePhoneNum = $row['office_phone_num'];
            $email = $row['email'];
            $positionTitle = $row['position_title'];
            $extensionNum = $row['extension_num'];
            $userName = $row['username'];
            $date = $row['date'];
            $time = $row['time'];
            $userRemark = $row['user_remark'];
        } else {
            echo "No user found with ID: " . htmlspecialchars($id);
        }
        $userDataArray = ['userName' => $userName, 'firstName' => $firstName, 'lastName' => $lastName, 'cellPhoneNum' => $cellPhoneNum, 'officePhoneNum' => $officePhoneNum, 'email' => $email, $positionTitle => 'positionTitle', 'extensionNum' => $extensionNum, 'username' => $userName, 'date' => $date, 'time' => $time, 'userRemark' => $userRemark];
        return $userDataArray;
    }
    function getTheEquipment($id, $conn) {
        $query = "SELECT * FROM `equipment` WHERE id = $id";
        $result = mysqli_query($conn, $query);
        if ($row = mysqli_fetch_assoc($result)) {                        
            $equipmentType = $row['type'];
            $modelName = $row['model_name'];
            $name = $row['name'];
            $warrantyEnd = $row['warranty_end'];
            $serialNumber = $row['serial_number'];                        
        } else {
            echo "No user found with ID: " . htmlspecialchars($id);
        }
        $equipmentArray = ['equipmentType' => $equipmentType, 'modelName' => $modelName, 'name' => $name, 'warrantyEnd' => $warrantyEnd, 'serialNumber' => $serialNumber, 'iD' => $id];
        return $equipmentArray;
    }
    function getTheIP($id, $conn) {
        $query = "SELECT * FROM `ip_and_ports` WHERE id = $id";
        $result = mysqli_query($conn, $query);
        if ($row = mysqli_fetch_assoc($result)) {
            $iP = $row['ip'];
            $port = $row['port'];                        
        } else {
            echo "No user found with ID: " . htmlspecialchars($id);
        }        
        $iP_Array = ['iP' => $iP, 'port' => $port];
        return $iP_Array;
    }
    function getTheLocation($id, $conn) {
        $query = "SELECT * FROM `locations` WHERE id = $id";
        $result = mysqli_query($conn, $query);
        if ($row = mysqli_fetch_assoc($result)) {
            $locationName = $row['location_name'];
            $cityTown = $row['city_town'];
            $roomNumber = $row['room_number'];                        
        } else {
            echo "No location found with ID: " . htmlspecialchars($id);
        }
        $locationArray = ['locationName' => $locationName, 'cityTown' => $cityTown, 'roomNumber' => $roomNumber];
        return $locationArray;
    }

    function getTheFirstLinkMatchArray($firstID, $firstType, $allArrayOfArraysOfArrays, $firstLinkMatchArray){
        if($firstType == "user") {            
            $usersArrayOfArrays = $allArrayOfArraysOfArrays['usersArrayOfArrays'];
            for($i = 0; $i < count($usersArrayOfArrays); $i++){                
                if($usersArrayOfArrays[$i]['iD'] == $firstID){                    
                    $firstLinkMatchArray = $usersArrayOfArrays[$i];                    
                }
            }
        }elseif($firstType == "ip") {
            $iP_AndPortArrayOfArrays = $allArrayOfArraysOfArrays['iP_AndPortsArrayOfArrays'];            
            for($i = 0; $i < count($iP_AndPortArrayOfArrays); $i++){                
                if($iP_AndPortArrayOfArrays[$i]['iD'] == $firstID){                    
                    $firstLinkMatchArray = $iP_AndPortArrayOfArrays[$i];                    
                }
            }
        }elseif($firstType == "location") {            
            $locationsArrayOfArrays = $allArrayOfArraysOfArrays['locationsArrayOfArrays'];            
            for($i = 0; $i < count($locationsArrayOfArrays); $i++){                
                if($locationsArrayOfArrays[$i]['iD'] == $firstID){                    
                    $firstLinkMatchArray = $locationsArrayOfArrays[$i];                    
                }
            }
        }elseif($firstType == "equipment") {
            $equipmentArrayOfArrays = $allArrayOfArraysOfArrays['equipmentArrayOfArrays'];            
            for($i = 0; $i < count($equipmentArrayOfArrays); $i++){                
                if($equipmentArrayOfArrays[$i]['iD'] == $firstID){                    
                    $firstLinkMatchArray = $equipmentArrayOfArrays[$i];                    
                }
            }            
        }elseif($firstType == "password") {
            $passwordArrayOfArrays = $allArrayOfArraysOfArrays['passwordArrayOfArrays'];            
            for($i = 0; $i < count($passwordArrayOfArrays); $i++){                
                if($passwordArrayOfArrays[$i]['iD'] == $firstID){                    
                    $firstLinkMatchArray = $passwordArrayOfArrays[$i];
                }
            }            
        }elseif($firstType == "server") {
            $serverArrayOfArrays = $allArrayOfArraysOfArrays['serverArrayOfArrays'];
            for($i = 0; $i < count($serverArrayOfArrays); $i++){                
                if($serverArrayOfArrays[$i]['iD'] == $firstID){                    
                    $firstLinkMatchArray = $serverArrayOfArrays[$i];
                }
            }            
        }elseif($firstType == "other") {
            
        }
        return $firstLinkMatchArray;
    }

    function getTheSecondLinkMatchArray($secondID, $secondType, $allArrayOfArraysOfArrays, $secondLinkMatchArray){
        if($secondType == "user") {
            $usersArrayOfArrays = $allArrayOfArraysOfArrays['usersArrayOfArrays'];
            for($i = 0; $i < count($usersArrayOfArrays); $i++){                
                if($usersArrayOfArrays[$i]['iD'] == $secondID){                    
                    $secondLinkMatchArray = $usersArrayOfArrays[$i];
                }
            }            
        }elseif($secondType == "ip") {
            $iP_AndPortArrayOfArrays = $allArrayOfArraysOfArrays['iP_AndPortsArrayOfArrays'];
            for($i = 0; $i < count($iP_AndPortArrayOfArrays); $i++){                
                if($iP_AndPortArrayOfArrays[$i]['iD'] == $secondID){
                    $secondLinkMatchArray = $iP_AndPortArrayOfArrays[$i];                    
                }
            }            
        }elseif($secondType == "location") {
            $locationArrayOfArrays = $allArrayOfArraysOfArrays['locationsArrayOfArrays'];
            for($i = 0; $i < count($locationArrayOfArrays); $i++){                
                if($locationArrayOfArrays[$i]['iD'] == $secondID){
                    $secondLinkMatchArray = $locationArrayOfArrays[$i];                    
                }
            }            
        }elseif($secondType == "equipment") {
            $equipmentArrayOfArrays = $allArrayOfArraysOfArrays['equipmentArrayOfArrays'];
            for($i = 0; $i < count($equipmentArrayOfArrays); $i++){                
                if($equipmentArrayOfArrays[$i]['iD'] == $secondID){
                    $secondLinkMatchArray = $equipmentArrayOfArrays[$i];                    
                }
            }            
        }elseif($secondType == "password") {
            $passwordArrayOfArrays = $allArrayOfArraysOfArrays['passwordArrayOfArrays'];
            for($i = 0; $i < count($passwordArrayOfArrays); $i++){                
                if($passwordArrayOfArrays[$i]['iD'] == $secondID){
                    $secondLinkMatchArray = $passwordArrayOfArrays[$i];                    
                }
            }            
        }elseif($secondType == "server") {
            $serverArrayOfArrays = $allArrayOfArraysOfArrays['serverArrayOfArrays'];
            for($i = 0; $i < count($serverArrayOfArrays); $i++){                
                if($serverArrayOfArrays[$i]['iD'] == $secondID){                    
                    $secondLinkMatchArray = $serverArrayOfArrays[$i];
                }
            }                      
        }elseif($secondType == "other") {
            
        }
        return $secondLinkMatchArray;
    }

    function getTheMatchedLinks($firstID, $firstType, $secondID, $secondType, $conn, $allArrayOfArraysOfArrays){
        $firstLinkMatchArray = [];
        $secondLinkMatchArray = [];
        $combinedLinkMatchArray = [];
        $firstLinkMatchArray = getTheFirstLinkMatchArray($firstID, $firstType, $allArrayOfArraysOfArrays, $firstLinkMatchArray);
        $secondLinkMatchArray = getTheSecondLinkMatchArray($secondID, $secondType, $allArrayOfArraysOfArrays, $secondLinkMatchArray);                
        $combinedLinkMatchArray = [$firstLinkMatchArray, $secondLinkMatchArray];        
        return $combinedLinkMatchArray;
    }
    
    function outputToExcelSheet($combinedLinkMatchArray){
        $firstLinkMatchArray = [];
        $secondLinkMatchArray = [];
        $fileName = "it_inventory_combined_link_data.xls";
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header("Content-Type: application/vnd.ms-excel");        
        $firstLinkMatchArray = $combinedLinkMatchArray[0];
        $secondLinkMatchArray = $combinedLinkMatchArray[1];
        //array shift pops from front of array
        for($i = 0; $i < count($firstLinkMatchArray); $i++){
            echo  "First Link Item:" . "\t";
            for($i = 0; $i < count($firstLinkMatchArray); $i++){
                $poppedItemFromFirstLinkMatchArray = array_shift($firstLinkMatchArray);
                echo "$poppedItemFromFirstLinkMatchArray" . "\t";
            }
            echo  "\t" . "Second Link Item:" . "\t";
            for($i = 0; $i < count($firstLinkMatchArray); $i++){
                $poppedItemFromSecondLinkMatchArray = array_shift($secondLinkMatchArray);
                echo "$poppedItemFromSecondLinkMatchArray" . "\t";
            }
            echo "\n";
        }       
        
    }
    function getTheUserEquipmentIP_Array($combinedLinkMatchArray, $userEquipmentIP_Array){
        for($i = 0; $i < count($combinedLinkMatchArray); $i++){
            $isFirstItemUserEqOrIP = null;
            $isSecondItemUserEqOrIP = null;
            if($combinedLinkMatchArray[$i][0]['userName'] != null){
                $isFirstItemUserEqOrIP = true;
            }elseif($combinedLinkMatchArray[$i][0]['modelName'] != null){
                $isFirstItemUserEqOrIP = true;
            }elseif($combinedLinkMatchArray[$i][0]['iP'] != null){
                $isFirstItemUserEqOrIP = true;
            }else{
                $isFirstItemUserEqOrIP = false;
            }
            if($combinedLinkMatchArray[$i][1]['userName'] != null){
                $isSecondItemUserEqOrIP = true;
            }elseif($combinedLinkMatchArray[$i][1]['modelName'] != null){
                $isSecondItemUserEqOrIP = true;
            }elseif($combinedLinkMatchArray[$i][1]['iP'] != null){
                $isSecondItemUserEqOrIP = true;            
            }else{
                $isSecondItemUserEqOrIP = false;
            }
            if($isFirstItemUserEqOrIP and $isSecondItemUserEqOrIP){            
                array_push($userEquipmentIP_Array, $combinedLinkMatchArray[$i]);
            }
        }                
        return $userEquipmentIP_Array;
    }
    function getTheEquipmentIPArray($combinedLinkMatchArray, $EquipmentIP_Array){

    }
    function getTheUserEquipmentIP_MatchingLinks($combinedLinkMatchArray){
        $userEquipmentIP_Array = [];        
        $userEquipmentIP_Array = getTheUserEquipmentIP_Array($combinedLinkMatchArray, $userEquipmentIP_Array);        
        return $userEquipmentIP_Array;
    }
    function printTheMatchingOne($theArray){
        foreach($theArray as $thing){
            echo "$thing" . "\t";
        }
    }
    function matchByEquipmentAndPutInRowOfThreeAndPrint($arrayOfUserEquipmentIP_LocationToBePrinted){
        $fileName = "it_inventory_user_computer_ip_data.xls";
        header("Content-Disposition: attachment; filename=\"$fileName\"");
        header("Content-Type: application/vnd.ms-excel");
        for($i = 0; $i < count($arrayOfUserEquipmentIP_LocationToBePrinted); $i++){
            for($j = 0; $j < count($arrayOfUserEquipmentIP_LocationToBePrinted); $j++){
                if($arrayOfUserEquipmentIP_LocationToBePrinted[$i][0]['modelName'] == $arrayOfUserEquipmentIP_LocationToBePrinted[$j][1]['modelName']){
                    if($arrayOfUserEquipmentIP_LocationToBePrinted[$i][0]['modelName'] != null){
                        //echo    "<h1>" . "MATCH " . $arrayOfUserEquipmentIP_LocationToBePrinted[$i][0]['modelName'] . " " . $arrayOfUserEquipmentIP_LocationToBePrinted[$j][1]['modelName'] . "</h1>" ;
                        echo    "First One: " . "\t";
                        printTheMatchingOne($arrayOfUserEquipmentIP_LocationToBePrinted[$i][0]);
                        echo   "\t" . "Second One: " . "\t";
                        printTheMatchingOne($arrayOfUserEquipmentIP_LocationToBePrinted[$i][1]);
                        echo   "\t" . "Third One: " . "\t";
                        printTheMatchingOne($arrayOfUserEquipmentIP_LocationToBePrinted[$j][0]);
                        echo "\n";
                    }                    
                }
            }            
        }
    }
    function getTheArrayOfItemsForExcelOutput($allArrayOfArraysOfArrays, $conn, $arrayOfUserEquipmentIP_LocationToBePrinted){
        $linksArrayOfArrays = $allArrayOfArraysOfArrays['linksArrayOfArrays'];
        $combinedLinkMatchArray = [];
        //loop through each link
        for($i = 0; $i < count($linksArrayOfArrays); $i++){
            $linkArray = $linksArrayOfArrays[$i];            
            $firstID = $linkArray['firstID'];
            $firstType = $linkArray['firstType'];
            $secondID = $linkArray['second_id'];
            $secondType = $linkArray['secondType'];
            //once we have one link we get the first item and the second item that are part of the link
            array_push($combinedLinkMatchArray,getTheMatchedLinks($firstID, $firstType, $secondID, $secondType, $conn, $allArrayOfArraysOfArrays));            
            //outputToExcelSheet($combinedLinkMatchArray);
        }
        $arrayOfUserEquipmentIP_LocationToBePrinted = getTheUserEquipmentIP_MatchingLinks($combinedLinkMatchArray);
        
        return $arrayOfUserEquipmentIP_LocationToBePrinted;
    }
    function printTheArrayToExcel($arrayOfUserEquipmentIP_LocationToBePrinted){
        // $fileName = "it_inventory_user_computer_ip_data.xls";
        // header("Content-Disposition: attachment; filename=\"$fileName\"");
        // header("Content-Type: application/vnd.ms-excel");
        for($i = 0; $i < count($arrayOfUserEquipmentIP_LocationToBePrinted); $i++){
            $firstItemArrayInMatchLink = $arrayOfUserEquipmentIP_LocationToBePrinted[$i][0];
            echo    "First Link Item:" . "\t";
            foreach($firstItemArrayInMatchLink as $itemFromFirstLinkArray){
                echo "$itemFromFirstLinkArray". "\t";
            }         
            echo "\t";   
            echo    "Second Link Item:" . "\t";
            $secondArrayItemInMatchLink = $arrayOfUserEquipmentIP_LocationToBePrinted[$i][1];
            foreach($secondArrayItemInMatchLink as $itemFromSecondLinkArray){
                echo "$itemFromSecondLinkArray". "\t";
            }
            echo "\n";

        }
        exit;
        // //echo implode("\t", array_keys($linksArrayOfArrays[0])) . "\n";
        // //foreach ($linksArrayOfArrays as $row) {
        //     echo implode("\t", $row) . "\n";
        // }
        // exit;
    }
    function outputArraysToExcel($allArrayOfArraysOfArrays, $conn){        
        $arrayOfUserEquipmentIP_LocationToBePrinted = [];
        $arrayOfUserEquipmentIP_LocationToBePrinted = getTheArrayOfItemsForExcelOutput($allArrayOfArraysOfArrays, $conn, $arrayOfUserEquipmentIP_LocationToBePrinted);
        matchByEquipmentAndPutInRowOfThreeAndPrint($arrayOfUserEquipmentIP_LocationToBePrinted);    
        //printTheArrayToExcel($arrayOfUserEquipmentIP_LocationToBePrinted);        
    }
    function executeIP_AndPortsDatabaseQuery($conn, $databaseQueryStringsArray, $iP_AndPortsArrayOfArrays){
        $iP_AndPortsQueryString = $databaseQueryStringsArray['iP_AndPortsQueryString'];      
        $iP_AndPortsArray = [];        
        $result = mysqli_query($conn, $iP_AndPortsQueryString);
            if (mysqli_num_rows($result) > 0) {                                 
                while($row = mysqli_fetch_assoc($result)){                    
                    $iP_AndPortsArray = ['iP' => $row['ip'], 'port' => $row['port'], 'iP_Remark' => $row['ip_remark'], 'date' => $row['date'], 'time' => $row['time'], 'iD' => $row['id']];
                    array_push($iP_AndPortsArrayOfArrays, $iP_AndPortsArray);
                }
            } 
        return $iP_AndPortsArrayOfArrays;
    }
    function executeLinksDatabaseQuery($conn, $databaseQueryStringsArray, $linksArrayOfArrays){
        $linksDatabaseQueryString = $databaseQueryStringsArray['linksDatabaseQueryString'];      
        $linksArray = [];
        $result = mysqli_query($conn, $linksDatabaseQueryString);
            if (mysqli_num_rows($result) > 0) {                                 
                while($row = mysqli_fetch_assoc($result)){                    
                    $linksArray = ['firstID' => $row['first_id'], 'second_id' => $row['second_id'], 'firstType' => $row['first_type'], 'secondType' => $row['second_type'], 'date' => $row['date'], 'time' => $row['time'], 'linkRemark' => $row['link_remark'], 'iD' => $row['id']];
                    array_push($linksArrayOfArrays, $linksArray);
                }
            } 
        return $linksArrayOfArrays;
    }
    function executeLocationsDatabaseQuery($conn, $databaseQueryStringsArray, $locationsArrayOfArrays) {
        $locationsDatabaseQueryString = $databaseQueryStringsArray['locationsDatabaseQueryString'];        
        $locationsArray = [];
        $result = mysqli_query($conn, $locationsDatabaseQueryString);
            if (mysqli_num_rows($result) > 0) {                                 
                while($row = mysqli_fetch_assoc($result)){                    
                    $locationsArray = ['locationName' => $row['location_name'], 'cityTown' => $row['city_town'], 'roomNumber' => $row['room_number'], 'LSD_Coordinate' => $row['lsd_coordinate'], 'latitude' => $row['latitude'], 'longitude' => $row['longitude'], 'date' => $row['date'], 'time' => $row['time'], 'iD' => $row['id']];
                    array_push($locationsArrayOfArrays, $locationsArray);
                }
            } 
        return $locationsArrayOfArrays;
    }
    function executePasswordDatabaseQuery($conn, $databaseQueryStringsArray, $passwordArrayOfArrays){
        $passwordDatabaseQueryString = $databaseQueryStringsArray['passwordDatabaseQueryString'];         
        $passwordArray = [];
        $result = mysqli_query($conn, $passwordDatabaseQueryString);
            if (mysqli_num_rows($result) > 0) {                                 
                while($row = mysqli_fetch_assoc($result)){                    
                    $password = decryptPassword($row['password']);
                    $passwordArray = ['password' => $password, 'passwordRemark' => $row['password_remark'], 'date' => $row['date'], 'time' => $row['time'], 'iD' => $row['id']];
                    array_push($passwordArrayOfArrays, $passwordArray);
                }
            } 
        return $passwordArrayOfArrays;
    }
    function executeServerDatabaseQuery($conn, $databaseQueryStringsArray, $serverArrayOfArrays){
        $serverDatabaseQueryString = $databaseQueryStringsArray['serverDatabaseQueryString'];         
        $serverArray = [];
        $result = mysqli_query($conn, $serverDatabaseQueryString);
            if (mysqli_num_rows($result) > 0) {                                 
                while($row = mysqli_fetch_assoc($result)){                                        
                    $serverArray = ['serverName' => $row['server_name'], 'serverRemark' => $row['server_remark'], 'date' => $row['date'], 'time' => $row['time'], 'iD' => $row['id']];
                    array_push($serverArrayOfArrays, $serverArray);
                }
            } 
        return $serverArrayOfArrays;
    }

    function executeUsersDatabaseQuery($conn, $databaseQueryStringsArray, $usersArrayOfArrays){
        $usersDatabaseQueryString = $databaseQueryStringsArray['usersDatabaseQueryString'];         
        $usersArray = [];
        $result = mysqli_query($conn, $usersDatabaseQueryString);
            if (mysqli_num_rows($result) > 0) {                                 
                while($row = mysqli_fetch_assoc($result)){                                        
                    $usersArray = ['iD' => $row['id'], 'firstName' => $row['first_name'], 'lastName' => $row['last_name'], 'cellPhoneNum' => $row['cell_phone_num'], 'officePhoneNum' => $row['office_phone_num'], 'email' => $row['email'], 'positionTitle' => $row['position_title'], 'extensionNum' => $row['extension_num'], 'userName' => $row['username'], 'date' => $row['date'], 'time' => $row['time'], 'userRemark' => $row['user_remark']];
                    array_push($usersArrayOfArrays, $usersArray);
                }
            } 
        return $usersArrayOfArrays;
    }

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
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        return $conn;
    }
    function executeDatabaseQueriesAndGetArraysOfData($conn , $databaseQueryStringsArray) {        
        $equipmentArrayOfArrays = [];
        $iP_AndPortsArrayOfArrays = [];
        $linksArrayOfArrays = [];
        $locationsArrayOfArrays = [];
        $passwordArrayOfArrays = [];
        $serverArrayOfArrays = [];
        $usersArrayOfArrays = [];
        $equipmentArrayOfArrays = executeEquipmentDatabaseQuery($conn, $databaseQueryStringsArray, $equipmentArrayOfArrays);
        $iP_AndPortsArrayOfArrays = executeIP_AndPortsDatabaseQuery($conn, $databaseQueryStringsArray, $iP_AndPortsArrayOfArrays);
        $linksArrayOfArrays = executeLinksDatabaseQuery($conn, $databaseQueryStringsArray, $linksArrayOfArrays);
        $locationsArrayOfArrays = executeLocationsDatabaseQuery($conn, $databaseQueryStringsArray, $locationsArrayOfArrays);
        $passwordArrayOfArrays = executePasswordDatabaseQuery($conn, $databaseQueryStringsArray, $passwordArrayOfArrays);
        $serverArrayOfArrays = executeServerDatabaseQuery($conn, $databaseQueryStringsArray, $serverArrayOfArrays);
        $usersArrayOfArrays = executeUsersDatabaseQuery($conn, $databaseQueryStringsArray, $usersArrayOfArrays);        
        $allArrayOfArraysOfArrays = ['equipmentArrayOfArrays' => $equipmentArrayOfArrays, 'iP_AndPortsArrayOfArrays' => $iP_AndPortsArrayOfArrays, 'linksArrayOfArrays' => $linksArrayOfArrays, 'locationsArrayOfArrays' => $locationsArrayOfArrays, 'passwordArrayOfArrays' => $passwordArrayOfArrays, 'serverArrayOfArrays' => $serverArrayOfArrays, 'usersArrayOfArrays' => $usersArrayOfArrays];
        return $allArrayOfArraysOfArrays;        
    }
    function getDatabaseQueryStringsForEachTable($databaseQueryStringsArray){
        $equipmentDatabaseQueryString = createDatabaseQueryStringEquipmentTable();
        $iP_AndPortsDatabaseQueryString = createDatabaseQueryStringIP_AndPortsTable();
        $linksDatabaseQueryString = createDatabaseQueryStringLinksTable();
        $locationsDatabaseQueryString = createDatabaseQueryStringLocationsTable();
        $passwordsDatabaseQueryString = createDatabaseQueryStringPasswordsTable();
        $serverDatabaseQueryString = createDatabaseQueryStringServersTable();        
        $usersDatabaseQueryString = createDatabaseQueryStringUsersTable();        
        $databaseQueryStringsArray['equipmentQueryString'] = $equipmentDatabaseQueryString;
        $databaseQueryStringsArray['iP_AndPortsQueryString'] = $iP_AndPortsDatabaseQueryString;
        $databaseQueryStringsArray['linksDatabaseQueryString'] = $linksDatabaseQueryString;
        $databaseQueryStringsArray['locationsDatabaseQueryString'] = $locationsDatabaseQueryString;
        $databaseQueryStringsArray['passwordDatabaseQueryString'] = $passwordsDatabaseQueryString;
        $databaseQueryStringsArray['serverDatabaseQueryString'] = $serverDatabaseQueryString;
        $databaseQueryStringsArray['usersDatabaseQueryString'] = $usersDatabaseQueryString;
        return $databaseQueryStringsArray;
    }
    function databaseToExcelMainFunction() {
        $allArrayOfArraysOfArrays = [];
        $databaseQueryStringsArray = [];
        $conn = connectToDatabase();
        $databaseQueryStringsArray = getDatabaseQueryStringsForEachTable($databaseQueryStringsArray);
        $allArrayOfArraysOfArrays = executeDatabaseQueriesAndGetArraysOfData($conn , $databaseQueryStringsArray);  
        outputArraysToExcel($allArrayOfArraysOfArrays, $conn);    
    }
    databaseToExcelMainFunction();
?>