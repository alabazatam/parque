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
	class UT {
		
		public function __construct() 
		{
			
		}

		public function getValorUT(){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->ut
			->select("*")
			->fetch();
			return $q['valor']; 				
			
		}
		public function getUTData(){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->ut
			->select("*")
			->fetch();
			return $q; 				
			
		}
		public function updateUT($values){
			
			$valores_ut = array(
				"valor" => $values['valor']
			);
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->ut("id_ut", 1)->update($valores_ut);
			return 1; 				
			
		}

	}

