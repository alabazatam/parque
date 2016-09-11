<?php

	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */

	/**
	 * Description of CompanyBanksDetail
	 *
	 * @author marcos
	 */
	class CompanyBanksDetail{
		
		public function __construct() 
		{
			
		}
		public function getCompanyListBanksDetailByCompany($id_company){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->company_banks_detail
			->select("*, DATE_FORMAT(date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->where("id_company=?",$id_company);
			return $q; 				
			
		}		
		
		public function getCompanyBanksDetailById($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->company_banks_detail
			->select("*, DATE_FORMAT(date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->where("id_sale=?",$values['id_sale'])->fetch();
			return $q; 				
			
		}
		function deleteCompanyBanksDetail($id){
			
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->company_banks_detail("id", $id)->delete();
			
			
		}		
		function saveCompanyBanksDetail($values){
			unset($values['action']);
			$values['date_created'] = new NotORM_Literal("NOW()");
			$values['date_updated'] = new NotORM_Literal("NOW()");
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->company_banks_detail()->insert($values);
			$values['id'] = $ConnectionORM->getConnect()->CompanyBanksDetail()->insert_id();
			return $values['id'];	
			
		}
		function updateCompanyBanksDetail($values){
			unset($values['action'],$values['PHPSESSID'],$values['column_id']);
			$values['date_updated'] = new NotORM_Literal("NOW()");
			$id = $values['id'];
			$column_name = $values['column_name'];
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->company_banks_detail("id", $id)->update(array($column_name=>$values['value']));
			return $q;
			
		}
		public function getListCompanyBanksDetail($values = null){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->company_banks_detail
			->select("*")
			->where("status=?",1)
			->order('name');
			return $q; 				
			
		}
		public function getListPortsByCompany($values = null){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->company_banks_detail
			->select("*")
			->where("status=?",1)
			->and('id_company=?',$values['id_company'])
			->order('bank_name');			
			
			return $q; 				
			
		}
		public function getListCompanyBankBySale($values = null){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->sales
			->select("*,sales.id_company_bank")
			->where('id_sale=?',$values['id_sale'])
			->fetch();
			return $q; 				
			
		}		
		
		
	}
	