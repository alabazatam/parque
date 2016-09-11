<?php

	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */

	/**
	 * Description of Incoterms
	 *
	 * @author marcos
	 */
	class Incoterms{
		
		public function __construct() 
		{
			
		}
		public function getIncotermsList($values)
		{	
			$columns = array();
			$columns[0] = 'id_incoterm';
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
										. "or upper(incoterms.abr) like upper('%$str%') "
                                        . "or upper(incoterms.name) like upper('%$str%')"
                                        . "or cast(id_incoterm as char(100)) =  '$str' ";
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
			$q = $ConnectionORM->getConnect()->incoterms()
			->select("incoterms.*,DATE_FORMAT(incoterms.date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(incoterms.date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->join("status","LEFT JOIN status on status.id_status = incoterms.status")
                        ->where("$where")
                        ->order("$column_order $order")
			->limit($limit,$offset);
			return $q; 			
		}
		public function getCountIncotermsList($values)
		{	
			$where = '1 = 1';
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = ""
                                        . "upper(status.name) like upper('%$str%') "
										. "or upper(incoterms.abr) like upper('%$str%') "
                                        . "or upper(incoterms.name) like upper('%$str%')"
                                        . "or cast(id_incoterm as char(100)) =  '$str' ";
			}
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->incoterms
			->select("count(*) as cuenta")
			->join("status","LEFT JOIN status on status.id_status = incoterms.status")
			->where("$where")->fetch();
			return $q['cuenta']; 			
		}
		public function getIncotermsById($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->incoterms
			->select("*, DATE_FORMAT(date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->where("id_incoterm=?",$values['id_incoterm'])->fetch();
			return $q; 				
			
		}
		function deleteIncoterms($id){
			unset($values['action']);
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->incoterms("id", $id)->delete();
			
			
		}		
		function saveIncoterms($values){
			unset($values['action'],$values['id_incoterm']);
			$values['date_created'] = new NotORM_Literal("NOW()");
			$values['date_updated'] = new NotORM_Literal("NOW()");
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->incoterms()->insert($values);
			$values['id_incoterm'] = $ConnectionORM->getConnect()->Incoterms()->insert_id();
			return $values;	
			
		}
		function updateIncoterms($values){
			unset($values['action'],$values['PHPSESSID'],$values['date_created']);
			$values['date_updated'] = new NotORM_Literal("NOW()");
			$id_incoterm = $values['id_incoterm'];
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->incoterms("id_incoterm", $id_incoterm)->update($values);
			return $q;
			
		}
		public function getListIncoterms($values = null){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->incoterms
			->select("*")
			->where("status=?",1)
			->order('name');
			return $q; 				
			
		}
	}
	