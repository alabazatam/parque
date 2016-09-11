<?php

	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */

	/**
	 * Description of States
	 *
	 * @author marcos
	 */
	class States{
		
		public function __construct() 
		{
			
		}
		public function getStatesList($values)
		{	
			$columns = array();
			$columns[0] = 'id_state';
			$columns[1] = 'states.name';
			$columns[2] = 'states.name';
			$columns[3] = 'states.status';
			$columns[4] = 'states.date_created';
			$columns[5] = 'states.date_updated';
			$column_order = $columns[0];
			$where = '1 = 1';
			$order = 'asc';
			$limit = $values['length'];
			$offset = $values['start'];
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = ""
                                        . "upper(status.name) like upper('%$str%') "
                                        . "or upper(states.name) like upper('%$str%')"
										. "or upper(country.name) like upper('%$str%')"
                                        . "or cast(id_state as char(100)) =  '$str' ";
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
			$q = $ConnectionORM->getConnect()->states()
			->select("states.*,country.name country_name,DATE_FORMAT(states.date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(states.date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->join("status","LEFT JOIN status on status.id_status = states.status")
			->join("country","LEFT JOIN country on country.id_country = states.id_country")
                        ->where("$where")
                        ->order("$column_order $order")
			->limit($limit,$offset);
			return $q; 			
		}
		public function getCountStatesList($values)
		{	
			$where = '1 = 1';
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = ""
                                        . "upper(status.name) like upper('%$str%') "
                                        . "or upper(states.name) like upper('%$str%')"
										. "or upper(country.name) like upper('%$str%')"
                                        . "or cast(id_state as char(100)) =  '$str' ";
			}
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->states
			->select("count(*) as cuenta")
			->join("status","LEFT JOIN status on status.id_status = states.status")
			->join("country","LEFT JOIN country on country.id_country = states.id_country")
			->where("$where")->fetch();
			return $q['cuenta']; 			
		}
		public function getStatesById($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->states
			->select("*, DATE_FORMAT(date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->where("id_state=?",$values['id_state'])->fetch();
			return $q; 				
			
		}
		function deleteStates($id){
			unset($values['action']);
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->states("id", $id)->delete();
			
			
		}		
		function saveStates($values){
			unset($values['action'],$values['id_state']);
			$values['date_created'] = new NotORM_Literal("NOW()");
			$values['date_updated'] = new NotORM_Literal("NOW()");
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->states()->insert($values);
			$values['id_state'] = $ConnectionORM->getConnect()->States()->insert_id();
			return $values;	
			
		}
		function updateStates($values){
			unset($values['action'],$values['PHPSESSID'],$values['date_created']);
			$values['date_updated'] = new NotORM_Literal("NOW()");
			$id_state = $values['id_state'];
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->states("id_state", $id_state)->update($values);
			return $q;
			
		}
		public function getListStates($values = null){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->states
			->select("*")
			->where("status=?",1)
			->order('name');
			return $q; 				
			
		}
	}
	