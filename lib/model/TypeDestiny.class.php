<?php

	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */

	/**
	 * Description of TypeDestiny
	 *
	 * @author marcos
	 */
	class TypeDestiny{
		
		public function __construct() 
		{
			
		}
		public function getTypeDestinyList($values)
		{	
			$columns = array();
			$columns[0] = 'id_type_destiny';
			$columns[1] = 'name';
			$columns[2] = 'abr';
			$columns[3] = 'status';
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
				$where = ""
                                        . "upper(status.name) like upper('%$str%') "
										. "or upper(type_destiny.abr) like upper('%$str%') "
                                        . "or upper(type_destiny.name) like upper('%$str%')"
                                        . "or cast(id_type_destiny as char(100)) =  '$str' ";
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
			$q = $ConnectionORM->getConnect()->type_destiny()
			->select("type_destiny.*,DATE_FORMAT(type_destiny.date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(type_destiny.date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->join("status","LEFT JOIN status on status.id_status = type_destiny.status")
                        ->where("$where")
                        ->order("$column_order $order")
			->limit($limit,$offset);
			return $q; 			
		}
		public function getCountTypeDestinyList($values)
		{	
			$where = '1 = 1';
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = ""
                                        . "upper(status.name) like upper('%$str%') "
										. "or upper(type_destiny.abr) like upper('%$str%') "
                                        . "or upper(type_destiny.name) like upper('%$str%')"
                                        . "or cast(id_type_destiny as char(100)) =  '$str' ";
			}
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->type_destiny
			->select("count(*) as cuenta")
			->join("status","LEFT JOIN status on status.id_status = type_destiny.status")
			->where("$where")->fetch();
			return $q['cuenta']; 			
		}
		public function getTypeDestinyById($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->type_destiny
			->select("*, DATE_FORMAT(date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->where("id_type_destiny=?",$values['id_type_destiny'])->fetch();
			return $q; 				
			
		}
		function deleteTypeDestiny($id){
			unset($values['action']);
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->type_destiny("id", $id)->delete();
			
			
		}		
		function saveTypeDestiny($values){
			unset($values['action'],$values['id_type_destiny']);
			$values['date_created'] = new NotORM_Literal("NOW()");
			$values['date_updated'] = new NotORM_Literal("NOW()");
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->type_destiny()->insert($values);
			$values['id_type_destiny'] = $ConnectionORM->getConnect()->TypeDestiny()->insert_id();
			return $values;	
			
		}
		function updateTypeDestiny($values){
			unset($values['action'],$values['PHPSESSID'],$values['date_created']);
			$values['date_updated'] = new NotORM_Literal("NOW()");
			$id_type_destiny = $values['id_type_destiny'];
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->type_destiny("id_type_destiny", $id_type_destiny)->update($values);
			return $q;
			
		}
		public function getListTypeDestiny($values = null){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->type_destiny
			->select("*")
			->where("status=?",1)
			->order('name');
			return $q; 				
			
		}
	}
	