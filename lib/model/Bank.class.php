<?php

	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */

	/**
	 * Description of Bank
	 *
	 * @author marcos
	 */
	class Bank{
		
		public function __construct() 
		{
			
		}
		public function getBankList($values)
		{	
			$columns = array();
			$columns[0] = 'id_bank';
			$columns[1] = 'bank.name';
			$columns[2] = 'aba';
			$columns[3] = 'swif';
			$columns[4] = 'status.name';
			$columns[5] = 'date_created';
			$columns[6] = 'date_updated';
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
                                        . "or upper(bank.name) like upper('%$str%')"
										. "or upper(bank.swif) like upper('%$str%')"
										. "or upper(bank.aba) like upper('%$str%')"
                                        . "or cast(id_bank as char(100)) =  '$str' ";
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
			$q = $ConnectionORM->getConnect()->bank()
			->select("bank.*,DATE_FORMAT(bank.date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(bank.date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->join("status","LEFT JOIN status on status.id_status = bank.status")
            ->where("$where")
            ->order("$column_order $order")
			->limit($limit,$offset);

			return $q; 			
		}
		public function getCountBankList($values)
		{	
			$where = '1 = 1';
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = ""
                                        . "upper(status.name) like upper('%$str%') "
                                        . "or upper(bank.name) like upper('%$str%')"
										. "or upper(bank.swif) like upper('%$str%')"
										. "or upper(bank.aba) like upper('%$str%')"
                                        . "or cast(id_bank as char(100)) =  '$str' ";
			}
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->bank
			->select("count(*) as cuenta")
			->where("$where")
			->join("status","LEFT JOIN status on status.id_status = bank.status")	
			->fetch();
			return $q['cuenta']; 			
		}
		public function getBankById($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->bank
			->select("*, DATE_FORMAT(date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->where("id_bank=?",$values['id_bank'])->fetch();
			return $q; 				
			
		}
		function deleteBank($id){
			unset($values['action']);
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->bank("id", $id)->delete();
			
			
		}		
		function saveBank($values){
			unset($values['action']);
			$values['date_created'] = new NotORM_Literal("NOW()");
			$values['date_updated'] = new NotORM_Literal("NOW()");
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->bank()->insert($values);
			$values['id_bank'] = $ConnectionORM->getConnect()->Bank()->insert_id();
			return $values;	
			
		}
		function updateBank($values){
			unset($values['action'],$values['PHPSESSID'],$values['date_created']);
			$values['date_updated'] = new NotORM_Literal("NOW()");
			$id_bank = $values['id_bank'];
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->bank("id_bank", $id_bank)->update($values);
			return $q;
			
		}
		public function getBankByIdTable($values){
			$id_primary = $values['id_primary'];
			$id_table = $values['id_table'];
			//$id_bank = $values['id_bank'];
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->bank
			->select("*")
			->where("bank.id_bank not in(select id_bank from banks_tables_id where id_primary = $id_primary and id_table = $id_table and status = 1 )")
			->and("bank.id_table=?",$values['id_table']);	
			return $q; 				
			
		}
		
	}
	