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
			$columns[2] = 'solicitudes.fec_reservacion';
			$columns[3] = 'solicitudes.date_created';
            $columns[4] = 'capacidad';
            $columns[5] = 'solicitudes.costo';
			$columns[6] = 'zona_ubicacion.des_zona_ubicacion';
			$columns[7] = 'status.name';
			$column_order = $columns[0];
			$where = '1 = 1';
			$order = 'asc';
			$limit = $values['length'];
			$offset = $values['start'];
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = "upper(nom_espacio) like upper('%$str%')"
					. "or upper(status.name) like upper('%$str%') "
					. "or upper(des_zona_ubicacion) like upper('%$str%') "
					. "or upper(nom_espacio) like upper('%$str%') "
					. "or cast(solicitudes.id_solicitud as char(100)) =  '$str' ";
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
				$where = "upper(nom_espacio) like upper('%$str%')"
					. "or upper(status.name) like upper('%$str%') "
					. "or upper(des_zona_ubicacion) like upper('%$str%') "
					. "or upper(nom_espacio) like upper('%$str%') "
					. "or cast(solicitudes.id_solicitud as char(100)) =  '$str' ";
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
                
/**/
		public function getSolicitudesAdmList($values)
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
			$where = 'status.id_status not in(7,8)';
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
		public function getCountSolicitudesAdmList($values)
		{	
			$where = 'status.id_status not in(7,8)';
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
/****************************************************************************************************************************/
		
		public function getSolicitudesReporteList($values)
		{	
			$columns = array();
			$columns[0] = 'id_solicitud';
			$columns[1] = 'nom_espacio';
            $columns[2] = 'solicitudes.fec_reservacion';
			$columns[3] = 'solicitudes.costo';
			$columns[4] = 'status.name';
			$column_order = $columns[0];
			$where = '1 = 1 ';
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
		public function getCountSolicitudesReporteList($values)
		{	
			$where = '1 = 1 ';
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
		

/********************************************************************************************************************************/		
		
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
			$status = 2;
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
				"motivo" => $values['motivo']
				
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
		public function getSolicitudById($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->solicitudes
			->select("*,zona_ubicacion.*,tipo_espacio.*,status.name as status,status.id_status,TO_CHAR(solicitudes.fec_reservacion, 'dd/mm/YY') as fec_reservacion, TO_CHAR(solicitudes.date_created, 'dd/mm/YY') as fec_solicitud,TO_CHAR(solicitudes.fec_pago, 'dd/mm/YY') as fec_pago ")
			->join("status","LEFT JOIN status on status.id_status = solicitudes.status")
			->join("espacios","LEFT JOIN espacios on espacios.id_espacio = solicitudes.id_espacio")
			->join("zona_ubicacion","LEFT JOIN zona_ubicacion on zona_ubicacion.id_zona_ubicacion = solicitudes.id_zona_ubicacion")
			->join("tipo_espacio","LEFT JOIN tipo_espacio on tipo_espacio.id_tipo_espacio = solicitudes.id_tipo_espacio")
			->join("users_data","LEFT JOIN users_data on users_data.id_user = solicitudes.id_user")
			->join("ubicaciones","LEFT JOIN ubicaciones on ubicaciones.id_ubicacion = users_data.id_ubicacion")
            ->join("motivos","LEFT JOIN motivos on motivos.des_motivo = solicitudes.motivo")
		    ->join("tipo_personal","LEFT JOIN tipo_personal on tipo_personal.des_tipo_personal = users_data.tipo_personal")
			->where("id_solicitud=?",$values['id_solicitud'])->fetch();
			return $q; 				
			
		}
		function updateSolicitud($values){
			
			$id_solicitud = $values['id_solicitud'];
			$fecha_update= date(gmdate('Y-m-d H:i:s', time() - (4 * 3600)));
			$array = array(
				
				"status" => $values['status'],
				"date_updated" =>$fecha_update,
				
			);
			if(isset($values['referencia_bancaria']) and $values['referencia_bancaria']!='')
			{
				$array['referencia_bancaria'] =  $values['referencia_bancaria'];
			}
			if(isset($values['fec_pago']) and $values['fec_pago']!='')
			{
				$array['fec_pago'] =  $values['fec_pago'];
			}
			if(isset($values['recibo']) and $values['recibo']!='')
			{
				$array['recibo'] =  $values['recibo'];
			}
                        
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->solicitudes("id_solicitud", $id_solicitud)->update($array);
			
                        $SolicitudesMovimientos = new SolicitudesMovimientos();
                        $SolicitudesMovimientos->saveSolicitudesMovimientos($values);

                        //return $q;
			
		}

	}

