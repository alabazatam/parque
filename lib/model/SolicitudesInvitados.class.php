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
	class SolicitudesInvitados {
		
		public function __construct() 
		{
			
		}

		public function getSolicitudesInvitadosList($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->solicitudes_invitados
			->select("*")
			->where('id_solicitud=?',$values['id_solicitud'])
			->order('id_solinvi');	
			return $q;
			
		}
		function saveSolicitudesInvitados($values){
			$array = array(
				'id_solicitud' => $values['id_solicitud'],
				'date_created' => new NotORM_Literal("NOW()"),
				'date_updated' => new NotORM_Literal("NOW()")
			);		
			
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->solicitudes_invitados()->insert($array);
			$values['id_solinvi'] = $ConnectionORM->getConn()->lastInsertId('solicitudes_invitados_id_solinvi_seq');
			return $values;	
			
		}
		function updateSolicitudesInvitados($values){
		
			$id = $values['id'];
			$column_name = $values['column_name'];
			$array = array(
				$column_name => $values['value'],
				'date_created' => new NotORM_Literal("NOW()"),
				'date_updated' => new NotORM_Literal("NOW()")
			);
			
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->solicitudes_invitados("id_solinvi", $id)->update($array);
			//return $q;
			
		}
		function deleteSolicitudesInvitados($id){
		
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->solicitudes_invitados("id_solinvi", $id)->delete();
			
		}
		public function getCuentaSolicitudesInvitadosList($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->solicitudes_invitados
			->select("count(*) as cuenta")
			->where('id_solicitud=?',$values['id_solicitud'])
			->fetch();	
			return $q['cuenta'];
			
		}
		public function compruebaCedulaInvitado($values){
                    
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->solicitudes_invitados
			->select("count(*) as cuenta")
			->where('id_solicitud=?',$values['id_solicitud'])
                        ->and('nacion=?',$values['nacion'])
                        ->and('cedula=?',$values['cedula'])
                        ->and('id_solinvi<>?',$values['id_solinvi'])
			->fetch();	
                        return $q['cuenta'];
			
		}
	}
