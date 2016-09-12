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
	class Espacios {
		
		public function __construct() 
		{
			
		}
		public function getEspaciosList($values)
		{	
			$columns = array();
			$columns[0] = 'id_espacio';
			$columns[1] = 'nom_espacio';
			$columns[2] = 'des_espacio';
			$columns[3] = 'capacidad';
            $columns[4] = 'ut';
            $columns[5] = 'tipo_espacio.nom_tipo_espacio';
			$columns[6] = 'zona_ubicacion.des_zona_ubicacion';
			$columns[7] = 'espacios.status';
			$column_order = $columns[0];
			$where = '1 = 1';
			$order = 'asc';
			$limit = $values['length'];
			$offset = $values['start'];
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = "upper(login) like upper('%$str%')"
					. "or upper(status.name) like upper('%$str%') ";
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
			$q = $ConnectionORM->getConnect()->espacios
			->select("*")
			->join("status","LEFT JOIN status on status.id_status = espacios.status")
			->join("zona_ubicacion","LEFT JOIN zona_ubicacion on zona_ubicacion.id_zona_ubicacion = espacios.id_zona_ubicacion")
			->join("tipo_espacio","LEFT JOIN tipo_espacio on tipo_espacio.id_tipo_espacio = espacios.id_tipo_espacio")
			->order("$column_order $order")
			->where("$where")
			->limit($limit,$offset);
			return $q; 			
		}
		public function getCountEspaciosList($values)
		{	
			$where = '1 = 1';
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = "upper(login) like upper('%$str%') "
					. "or upper(status.name) like upper('%$str%') ";
			}
            $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->espacios
			->select("count(*) as cuenta")
			->join("status","LEFT JOIN status on status.id_status = espacios.status")
			->where("$where")
			->fetch();
			return $q['cuenta']; 			
		}
		public function getEspaciosById($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->espacios
			->select("*")
			->where("id_espacio=?",$values['id_espacio'])->fetch();
			return $q; 				
			
		}
		function deleteEspacios($id_espacio){
			unset($values['action'],$values['PHPSESSID']);
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->espacios("id_espacio", $id_espacio)->delete();
			
			
		}		
		function saveEspacios($values){
			unset($values['action'],$values['PHPSESSID'],$values['id_espacio']);
                        $values['date_created'] = new NotORM_Literal("NOW()");
                        $values['date_updated'] = new NotORM_Literal("NOW()");
			$values['precio'] = 0;
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->espacios()->insert($values);
			$values['id_espacio'] = $ConnectionORM->getConn()->lastInsertId('kioskos_id_espacio_seq');
			return $values;	
			
		}
		function updateEspacios($values){
			unset($values['action'],$values['PHPSESSID'],$values['date_created']);
                        $values['date_updated'] = new NotORM_Literal("NOW()");
			if(isset($values['password']) and $values['password']!='')
			{
				$values['password'] = hash('sha256', $values['password']);
			}else
			{
				unset($values['password']);
			}
			$id_espacio = $values['id_espacio'];
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->espacios("id_espacio", $id_espacio)->update($values);
			return $q;
			
		}
	}

