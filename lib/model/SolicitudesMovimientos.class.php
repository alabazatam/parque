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
	class SolicitudesMovimientos {
		
		public function __construct() 
		{
			
		}
		function saveSolicitudesMovimientos($values){
                        $movimiento_solicitud = array(
				"id_solicitud" => $values['id_solicitud'],
				"status" => $values['status'],
				"date_created" => date(gmdate('Y-m-d H:i:s', time() - (4 * 3600))),
				"id_user" => $_SESSION['id_user'],
                                "observacion" => @$values['observacion'],
				
			);
			//print_r($movimiento_solicitud);die;
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->solicitudes_movimientos()->insert($movimiento_solicitud);				

			
			return $values;	
			
		}
		public function getObservacion($values){
                    
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->solicitudes_movimientos
			->select("observacion")
			->where('id_solicitud=?',$values['id_solicitud'])
                        ->and('status=?',$values['id_status'])
                        ->order('date_created desc')
                        ->limit(1)
			->fetch();	
                        return $q['observacion'];
			
		}



	}

