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
        $iP_AndPortsDatabaseQueryString = '';
        return $iP_AndPortsDatabaseQueryString;
    }
    function createDatabaseQueryStringLinksTable() {
        $linksDatabaseQueryString = '';
        return $linksDatabaseQueryString;
    }
    function createDatabaseQueryStringLocationsTable() {
        $locationsDatabaseQueryString = '';
        return $locationsDatabaseQueryString;
    }
    function createDatabaseQueryStringPasswordsTable() {
        $passwordsDatabaseQueryString = '';
        return $passwordsDatabaseQueryString;
    }
    function createDatabaseQueryStringServersTable() {
        $serversDatabaseQueryString = '';
        return $serversDatabaseQueryString;
    }
    function createDatabaseQueryStringUsersTable() {
        $usersDatabaseQueryString = '';
        return $usersDatabaseQueryString;
    }
    function executeEquipmentDatabaseQuery($conn, $databaseQueryStringsArray, $equipmentArrayOfArrays) {
        $equipmentDatabaseQueryString = $databaseQueryStringsArray['equipmentQueryString'];      
        $equipmentArray = [];        
        $result = mysqli_query($conn, $equipmentDatabaseQueryString);
            if (mysqli_num_rows($result) > 0) {                                 
                while($row = mysqli_fetch_assoc($result)){
                    echo "ID: " . $row["id"] . "<br>" . "Name: " . $row["name"] . "<br>" . "Type: " . $row["type"] . "<br>" . "Model Number: " . $row["model_number"] . "<br><br>";
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
    
    function outputArraysToExcel($allArrayOfArraysOfArrays){        
        outputEquipmentDatabaseToExcel($allArrayOfArraysOfArrays['equipmentArrayOfArrays']);    
        outputIP_AndPortsDatabaseToExcel($allArrayOfArraysOfArrays['iP_AndPortsArrayOfArrays']);
    }
    function executeIP_AndPortsArrayOfArrays($conn, $databaseQueryStringsArray, $iP_AndPortsArrayOfArrays){
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
    function executeDatabaseQueries($conn , $databaseQueryStringsArray) {
        $allArrayOfArraysOfArrays = [];
        $equipmentArrayOfArrays = [];
        $iP_AndPortsArrayOfArrays = [];
        $equipmentArrayOfArrays = executeEquipmentDatabaseQuery($conn, $databaseQueryStringsArray, $equipmentArrayOfArrays);
        $iP_AndPortsArrayOfArrays = executeIP_AndPortsArrayOfArrays($conn, $databaseQueryStringsArray, $iP_AndPortsArrayOfArrays);
        $allArrayOfArraysOfArrays = ['equipmentArrayOfArrays' => $equipmentArrayOfArrays, 'iP_AndPortsArrayOfArrays' => $iP_AndPortsArrayOfArrays];
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