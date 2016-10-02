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
	class Ubicaciones {
		
		public function __construct() 
		{
			
		}

		public function getUbicacionesList(){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->ubicaciones
			->select("*")
            ->where('status=?',1);	
			return $q;
			
		}

	}