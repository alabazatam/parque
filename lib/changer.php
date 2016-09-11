<?php

    function status_changer($table,$column_primary, $id,$value_change){ 
	
    $ConnectionORM = new ConnectionORM();
	$date_updated = new NotORM_Literal("NOW()");
    $q = $ConnectionORM->getConnect()->$table("$column_primary", $id)->update(array("status" => $value_change, "date_updated" => $date_updated));
    return true;
    }