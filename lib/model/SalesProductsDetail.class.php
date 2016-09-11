<?php

	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */

	/**
	 * Description of SalesProductsDetail
	 *
	 * @author marcos
	 */
	class SalesProductsDetail{
		
		public function __construct() 
		{
			
		}
		public function getSalesListProductsDetailBySale($id_sale){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->sales_products_detail
			->select("*, DATE_FORMAT(date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->where("id_sale=?",$id_sale);
			return $q; 				
			
		}		
		
		public function getSalesProductsDetailById($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->sales_products_detail
			->select("*, DATE_FORMAT(date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->where("id_sale=?",$values['id_sale'])->fetch();
			return $q; 				
			
		}
		function deleteSalesProductsDetail($id){
			
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->sales_products_detail("id", $id)->delete();
			
			
		}		
		function saveSalesProductsDetail($values){
			unset($values['action']);
			$values['date_created'] = new NotORM_Literal("NOW()");
			$values['date_updated'] = new NotORM_Literal("NOW()");
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->sales_products_detail()->insert($values);
			$values['id'] = $ConnectionORM->getConnect()->SalesProductsDetail()->insert_id();
			return $values['id'];	
			
		}
		function updateSalesProductsDetail($values){
			unset($values['action'],$values['PHPSESSID'],$values['column_id']);
			$values['date_updated'] = new NotORM_Literal("NOW()");
			$id = $values['id'];
			$column_name = $values['column_name'];
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->sales_products_detail("id", $id)->update(array($column_name=>$values['value']));
			return $q;
			
		}
		public function getListSalesProductsDetail($values = null){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->sales_products_detail
			->select("*")
			->where("status=?",1)
			->order('name');
			return $q; 				
			
		}
	}
	