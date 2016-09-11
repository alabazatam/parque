<?php

	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */

	/**
	 * Description of Clients
	 *
	 * @author marcos
	 */
	class Clients {
		
		public function __construct() 
		{
			
		}
		public function getClientsList($values)
		{	
			$columns = array();
			$columns[0] = 'id_client';
			$columns[1] = 'clients.name';
			$columns[2] = 'rif';
                        $columns[3] = 'contact1';
                        $columns[4] = 'phone1';
                        $columns[5] = 'email1';
			$columns[6] = 'status.name';
			$column_order = $columns[0];
			$where = '1 = 1';
			$order = 'asc';
			$limit = $values['length'];
			$offset = $values['start'];
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = "upper(clients.name) like upper('%$str%')"
					. "or upper(rif) like upper('%$str%')"
					. "or upper(status.name) like upper('%$str%')"
					. "or cast(id_client as char(100)) =  '$str' ";
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
			$q = $ConnectionORM->getConnect()->clients
			->select("*,clients.name as name, DATE_FORMAT(clients.date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(clients.date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->order("$column_order $order")
			->join("status","LEFT JOIN status on status.id_status = clients.status")	
			->where("$where")
			->limit($limit,$offset);
			return $q; 			
		}
		public function getCountClientsList($values)
		{	
			$where = '1 = 1';
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = "upper(clients.name) like upper('%$str%')"
					. "or upper(rif) like upper('%$str%')"
					. "or upper(status.name) like upper('%$str%')"
					. "or cast(id_client as char(100)) =  '$str' ";
			}
            $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->clients
			->select("count(*) as cuenta")
			->where("$where")
			->join("status","LEFT JOIN status on status.id_status = clients.status")	
			->fetch();
			return $q['cuenta']; 			
		}
		public function getClientsById($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->clients
			->select("*, DATE_FORMAT(date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->where("id_client=?",$values['id_client'])->fetch();
                        return $q; 				
			
		}
		function deleteClients($id_client){
			unset($values['action']);
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->clients("id_client", $id_client)->delete();
			
			
		}		
		function saveClients($values){
			unset($values['action'],$values['PHPSESSID'],$values['errors'],$values['id_client']);
                        $values['date_created'] = new NotORM_Literal("NOW()");
                        $values['date_updated'] = new NotORM_Literal("NOW()");
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->clients()->insert($values);
			$values['id_client'] = $ConnectionORM->getConnect()->clients()->insert_id();
			return $values;	
			
		}
		function updateClients($values){
			unset($values['action'],$values['PHPSESSID'],$values['errors']);
                        unset($values['date_created']);
			$id_client = $values['id_client'];
                        $values['date_updated'] = new NotORM_Literal("NOW()");
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->clients("id_client", $id_client)->update($values);
			return $q;
			
		}
		public function getListClients($values = null){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->clients
			->select("*")
			->where("status=?",1)
			->order('name');
			return $q; 				
			
		}
		public function getExistRif($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->clients
			->select("count(*) as cuenta")
			->where("rif=?",$values['rif'])->fetch();
                        return $q['cuenta']; 				
			
		}
		public function getExistRifUpdate($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->clients
			->select("count(*) as cuenta")
			->where("rif=?",$values['rif'])
			->and('id_client<>?',$values['id_client'])
			->fetch();
            return $q['cuenta']; 				
			
		}
	}
	