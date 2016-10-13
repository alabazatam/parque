<?php

	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */

	/**
	 * Description of Caracteristicas
	 *
	 * @author marcos
	 */
	class Caracteristicas {
		
		public function __construct() 
		{
			
		}
		public function getCaracteristicasList($values)
		{	
			$columns = array();
			$columns[0] = 'id_caracteristica';
			$columns[1] = 'nom_caracteristica';
			$columns[2] = 'status';
			$column_order = $columns[0];
			$where = '1 = 1';
			$order = 'asc';
			$limit = $values['length'];
			$offset = $values['start'];
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = "upper(nom_caracteristica) like upper('%$str%')"
					. "or upper(status.name) like upper('%$str%') "
					. "or cast(id_caracteristica as char(100)) =  '$str' ";;
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
			$q = $ConnectionORM->getConnect()->caracteristicas
			->select("*")
			->join("status","LEFT JOIN status on status.id_status = caracteristicas.status")
			->order("$column_order $order")
			->where("$where")
			->limit($limit,$offset);
			return $q; 			
		}
		public function getCountCaracteristicasList($values)
		{	
			$where = '1 = 1';
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = "upper(nom_caracteristica) like upper('%$str%')"
					. "or upper(status.name) like upper('%$str%') "
					. "or cast(id_caracteristica as char(100)) =  '$str' ";;
			}
            $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->caracteristicas
			->select("count(*) as cuenta")
			->join("status","LEFT JOIN status on status.id_status = caracteristicas.status")
			->where("$where")
			->fetch();
			return $q['cuenta']; 			
		}
		public function getCaracteristicasById($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->caracteristicas
			->select("*")
			->where("id_caracteristica=?",$values['id_caracteristica'])->fetch();
			return $q; 				
			
		}
		function deleteCaracteristicas($id_caracteristica){
			unset($values['action'],$values['PHPSESSID']);
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->caracteristicas("id_caracteristica", $id_caracteristica)->delete();
			
			
		}		
		function saveCaracteristicas($values){
			unset($values['action'],$values['PHPSESSID'],$values['id_caracteristica'],$values['date_created'],$values['date_updated']);
            $values['date_created'] = new NotORM_Literal("NOW()");
            $values['date_updated'] = new NotORM_Literal("NOW()");
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->caracteristicas()->insert($values);
			$values['id_caracteristica'] = $ConnectionORM->getConn()->lastInsertId('caracteristicas_id_caracteristica_seq');
			//echo $values['id_caracteristica'];
			return $values;	
			
		}
		function updateCaracteristicas($values){
			unset($values['action'],$values['PHPSESSID'],$values['date_created']);
			$values['date_updated'] = new NotORM_Literal("NOW()");
			$id_caracteristica = $values['id_caracteristica'];
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->caracteristicas("id_caracteristica", $id_caracteristica)->update($values);
			//return $q;
			
		}
		public function getCaracteristicasListSelect($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->caracteristicas
			->select("*")
			->where("status=?",1)
				->order('nom_caracteristica');
			return $q; 				
			
		}
	}

