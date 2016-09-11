<?php

	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */

	/**
	 * Description of Regions
	 *
	 * @author marcos
	 */
	class Regions{
		
		public function __construct() 
		{
			
		}
		public function getRegionsList($values)
		{	
			$columns = array();
			$columns[0] = 'id_region';
			$columns[1] = 'name';
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
				$where = ""
                                        . "upper(status.name) like upper('%$str%') "
                                        . "or upper(regions.name) like upper('%$str%')"
										. "or upper(regions.abr) like upper('%$str%')"
                                        . "or cast(id_region as char(100)) =  '$str' ";
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
			$q = $ConnectionORM->getConnect()->regions()
			->select("regions.*,DATE_FORMAT(regions.date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(regions.date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->join("status","LEFT JOIN status on status.id_status = regions.status")
                        ->where("$where")
                        ->order("$column_order $order")
			->limit($limit,$offset);
			return $q; 			
		}
		public function getCountRegionsList($values)
		{	
			$where = '1 = 1';
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = ""
                                        . "upper(status.name) like upper('%$str%') "
                                        . "or upper(regions.name) like upper('%$str%')"
										. "or upper(regions.abr) like upper('%$str%')"
                                        . "or cast(id_region as char(100)) =  '$str' ";
			}
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->regions
			->select("count(*) as cuenta")
			->join("status","LEFT JOIN status on status.id_status = regions.status")	
			->where("$where")->fetch();
			return $q['cuenta']; 			
		}
		public function getRegionsById($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->regions
			->select("*, DATE_FORMAT(date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->where("id_region=?",$values['id_region'])->fetch();
			return $q; 				
			
		}
		function deleteRegions($id){
			unset($values['action']);
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->regions("id", $id)->delete();
			
			
		}		
		function saveRegions($values){
			unset($values['action'],$values['id_region']);
			$values['date_created'] = new NotORM_Literal("NOW()");
			$values['date_updated'] = new NotORM_Literal("NOW()");
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->regions()->insert($values);
			$values['id_region'] = $ConnectionORM->getConnect()->Regions()->insert_id();
			return $values;	
			
		}
		function updateRegions($values){
			unset($values['action'],$values['PHPSESSID'],$values['date_created']);
			$values['date_updated'] = new NotORM_Literal("NOW()");
			$id_region = $values['id_region'];
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->regions("id_region", $id_region)->update($values);
			return $q;
			
		}
		public function getListRegions($values = null){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->regions
			->select("*")
			->where("status=?",1);
			return $q; 				
			
		}
	}
	