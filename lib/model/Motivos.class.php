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
	class Motivos {
		
		public function __construct() 
		{
			
		}

		public function getMotivosList(){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->motivos
			->select("*")
            ->where('status=?',1)
			->order('des_motivo');	
			return $q;
			
		}

	}