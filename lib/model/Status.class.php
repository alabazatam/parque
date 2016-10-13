<?php

	class Status
	{
		
		public function __construct() 
		{
			
		}
		
		public function getStatusName($id_status){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->status
			->select("*")
			->where("id_status=?",$id_status)->fetch();
			return $q['name']; 				
			
		}
		
		
		
		
	}