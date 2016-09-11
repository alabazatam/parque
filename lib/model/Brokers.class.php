<?php

	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */

	/**
	 * Description of Brokers
	 *
	 * @author marcos
	 */
	class Brokers{
		
		public function __construct() 
		{
			
		}
		public function getBrokersList($values)
		{	
			$columns = array();
			$columns[0] = 'id_broker';
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
										. "or upper(brokers.abr) like upper('%$str%') "
                                        . "or upper(brokers.name) like upper('%$str%')"
                                        . "or cast(id_broker as char(100)) =  '$str' ";
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
			$q = $ConnectionORM->getConnect()->brokers()
			->select("brokers.*,DATE_FORMAT(brokers.date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(brokers.date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->join("status","LEFT JOIN status on status.id_status = brokers.status")
                        ->where("$where")
                        ->order("$column_order $order")
			->limit($limit,$offset);
			return $q; 			
		}
		public function getCountBrokersList($values)
		{	
			$where = '1 = 1';
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = ""
                                        . "upper(status.name) like upper('%$str%') "
										. "or upper(brokers.abr) like upper('%$str%') "
                                        . "or upper(brokers.name) like upper('%$str%')"
                                        . "or cast(id_broker as char(100)) =  '$str' ";
			}
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->brokers
			->select("count(*) as cuenta")
			->join("status","LEFT JOIN status on status.id_status = brokers.status")
			->where("$where")->fetch();
			return $q['cuenta']; 			
		}
		public function getBrokersById($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->brokers
			->select("*, DATE_FORMAT(date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->where("id_broker=?",$values['id_broker'])->fetch();
			return $q; 				
			
		}
		function deleteBrokers($id){
			unset($values['action']);
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->brokers("id", $id)->delete();
			
			
		}		
		function saveBrokers($values){
			unset($values['action'],$values['PHPSESSID'],$values['id_broker']);
			$values['date_created'] = new NotORM_Literal("NOW()");
			$values['date_updated'] = new NotORM_Literal("NOW()");
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->brokers()->insert($values);
			$values['id_broker'] = $ConnectionORM->getConnect()->Brokers()->insert_id();
			return $values;	
			
		}
		function updateBrokers($values){
			unset($values['action'],$values['PHPSESSID'],$values['date_created']);
			$values['date_updated'] = new NotORM_Literal("NOW()");
			$id_broker = $values['id_broker'];
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->brokers("id_broker", $id_broker)->update($values);
			return $q;
			
		}
		
		public function getListBrokers($values = null){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->brokers
			->select("*")
			->where("status=?",1)
			->order('name');
			return $q; 				
			
		}
		
	}
	