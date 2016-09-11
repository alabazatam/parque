<?php

	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */

	/**
	 * Description of BrokersBanksDetail
	 *
	 * @author marcos
	 */
	class BrokersBanksDetail{
		
		public function __construct() 
		{
			
		}
		public function getBrokersListBanksDetailByBrokers($id_broker){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->brokers_banks_detail
			->select("*, DATE_FORMAT(date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->where("id_broker=?",$id_broker);
			return $q; 				
			
		}		
		
		public function getBrokersBanksDetailById($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->brokers_banks_detail
			->select("*, DATE_FORMAT(date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->where("id_broker=?",$values['id_broker'])->fetch();
			return $q; 				
			
		}
		function deleteBrokersBanksDetail($id){
			
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->brokers_banks_detail("id", $id)->delete();
			
			
		}		
		function saveBrokersBanksDetail($values){
			unset($values['action']);
			$values['date_created'] = new NotORM_Literal("NOW()");
			$values['date_updated'] = new NotORM_Literal("NOW()");
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->brokers_banks_detail()->insert($values);
			$values['id'] = $ConnectionORM->getConnect()->BrokersBanksDetail()->insert_id();
			return $values['id'];	
			
		}
		function updateBrokersBanksDetail($values){
			unset($values['action'],$values['PHPSESSID'],$values['column_id']);
			$values['date_updated'] = new NotORM_Literal("NOW()");
			$id = $values['id'];
			$column_name = $values['column_name'];
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->brokers_banks_detail("id", $id)->update(array($column_name=>$values['value']));
			return $q;
			
		}
		public function getListBrokersBanksDetail($values = null){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->brokers_banks_detail
			->select("*")
			->where("status=?",1)
			->order('name');
			return $q; 				
			
		}
	}
	