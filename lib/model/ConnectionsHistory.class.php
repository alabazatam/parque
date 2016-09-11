<?php

	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */

	/**
	 * Description of Bank
	 *
	 * @author marcos
	 */
	class ConnectionsHistory{
		
		public function __construct() 
		{
			
		}
				
		function saveConnectionsHistory($values){
			unset($values['action'],$values['PHPSESSID']);
			$values['date_created'] = new NotORM_Literal("NOW()");
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->connections_history()->insert($values);
			$values['id_connection'] = $ConnectionORM->getConnect()->connections_history()->insert_id();
			return $values;	
			
		}
		
		
	}
	