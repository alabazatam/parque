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
			
			
			$array_solicitud = array(
				"id_espacio" => $values['id_espacio'],
				"id_zona_ubicacion" => $data_espacios['id_zona_ubicacion'],
				"id_tipo_espacio" => $data_espacios['id_tipo_espacio'],
				"id_user" => $_SESSION['id_user'],
				"fec_reservacion" => $values['fec_reservacion'],
				"status" => 1,
				"costo" => 100,
				"date_created" => date(gmdate('Y-m-d H:i:s', time() - (4 * 3600))),
				"date_updated" => date(gmdate('Y-m-d H:i:s', time() - (4 * 3600))),
				
			);
			
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->solicitudes()->insert($array_solicitud);
			$values['id_solicitud'] = $ConnectionORM->getConn()->lastInsertId('solicitudes_id_solicitud_seq');
			
			return $values;	
			
		}

	}

