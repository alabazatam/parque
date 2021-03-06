<?php

	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */

	/**
	 * Description of ZonaUbicacion
	 *
	 * @author marcos
	 */
	class ZonaUbicacion {
		
		public function __construct() 
		{
			
		}
		public function getZonaUbicacionList($values)
		{	
			$columns = array();
			$columns[0] = 'id_zona_ubicacion';
			$columns[1] = 'des_zona_ubicacion';
			$columns[2] = 'zona_ubicacion.status';
			$column_order = $columns[0];
			$where = '1 = 1';
			$order = 'asc';
			$limit = $values['length'];
			$offset = $values['start'];
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = "upper(des_zona_ubicacion) like upper('%$str%')"
					. "or upper(status.name) like upper('%$str%') "
					. "or cast(zona_ubicacion.id_zona_ubicacion as char(100)) =  '$str' ";;
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
			$q = $ConnectionORM->getConnect()->zona_ubicacion
			->select("*,zona_ubicacion.status as status")
			->join("status","LEFT JOIN status on status.id_status = zona_ubicacion.status")
			->order("$column_order $order")
			->where("$where")
			->limit($limit,$offset);
			return $q; 			
		}
		public function getCountZonaUbicacionList($values)
		{	
			$where = '1 = 1';
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = "upper(des_zona_ubicacion) like upper('%$str%')"
					. "or upper(status.name) like upper('%$str%') "
					. "or cast(zona_ubicacion.id_zona_ubicacion as char(100)) =  '$str' ";;
			}
            $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->zona_ubicacion
			->select("count(*) as cuenta")
			->join("status","LEFT JOIN status on status.id_status = zona_ubicacion.status")
			->where("$where")
			->fetch();
			return $q['cuenta']; 			
		}
		public function getZonaUbicacionById($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->zona_ubicacion
			->select("*")
			->where("id_zona_ubicacion=?",$values['id_zona_ubicacion'])->fetch();
			return $q; 				
			
		}
		function deleteZonaUbicacion($id_zona_ubicacion){
			unset($values['action'],$values['PHPSESSID']);
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->zona_ubicacion("id_zona_ubicacion", $id_zona_ubicacion)->delete();
			
			
		}		
		function saveZonaUbicacion($values){
			unset($values['action'],$values['PHPSESSID'],$values['id_zona_ubicacion'],$values['date_created'],$values['date_updated']);
            $values['date_created'] = new NotORM_Literal("NOW()");
            $values['date_updated'] = new NotORM_Literal("NOW()");
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->zona_ubicacion()->insert($values);
			$values['id_zona_ubicacion'] = $ConnectionORM->getConn()->lastInsertId('zona_ubicacion_id_zona_ubicacion_seq');
			//echo $values['id_zona_ubicacion'];
			return $values;	
			
		}
		function updateZonaUbicacion($values){
			unset($values['action'],$values['PHPSESSID'],$values['date_created']);
			$values['date_updated'] = new NotORM_Literal("NOW()");
			$id_zona_ubicacion = $values['id_zona_ubicacion'];
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->zona_ubicacion("id_zona_ubicacion", $id_zona_ubicacion)->update($values);
			//return $q;
			
		}
		public function getZonaUbicacionListSelect($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->zona_ubicacion
			->select("*")
			->where("status=?",1);
			return $q; 				
			
		}
	}

