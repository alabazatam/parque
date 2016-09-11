<?php

	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */

	/**
	 * Description of FarmsBanksDetail
	 *
	 * @author marcos
	 */
	class FarmsBanksDetail{
		
		public function __construct() 
		{
			
		}
		public function getFarmsListBanksDetailByFarms($id_farm){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->farms_banks_detail
			->select("*, DATE_FORMAT(date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->where("id_farm=?",$id_farm);
			return $q; 				
			
		}		
		
		public function getFarmsBanksDetailById($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->farms_banks_detail
			->select("*, DATE_FORMAT(date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->where("id_farm=?",$values['id_farm'])->fetch();
			return $q; 				
			
		}
		function deleteFarmsBanksDetail($id){
			
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->farms_banks_detail("id", $id)->delete();
			
			
		}		
		function saveFarmsBanksDetail($values){
			unset($values['action']);
			$values['date_created'] = new NotORM_Literal("NOW()");
			$values['date_updated'] = new NotORM_Literal("NOW()");
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->farms_banks_detail()->insert($values);
			$values['id'] = $ConnectionORM->getConnect()->FarmsBanksDetail()->insert_id();
			return $values['id'];	
			
		}
		function updateFarmsBanksDetail($values){
			unset($values['action'],$values['PHPSESSID'],$values['column_id']);
			$values['date_updated'] = new NotORM_Literal("NOW()");
			$id = $values['id'];
			$column_name = $values['column_name'];
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->farms_banks_detail("id", $id)->update(array($column_name=>$values['value']));
			return $q;
			
		}
		public function getListFarmsBanksDetail($values = null){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->farms_banks_detail
			->select("*")
			->where("status=?",1)
			->order('name');
			return $q; 				
			
		}
	}
	