<?php

	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */

	/**
	 * Description of Company
	 *
	 * @author marcos
	 */
	class Company {
		
		public function __construct() 
		{
			
		}
		public function getCompanyList($values)
		{	
			$columns = array();
			$columns[0] = 'id_company';
			$columns[1] = 'company.description';
			$columns[2] = 'rif';
                        $columns[3] = 'contact1';
			$columns[4] = 'status.name';
			$column_order = $columns[0];
			$where = '1 = 1';
			$order = 'asc';
			$limit = $values['length'];
			$offset = $values['start'];
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = "upper(company.description) like upper('%$str%')"
					. "or upper(rif) like upper('%$str%')"
					. "or upper(status.name) like upper('%$str%')"
					. "or cast(id_company as char(100)) =  '$str' ";
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
			$q = $ConnectionORM->getConnect()->company
			->select("*,company.description as description, DATE_FORMAT(company.date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(company.date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->order("$column_order $order")
			->join("status","LEFT JOIN status on status.id_status = company.status")	
			->where("$where")
			->limit($limit,$offset);
			return $q; 			
		}
		public function getCountCompanyList($values)
		{	
			$where = '1 = 1';
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = "upper(company.description) like upper('%$str%')"
					. "or upper(rif) like upper('%$str%')"
					. "or upper(status.name) like upper('%$str%')"
					. "or cast(id_company as char(100)) =  '$str' ";
			}
            $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->company
			->select("count(*) as cuenta")
			->where("$where")
			->join("status","LEFT JOIN status on status.id_status = company.status")	
			->fetch();
			return $q['cuenta']; 			
		}
		public function getCompanyById($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->company
			->select("*, DATE_FORMAT(date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->where("id_company=?",$values['id_company'])->fetch();
                        return $q; 				
			
		}
		function deleteCompany($id_company){
			unset($values['action']);
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->company("id_company", $id_company)->delete();
			
			
		}		
		function saveCompany($values){
			unset($values['action'],$values['PHPSESSID'],$values['id_company']);
                        $values['date_created'] = new NotORM_Literal("NOW()");
                        $values['date_updated'] = new NotORM_Literal("NOW()");
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->company()->insert($values);
			$values['id_company'] = $ConnectionORM->getConnect()->company()->insert_id();
			return $values;	
			
		}
		function updateCompany($values){
			unset($values['action'],$values['PHPSESSID'],$values['errors']);
                        unset($values['date_created']);
			$id_company = $values['id_company'];
                        $values['date_updated'] = new NotORM_Literal("NOW()");
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->company("id_company", $id_company)->update($values);
			return $q;
			
		}
		public function getListCompany($values = null){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->company
			->select("*")
			->where("status=?",1)
			->order('description');
			return $q; 	
			
			
		}
		public function getExistRif($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->company
			->select("count(*) as cuenta")
			->where("rif=?",$values['rif'])->fetch();
            return $q['cuenta']; 				
			
		}
		public function getExistRifUpdate($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->company
			->select("count(*) as cuenta")
			->where("rif=?",$values['rif'])
			->and('id_company<>?',$values['id_company'])
			->fetch();
            return $q['cuenta']; 				
			
		}
	}
	
