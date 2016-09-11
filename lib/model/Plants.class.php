<?php

	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */

	/**
	 * Description of Plants
	 *
	 * @author marcos
	 */
	class Plants {
		
		public function __construct() 
		{
			
		}
		public function getPlantsList($values)
		{	
			$columns = array();
			$columns[0] = 'id_plant';
			$columns[1] = 'plants.name';
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
				$where = "upper(plants.name) like upper('%$str%')"
					. "or upper(rif) like upper('%$str%')"
					. "or upper(status.name) like upper('%$str%')"
					. "or cast(id_plant as char(100)) =  '$str' ";
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
			$q = $ConnectionORM->getConnect()->plants
			->select("*,plants.name as name, DATE_FORMAT(plants.date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(plants.date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->order("$column_order $order")
			->join("status","LEFT JOIN status on status.id_status = plants.status")	
			->where("$where")
			->limit($limit,$offset);
			return $q; 			
		}
		public function getCountPlantsList($values)
		{	
			$where = '1 = 1';
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = "upper(plants.name) like upper('%$str%')"
					. "or upper(rif) like upper('%$str%')"
					. "or upper(status.name) like upper('%$str%')"
					. "or cast(id_plant as char(100)) =  '$str' ";
			}
            $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->plants
			->select("count(*) as cuenta")
			->where("$where")
			->join("status","LEFT JOIN status on status.id_status = plants.status")	
			->fetch();
			return $q['cuenta']; 			
		}
		public function getPlantsById($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->plants
			->select("*, DATE_FORMAT(date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->where("id_plant=?",$values['id_plant'])->fetch();
                        return $q; 				
			
		}
		function deletePlants($id_plant){
			unset($values['action']);
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->plants("id_plant", $id_plant)->delete();
			
			
		}		
		function savePlants($values){
			unset($values['action'],$values['PHPSESSID'],$values['errors'],$values['id_plant']);
                        $values['date_created'] = new NotORM_Literal("NOW()");
                        $values['date_updated'] = new NotORM_Literal("NOW()");
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->plants()->insert($values);
			$values['id_plant'] = $ConnectionORM->getConnect()->plants()->insert_id();
			return $values;	
			
		}
		function updatePlants($values){
			unset($values['action'],$values['PHPSESSID'],$values['errors']);
                        unset($values['date_created']);
			$id_plant = $values['id_plant'];
                        $values['date_updated'] = new NotORM_Literal("NOW()");
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->plants("id_plant", $id_plant)->update($values);
			return $q;
			
		}
		public function getPlantsListSelect($values = null){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->plants
			->select("*, DATE_FORMAT(date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->where("status=?",1);
            return $q; 				
			
		}
		public function getExistRif($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->plants
			->select("count(*) as cuenta")
			->where("rif=?",$values['rif'])->fetch();
            return $q['cuenta']; 				
			
		}
		public function getExistRifUpdate($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->plants
			->select("count(*) as cuenta")
			->where("rif=?",$values['rif'])
			->and('id_plant<>?',$values['id_plant'])
			->fetch();
            return $q['cuenta']; 				
			
		}		
	}
	
