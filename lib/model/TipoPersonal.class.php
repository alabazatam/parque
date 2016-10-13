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
	class TipoPersonal {
		
		public function __construct() 
		{
			
		}

		public function getTipoPersonalList(){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->tipo_personal
			->select("*")
			->where("status=?",1)
			->order('des_tipo_personal');
			return $q; 				
			
		}

	}

