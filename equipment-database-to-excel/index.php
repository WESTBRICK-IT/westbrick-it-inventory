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
    
    function outputArraysToExcel($allArrayOfArraysOfArrays){             
        outputEquipmentDatabaseToExcel($allArrayOfArraysOfArrays['equipmentArrayOfArrays']);    
        //outputIP_AndPortsDatabaseToExcel($allArrayOfArraysOfArrays['iP_AndPortsArrayOfArrays']);
        //outputLinksDatabaseToExcel($allArrayOfArraysOfArrays['linksArrayOfArrays']);
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
    function executeDatabaseQueries($conn , $databaseQueryStringsArray) {
        $allArrayOfArraysOfArrays = [];
        $equipmentArrayOfArrays = [];
        $iP_AndPortsArrayOfArrays = [];
        $linksArrayOfArrays = [];
        $equipmentArrayOfArrays = executeEquipmentDatabaseQuery($conn, $databaseQueryStringsArray, $equipmentArrayOfArrays);        
        $iP_AndPortsArrayOfArrays = executeIP_AndPortsDatabaseQuery($conn, $databaseQueryStringsArray, $iP_AndPortsArrayOfArrays);
        $linksArrayOfArrays = executeLinksDatabaseQuery($conn, $databaseQueryStringsArray, $linksArrayOfArrays);        
        $allArrayOfArraysOfArrays = ['equipmentArrayOfArrays' => $equipmentArrayOfArrays, 'iP_AndPortsArrayOfArrays' => $iP_AndPortsArrayOfArrays, 'linksArrayOfArrays' => $linksArrayOfArrays];
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
        $databaseQueryStringsArray['passwordsDatabaseQueryString'] = $passwordsDatabaseQueryString;
        $databaseQueryStringsArray['serversDatabaseQueryString'] = $serversDatabaseQueryString;
        $databaseQueryStringsArray['usersDatabaseQueryString'] = $usersDatabaseQueryString;
        return $databaseQueryStringsArray;
    }
    function databaseToExcelMainFunction() {
        $databaseQueryStringsArray = [];        
        $conn = connectToDatabase();
        $databaseQueryStringsArray = getDatabaseQueryStringsForEachTable($databaseQueryStringsArray);        
        executeDatabaseQueries($conn , $databaseQueryStringsArray);
        //$databaseQueryString = createDatabaseQueryString();
        //doTheDatabaseQuery($conn, $databaseQueryString);
    }
    databaseToExcelMainFunction();
?>