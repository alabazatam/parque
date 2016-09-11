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
	class BanksTablesId{
		
		public function __construct() 
		{
			
		}
			
		function saveBanksTablesId($values){
			unset($values['action']);
			$values['date_created'] = new NotORM_Literal("NOW()");
			$values['date_updated'] = new NotORM_Literal("NOW()");
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->banks_tables_id()->insert($values);
			return $values;	
		}
		public function getBanksTablesId($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->banks_tables_id
			->select("*")
			->join("bank","LEFT JOIN bank on bank.id_bank = banks_tables_id.id_bank")
			->where("banks_tables_id.id_table=?",$values['id_table'])
			->and('id_primary=?',$values['id_primary'])
			->and('banks_tables_id.status=?',1);
			return $q; 				
			
		}
		public function getCountBanksTablesId($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->banks_tables_id
			->select("*")
			->join("bank","LEFT JOIN bank on bank.id_bank = banks_tables_id.id_bank")
			->where("banks_tables_id.id_table=?",$values['id_table'])
			->and('id_primary=?',$values['id_primary'])
			->and('bank.id_bank=?',$values['id_bank']);
			return $q; 				
			
		}
		function deleteBanksTablesId($values){
			unset($values['action'],$values['PHPSESSID'],$values['date_created']);
			$values['date_updated'] = new NotORM_Literal("NOW()");
			$ConnectionORM = new ConnectionORM();
			
			$q = $ConnectionORM->getConnect()->banks_tables_id
			->select("*")
			->where("id_table=?",$values['id_table'])
			->and('id_primary=?',$values['id_primary'])
			->and('id_bank=?',$values['id_bank'])->fetch();			
			$id = $q['id'];
			$q = $ConnectionORM->getConnect()->banks_tables_id("id",$id)->update($values);
			return $q;
			
		}
		function updateIncoterms($values){
			unset($values['action'],$values['PHPSESSID'],$values['date_created']);
			$values['date_updated'] = new NotORM_Literal("NOW()");
			$id_incoterm = $values['id_incoterm'];
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->incoterms("id_incoterm", $id_incoterm)->update($values);
			return $q;
			
		}
		
		public function getListBanksTablesId($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->banks_tables_id
			->select("*")
			->where("banks_tables_id.status=?",1);
			return $q; 				
			
		}
	}
	