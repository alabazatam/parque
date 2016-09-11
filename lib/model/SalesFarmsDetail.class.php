<?php

	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */

	/**
	 * Description of SalesFarmsDetail
	 *
	 * @author marcos
	 */
	class SalesFarmsDetail{
		
		public function __construct() 
		{
			
		}
		public function getSalesListFarmsDetailBySale($id_sale){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->sales_farms_detail
			->select("*, DATE_FORMAT(date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->where("id_sale=?",$id_sale);
			return $q; 				
			
		}		
		
		public function getSalesFarmsDetailById($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->sales_farms_detail
			->select("*, DATE_FORMAT(date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->where("id_sale=?",$values['id_sale'])->fetch();
			return $q; 				
			
		}
		function deleteSalesFarmsDetail($id){
			
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->sales_farms_detail("id", $id)->delete();
			
			
		}		
		function saveSalesFarmsDetail($values){
			unset($values['action']);
			$values['date_created'] = new NotORM_Literal("NOW()");
			$values['date_updated'] = new NotORM_Literal("NOW()");
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->sales_farms_detail()->insert($values);
			$values['id'] = $ConnectionORM->getConnect()->SalesFarmsDetail()->insert_id();
			return $values['id'];	
			
		}
		function updateSalesFarmsDetail($values){
			unset($values['action'],$values['PHPSESSID'],$values['column_id']);
			$values['date_updated'] = new NotORM_Literal("NOW()");
			$id = $values['id'];
			$column_name = $values['column_name'];
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->sales_farms_detail("id", $id)->update(array($column_name=>$values['value']));
			return $q;
			
		}
		public function getListSalesFarmsDetail($values = null){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->sales_farms_detail
			->select("*")
			->where("status=?",1)
			->order('name');
			return $q; 				
			
		}
	}
	