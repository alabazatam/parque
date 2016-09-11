<?php

	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */

	/**
	 * Description of Country
	 *
	 * @author marcos
	 */
	class Country{
		
		public function __construct() 
		{
			
		}
		public function getCountryList($values)
		{	
			$columns = array();
			$columns[0] = 'id_country';
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
										. "or upper(country.abr) like upper('%$str%') "
                                        . "or upper(country.name) like upper('%$str%')"
                                        . "or cast(id_country as char(100)) =  '$str' ";
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
			$q = $ConnectionORM->getConnect()->country()
			->select("country.*,DATE_FORMAT(country.date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(country.date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->join("status","LEFT JOIN status on status.id_status = country.status")
                        ->where("$where")
                        ->order("$column_order $order")
			->limit($limit,$offset);
			return $q; 			
		}
		public function getCountCountryList($values)
		{	
			$where = '1 = 1';
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = ""
                                        . "upper(status.name) like upper('%$str%') "
										. "or upper(country.abr) like upper('%$str%') "
                                        . "or upper(country.name) like upper('%$str%')"
                                        . "or cast(id_country as char(100)) =  '$str' ";
			}
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->country
			->select("count(*) as cuenta")
			->join("status","LEFT JOIN status on status.id_status = country.status")
			->where("$where")->fetch();
			return $q['cuenta']; 			
		}
		public function getCountryById($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->country
			->select("*, DATE_FORMAT(date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->where("id_country=?",$values['id_country'])->fetch();
			return $q; 				
			
		}
		function deleteCountry($id){
			unset($values['action']);
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->country("id", $id)->delete();
			
			
		}		
		function saveCountry($values){
			unset($values['action'],$values['id_country']);
			$values['date_created'] = new NotORM_Literal("NOW()");
			$values['date_updated'] = new NotORM_Literal("NOW()");
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->country()->insert($values);
			$values['id_country'] = $ConnectionORM->getConnect()->Country()->insert_id();
			return $values;	
			
		}
		function updateCountry($values){
			unset($values['action'],$values['PHPSESSID'],$values['date_created']);
			$values['date_updated'] = new NotORM_Literal("NOW()");
			$id_country = $values['id_country'];
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->country("id_country", $id_country)->update($values);
			return $q;
			
		}
		public function getListCountry($values = null){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->country
			->select("*")
			->where("status=?",1)
			->order('id_country');
			return $q; 				
			
		}
	}
	