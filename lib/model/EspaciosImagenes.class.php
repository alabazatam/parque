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
	class EspaciosImagenes {
		
		public function __construct() 
		{
			
		}
		
		function saveEspaciosImagenes($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->espacios_imagenes()->insert($values);
			
		}
		public function getImagenesEspaciosById($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->espacios_imagenes
			->select("*")
			->where("id_espacio=?",$values['id_espacio'])
			->order("orden asc");
			return $q; 				
			
		}
		function deleteEspaciosImagenes($id_espacio,$orden){
			
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->espacios_imagenes("id_espacio",$id_espacio)->where('orden=?',$orden)->delete();
			
			
		}	
	}

