<?php

	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */

	/**
	 * Description of TipoEspacio
	 *
	 * @author marcos
	 */
	class TipoEspacio {
		
		public function __construct() 
		{
			
		}
		public function getTipoEspacioList($values)
		{	
			$columns = array();
			$columns[0] = 'id_tipo_espacio';
			$columns[1] = 'nom_tipo_espacio';
			$columns[2] = 'status';
			$column_order = $columns[0];
			$where = '1 = 1';
			$order = 'asc';
			$limit = $values['length'];
			$offset = $values['start'];
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = "upper(nom_tipo_espacio) like upper('%$str%')"
					. "or upper(status.name) like upper('%$str%') "
					. "or cast(tipo_espacio.id_tipo_espacio as char(100)) =  '$str' ";;
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
			$q = $ConnectionORM->getConnect()->tipo_espacio
			->select("*")
			->join("status","LEFT JOIN status on status.id_status = tipo_espacio.status")
			->order("$column_order $order")
			->where("$where")
			->limit($limit,$offset);
			return $q; 			
		}
		public function getCountTipoEspacioList($values)
		{	
			$where = '1 = 1';
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = "upper(nom_tipo_espacio) like upper('%$str%')"
					. "or upper(status.name) like upper('%$str%') "
					. "or cast(tipo_espacio.id_tipo_espacio as char(100)) =  '$str' ";;
			}
            $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->tipo_espacio
			->select("count(*) as cuenta")
			->join("status","LEFT JOIN status on status.id_status = tipo_espacio.status")
			->where("$where")
			->fetch();
			return $q['cuenta']; 			
		}
		public function getTipoEspacioById($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->tipo_espacio
			->select("*")
			->where("id_tipo_espacio=?",$values['id_tipo_espacio'])->fetch();
			return $q; 				
			
		}
		function deleteTipoEspacio($id_tipo_espacio){
			unset($values['action'],$values['PHPSESSID']);
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->tipo_espacio("id_tipo_espacio", $id_tipo_espacio)->delete();
			
			
		}		
		function saveTipoEspacio($values){
			unset($values['action'],$values['PHPSESSID'],$values['id_tipo_espacio'],$values['date_created'],$values['date_updated']);
            $values['date_created'] = new NotORM_Literal("NOW()");
            $values['date_updated'] = new NotORM_Literal("NOW()");
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->tipo_espacio()->insert($values);
			$values['id_tipo_espacio'] = $ConnectionORM->getConn()->lastInsertId('tipo_espacio_id_tipo_espacio_seq');
			//echo $values['id_tipo_espacio'];
			return $values;	
			
		}
		function updateTipoEspacio($values){
			unset($values['action'],$values['PHPSESSID'],$values['date_created']);
			$values['date_updated'] = new NotORM_Literal("NOW()");
			$id_tipo_espacio = $values['id_tipo_espacio'];
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->tipo_espacio("id_tipo_espacio", $id_tipo_espacio)->update($values);
			//return $q;
			
		}
		public function getZonaUbicacionListSelect($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->tipo_espacio
			->select("*")
			->where("status=?",1);
			return $q; 				
			
		}
		public function getTipoEspacioListSelect($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->tipo_espacio
			->select("*")
			->where("status=?",1);
			return $q; 				
			
		}
	}

