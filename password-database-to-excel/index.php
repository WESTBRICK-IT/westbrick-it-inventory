<?php
    include "../common-functions/common-functions.php";    

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
                    array_push($equipmentArrayofArrays, $equipmentArray);
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
    
    function outputArraysToExcel($allArrayOfArraysOfArrays){        
        //outputEquipmentDatabaseToExcel($allArrayOfArraysOfArrays['equipmentArrayOfArrays']);    
        //outputIP_AndPortsDatabaseToExcel($allArrayOfArraysOfArrays['iP_AndPortsArrayOfArrays']);
        //outputLinksDatabaseToExcel($allArrayOfArraysOfArrays['linksArrayOfArrays']);
        //outputLocationsDatabaseToExcel($allArrayOfArraysOfArrays['locationsArrayOfArrays']);
        outputPasswordsDatabaseToExcel($allArrayOfArraysOfArrays['passwordArrayOfArrays']);
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
                    $locationsArray = ['locationName' => $row['location_name'], 'cityTown' => $row['city_town'], 'roomNumber' => $row['room_number'], 'LSD_Coordinate' => $row['lsd_coordinate'], 'latitude' => $row['latitude'], 'longitude' => $row['longitude'], 'date' => $row['date'], 'time' => $row['time']];
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
    function executeDatabaseQueries($conn , $databaseQueryStringsArray) {
        $allArrayOfArraysOfArrays = [];
        $equipmentArrayOfArrays = [];
        $iP_AndPortsArrayOfArrays = [];
        $linksArrayOfArrays = [];
        $locationsArrayOfArrays = [];
        $passwordArrayOfArrays = [];
        $equipmentArrayOfArrays = executeEquipmentDatabaseQuery($conn, $databaseQueryStringsArray, $equipmentArrayOfArrays);
        $iP_AndPortsArrayOfArrays = executeIP_AndPortsDatabaseQuery($conn, $databaseQueryStringsArray, $iP_AndPortsArrayOfArrays);
        $linksArrayOfArrays = executeLinksDatabaseQuery($conn, $databaseQueryStringsArray, $linksArrayOfArrays);
        $locationsArrayOfArrays = executeLocationsDatabaseQuery($conn, $databaseQueryStringsArray, $locationsArrayOfArrays);
        $passwordArrayOfArrays = executePasswordDatabaseQuery($conn, $databaseQueryStringsArray, $passwordArrayOfArrays);
        $allArrayOfArraysOfArrays = ['equipmentArrayOfArrays' => $equipmentArrayOfArrays, 'iP_AndPortsArrayOfArrays' => $iP_AndPortsArrayOfArrays, 'linksArrayOfArrays' => $linksArrayOfArrays, 'locationsArrayOfArrays' => $locationsArrayOfArrays, 'passwordArrayOfArrays' => $passwordArrayOfArrays];
        outputArraysToExcel($allArrayOfArraysOfArrays);
    }
    function getDatabaseQueryStringsForEachTable($databaseQueryStringsArray){
        $equipmentDatabaseQueryString = createDatabaseQueryStringEquipmentTable();
        $iP_AndPortsDatabaseQueryString = createDatabaseQueryStringIP_AndPortsTable();
        $linksDatabaseQueryString = createDatabaseQueryStringLinksTable();
        $locationsDatabaseQueryString = createDatabaseQueryStringLocationsTable();
        $passwordsDatabaseQueryString = createDatabaseQueryStringPasswordsTable();
        $serversDatabaseQueryString = createDatabaseQueryStringServersTable();
        $usersDatabaseQueryString = createDatabaseQueryStringUsersTable();
        $databaseQueryStringsArray['equipmentQueryString'] = $equipmentDatabaseQueryString;
        $databaseQueryStringsArray['iP_AndPortsQueryString'] = $iP_AndPortsDatabaseQueryString;
        $databaseQueryStringsArray['linksDatabaseQueryString'] = $linksDatabaseQueryString;
        $databaseQueryStringsArray['locationsDatabaseQueryString'] = $locationsDatabaseQueryString;
        $databaseQueryStringsArray['passwordDatabaseQueryString'] = $passwordsDatabaseQueryString;
        $databaseQueryStringsArray['serversDatabaseQueryString'] = $serversDatabaseQueryString;
        $databaseQueryStringsArray['usersDatabaseQueryString'] = $usersDatabaseQueryString;
        return $databaseQueryStringsArray;
    }
    function databaseToExcelMainFunction() {
        $databaseQueryStringsArray = [];
        $conn = connectToDatabase();
        $databaseQueryStringsArray = getDatabaseQueryStringsForEachTable($databaseQueryStringsArray);
        executeDatabaseQueries($conn , $databaseQueryStringsArray);        
    }
    databaseToExcelMainFunction();
?>