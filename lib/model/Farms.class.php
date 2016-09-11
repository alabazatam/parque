<?php

	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */

	/**
	 * Description of Farms
	 *
	 * @author marcos
	 */
	class Farms {
		
		public function __construct() 
		{
			
		}
		public function getFarmsList($values)
		{	
			$columns = array();
			$columns[0] = 'id_farm';
			$columns[1] = 'farms.name';
			$columns[2] = 'abr';
			$columns[3] = 'status.name';
			$columns[4] = 'date_created';
			$columns[5] = 'date_updated';
			$column_order = $columns[0];
			$where = '1 = 1';
			$order = 'asc';
			$limit = $values['length'];
			$offset = $values['start'];
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = "upper(farms.name) like upper('%$str%')"
					. "or upper(abr) like upper('%$str%')"
					. "or upper(status.name) like upper('%$str%')"
					. "or cast(id_farm as char(100)) =  '$str' ";
			}
			if(isset($values['order'][0]['column']) and $values['order'][0]['column']!='0')
			{
				$column_order = $columns[$values['order'][0]['column']];
			}
			if(isset($values['order'][0]['dir']) and $values['order'][0]['dir']!='0')
			{
				$order = $values['order'][0]['dir'];//asc o desc
			}
			//echo $column_order;die;
            $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->farms
			->select("*,farms.name as name, DATE_FORMAT(farms.date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(farms.date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->order("$column_order $order")
			->join("status","LEFT JOIN status on status.id_status = farms.status")	
			->where("$where")
			->limit($limit,$offset);
			return $q; 			
		}
		public function getCountFarmsList($values)
		{	
			$where = '1 = 1';
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = "upper(farms.name) like upper('%$str%')"
					. "or upper(abr) like upper('%$str%')"
					. "or upper(status.name) like upper('%$str%')"
					. "or cast(id_farm as char(100)) =  '$str' ";
			}
            $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->farms
			->select("count(*) as cuenta")
			->where("$where")
			->join("status","LEFT JOIN status on status.id_status = farms.status")	
			->fetch();
			return $q['cuenta']; 			
		}
		public function getFarmsById($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->farms
			->select("*, DATE_FORMAT(date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->where("id_farm=?",$values['id_farm'])->fetch();
                        return $q; 				
			
		}
		function deleteFarms($id_farm){
			unset($values['action']);
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->farms("id_farm", $id_farm)->delete();
			
			
		}		
		function saveFarms($values){
			unset($values['action'],$values['PHPSESSID'],$values['errors'],$values['id_farm']);
                        $values['date_created'] = new NotORM_Literal("NOW()");
                        $values['date_updated'] = new NotORM_Literal("NOW()");
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->farms()->insert($values);
			$values['id_farm'] = $ConnectionORM->getConnect()->farms()->insert_id();
			return $values;	
			
		}
		function updateFarms($values){
			unset($values['action'],$values['PHPSESSID'],$values['errors']);
                        unset($values['date_created']);
			$id_farm = $values['id_farm'];
                        $values['date_updated'] = new NotORM_Literal("NOW()");
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->farms("id_farm", $id_farm)->update($values);
			return $q;
			
		}
		public function getFarmsListSelect($values = null){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->farms
			->select("*, DATE_FORMAT(date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->where("status=?",1);
            return $q; 				
			
		}
	}
	