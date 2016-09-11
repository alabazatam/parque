<?php

Class Menu {
	
	
	function getMenuPadres()
	{
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->menu
			->select("*")
			->where("status=?",1)
			->and('id_menu_padre=0')
			->order('orden');			
			
			return $q; 
	}
	function getMenuHijos($id_menu_padre)
	{
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->menu
			->select("*")
			->where("status=?",1)
			->and('id_menu_padre=?',$id_menu_padre)
			->order('description');			
			
			return $q; 
	}	
	
	
	
}