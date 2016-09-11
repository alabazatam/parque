<?php

	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */

	/**
	 * Description of Containers
	 *
	 * @author marcos
	 */
	class Containers {
		
		public function __construct() 
		{
			
		}
		public function getContainersList($values)
		{	
			$columns = array();
			$columns[0] = 'id_container';
			$columns[1] = 'containers.name';
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
				$where = "upper(containers.name) like upper('%$str%')"
					. "or upper(abr) like upper('%$str%')"
					. "or upper(status.name) like upper('%$str%')"
					. "or cast(id_container as char(100)) =  '$str' ";
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
			$q = $ConnectionORM->getConnect()->containers
			->select("*,containers.name as name, DATE_FORMAT(containers.date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(containers.date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->order("$column_order $order")
			->join("status","LEFT JOIN status on status.id_status = containers.status")	
			->where("$where")
			->limit($limit,$offset);
			return $q; 			
		}
		public function getCountContainersList($values)
		{	
			$where = '1 = 1';
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = "upper(containers.name) like upper('%$str%')"
					. "or upper(abr) like upper('%$str%')"
					. "or upper(status.name) like upper('%$str%')"
					. "or cast(id_container as char(100)) =  '$str' ";
			}
            $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->containers
			->select("count(*) as cuenta")
			->where("$where")
			->join("status","LEFT JOIN status on status.id_status = containers.status")	
			->fetch();
			return $q['cuenta']; 			
		}
		public function getContainersById($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->containers
			->select("*, DATE_FORMAT(date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->where("id_container=?",$values['id_container'])->fetch();
                        return $q; 				
			
		}
		function deleteContainers($id_container){
			unset($values['action']);
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->containers("id_container", $id_container)->delete();
			
			
		}		
		function saveContainers($values){
			unset($values['action'],$values['PHPSESSID'],$values['errors']);
                        $values['date_created'] = new NotORM_Literal("NOW()");
                        $values['date_updated'] = new NotORM_Literal("NOW()");
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->containers()->insert($values);
			$values['id_container'] = $ConnectionORM->getConnect()->containers()->insert_id();
			return $values;	
			
		}
		function updateContainers($values){
			unset($values['action'],$values['PHPSESSID'],$values['errors']);
                        unset($values['date_created']);
			$id_container = $values['id_container'];
                        $values['date_updated'] = new NotORM_Literal("NOW()");
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->containers("id_container", $id_container)->update($values);
			return $q;
			
		}
		public function getContainersListSelect($values = null){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->containers
			->select("*, DATE_FORMAT(date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->where("status=?",1);
            return $q; 				
			
		}
	}
	