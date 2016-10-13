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
	class EspaciosCaracteristicas {
		
		public function __construct() 
		{
			
		}

		function saveEspaciosCaracteristicas($values){
			$array = array(
				'id_espacio' => $values['id_espacio'],
				'id_caracteristica' => $values['id_caracteristica']
				
				);
			
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->espacios_caracteristicas()->insert($array);
			return $array;	
			
		}
		function deleteEspaciosCaracteristicas($id_espacio){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->espacios_caracteristicas("id_espacio", $id_espacio)->delete();
			
			
		}
		public function getCountEspacioCaracteristicaByIds($id_espacio, $id_caracteristica){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->espacios_caracteristicas
			->select("count(*) as cuenta")
			->where("id_espacio=?",$id_espacio)
			->where("id_caracteristica=?",$id_caracteristica)
			->fetch();
			return $q['cuenta']; 				
			
		}


	}

