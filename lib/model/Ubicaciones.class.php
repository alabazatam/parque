<?php

	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */

	/**
	 * Description of Espacios
	 *
	 * @author marcos
	 */
	class Ubicaciones {
		
		public function __construct() 
		{
			
		}

		public function getUbicacionesList(){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->ubicaciones
			->select("*")
            ->where('status=?',1);	
			return $q;
			
		}
		public function getUbicacionesList2($values)
		{	
			$columns = array();
			$columns[0] = 'id_ubicacion';
			$columns[1] = 'nom_ubicacion';
			$columns[2] = 'status';
			$column_order = $columns[0];
			$where = '1 = 1';
			$order = 'asc';
			$limit = $values['length'];
			$offset = $values['start'];
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = "upper(nom_ubicacion) like upper('%$str%')"
					. "or upper(status.name) like upper('%$str%') "
					. "or cast(id_ubicacion as char(100)) =  '$str' ";;
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
			$q = $ConnectionORM->getConnect()->ubicaciones
			->select("*")
			->join("status","LEFT JOIN status on status.id_status = ubicaciones.status")
			->order("$column_order $order")
			->where("$where")
			->limit($limit,$offset);
			return $q; 			
		}
		public function getCountUbicacionesList($values)
		{	
			$where = '1 = 1';
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = "upper(nom_ubicacion) like upper('%$str%')"
					. "or upper(status.name) like upper('%$str%') "
					. "or cast(id_ubicacion as char(100)) =  '$str' ";;
			}
            $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->ubicaciones
			->select("count(*) as cuenta")
			->join("status","LEFT JOIN status on status.id_status = ubicaciones.status")
			->where("$where")
			->fetch();
			return $q['cuenta']; 			
		}
		public function getUbicacionesById($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->ubicaciones
			->select("*")
			->where("id_ubicacion=?",$values['id_ubicacion'])->fetch();
			return $q; 				
			
		}
		function deleteUbicaciones($id_ubicacion){
			unset($values['action'],$values['PHPSESSID']);
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->ubicaciones("id_ubicacion", $id_ubicacion)->delete();
			
			
		}		
		function saveUbicaciones($values){
			unset($values['action'],$values['PHPSESSID'],$values['id_ubicacion'],$values['date_created'],$values['date_updated']);
            $values['date_created'] = new NotORM_Literal("NOW()");
            $values['date_updated'] = new NotORM_Literal("NOW()");
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->ubicaciones()->insert($values);
			$values['id_ubicacion'] = $ConnectionORM->getConn()->lastInsertId('ubicaciones_id_ubicacion_seq');
			//echo $values['id_ubicacion'];
			return $values;	
			
		}
		function updateUbicaciones($values){
			unset($values['action'],$values['PHPSESSID'],$values['date_created']);
			$values['date_updated'] = new NotORM_Literal("NOW()");
			$id_ubicacion = $values['id_ubicacion'];
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->ubicaciones("id_ubicacion", $id_ubicacion)->update($values);
			//return $q;
			
		}
		public function getUbicacionesListSelect($values = null){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->ubicaciones
			->select("*")
			->where("status=?",1);
			return $q; 				
			
		}

	}