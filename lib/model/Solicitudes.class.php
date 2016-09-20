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
	class Solicitudes {
		
		public function __construct() 
		{
			
		}
		public function getSolicitudesFunList($values)
		{	
			$columns = array();
			$columns[0] = 'id_solicitud';
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
			$q = $ConnectionORM->getConnect()->solicitudes
			->select("*,zona_ubicacion.*,tipo_espacio.*,status.name as status,TO_CHAR(solicitudes.fec_reservacion, 'dd/mm/YY') as fec_reservacion, TO_CHAR(solicitudes.date_created, 'dd/mm/YY') as fec_solicitud ")
			->join("espacios","LEFT JOIN espacios on espacios.id_espacio = solicitudes.id_espacio")
			->join("status","LEFT JOIN status on status.id_status = solicitudes.status")
			->join("zona_ubicacion","LEFT JOIN zona_ubicacion on zona_ubicacion.id_zona_ubicacion = solicitudes.id_zona_ubicacion")
			->join("tipo_espacio","LEFT JOIN tipo_espacio on tipo_espacio.id_tipo_espacio = solicitudes.id_tipo_espacio")
			->order("$column_order $order")
			->where("$where")
			->limit($limit,$offset);
			return $q; 			
		}
		public function getCountSolicitudesFunList($values)
		{	
			$where = '1 = 1';
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = "upper(login) like upper('%$str%') "
					. "or upper(status.name) like upper('%$str%') ";
			}
            $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->solicitudes
			->select("count(*) as cuenta")
			->join("espacios","LEFT JOIN espacios on espacios.id_espacio = solicitudes.id_espacio")
			->join("status","LEFT JOIN status on status.id_status = solicitudes.status")
			->join("zona_ubicacion","LEFT JOIN zona_ubicacion on zona_ubicacion.id_zona_ubicacion = solicitudes.id_zona_ubicacion")
			->join("tipo_espacio","LEFT JOIN tipo_espacio on tipo_espacio.id_tipo_espacio = solicitudes.id_tipo_espacio")
			->join("status","LEFT JOIN status on status.id_status = espacios.status")
			->where("$where")
			->fetch();
			//echo $q['cuenta']."aaa";die;
			return $q['cuenta']; 			
		}
		public function getDisponibilidadEspacioById($id_espacio,$fec_reservacion){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->solicitudes
			->select("count(*) as cuenta")
			->where("id_espacio=?",$id_espacio)
			->and('fec_reservacion=?',$fec_reservacion)
			->and('id_user=?',$_SESSION['id_user'])
			->fetch();
			return $q['cuenta']; 				
			
		}
		function saveEspacios($values){
			
			$Espacios = new Espacios();
			$data_espacios = $Espacios->getEspaciosDescripcionById($values);
			$UT= new UT();
			$valor_ut = $UT->getValorUT();
			$costo = $valor_ut * $data_espacios['ut'];
			
			
			$fecha_creacion = date(gmdate('Y-m-d H:i:s', time() - (4 * 3600)));
			$status = 1;
			$array_solicitud = array(
				"id_espacio" => $values['id_espacio'],
				"id_zona_ubicacion" => $data_espacios['id_zona_ubicacion'],
				"id_tipo_espacio" => $data_espacios['id_tipo_espacio'],
				"id_user" => $_SESSION['id_user'],
				"fec_reservacion" => $values['fec_reservacion'],
				"status" => $status,
				"costo" => $costo,
				"valor_ut" => $valor_ut,
				"cant_ut" => $data_espacios['ut'],
				"date_created" => $fecha_creacion,
				"date_updated" => $fecha_creacion,
				
			);
			
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->solicitudes()->insert($array_solicitud);			

			$values['id_solicitud'] = $ConnectionORM->getConn()->lastInsertId('solicitudes_id_solicitud_seq');

			$movimiento_solicitud = array(
				"id_solicitud" => $values['id_solicitud'],
				"status" => $status,
				"date_created" => $fecha_creacion,
				"id_user" => $_SESSION['id_user'],
				
			);
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->solicitudes_movimientos()->insert($movimiento_solicitud);				

			
			return $values;	
			
		}

	}

