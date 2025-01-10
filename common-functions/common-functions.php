<?php
    function getTheTypeAndID($row){
        $firstType = $row["first_type"];
        $secondType = $row["second_type"];
        $firstID = $row["first_id"];
        $secondID = $row["second_id"];                            
        $typeAndID_Array = ['firstType' => $firstType, 'secondType' => $secondType, 'firstID' => $firstID, 'secondID' => $secondID];
        return $typeAndID_Array;
    }
?>