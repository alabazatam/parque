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
	class Parentescos {
		
		public function __construct() 
		{
			
		}

		public function getParentescosList(){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->parentescos
			->select("*")
            ->where('status=?',1);	
			return $q;
			
		}
		public function getParentescosList2($values)
		{	
			$columns = array();
			$columns[0] = 'id_parentesco';
			$columns[1] = 'nom_parentesco';
			$columns[2] = 'status';
			$column_order = $columns[0];
			$where = '1 = 1';
			$order = 'asc';
			$limit = $values['length'];
			$offset = $values['start'];
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = "upper(nom_parentesco) like upper('%$str%')"
					. "or upper(status.name) like upper('%$str%') "
					. "or cast(parentescos.id_parentesco as char(100)) =  '$str' ";;
			}
			if(isset($values['order'][0]['column']) and $values['order'][0]['column']!='0')
			{
				$column_order = $columns[$values['order'][0]['column']];
			}
			if(isset($values['order'][0]['dir']) and $values['order'][0]['dir']!='0')
			{
				$order = $values['order'][0]['dir'];//asc o desc
			}
			//echo $column_order;die;
            $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->parentescos
			->select("*")
			->join("status","LEFT JOIN status on status.id_status = parentescos.status")
			->order("$column_order $order")
			->where("$where")
			->limit($limit,$offset);
			return $q; 			
		}
		public function getCountParentescosList($values)
		{	
			$where = '1 = 1';
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = "upper(nom_parentesco) like upper('%$str%')"
					. "or upper(status.name) like upper('%$str%') "
					. "or cast(parentescos.id_parentesco as char(100)) =  '$str' ";;
			}
            $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->parentescos
			->select("count(*) as cuenta")
			->join("status","LEFT JOIN status on status.id_status = parentescos.status")
			->where("$where")
			->fetch();
			return $q['cuenta']; 			
		}
		public function getParentescosById($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->parentescos
			->select("*")
			->where("id_parentesco=?",$values['id_parentesco'])->fetch();
			return $q; 				
			
		}
		function deleteParentescos($id_parentesco){
			unset($values['action'],$values['PHPSESSID']);
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->parentescos("id_parentesco", $id_parentesco)->delete();
			
			
		}		
		function saveParentescos($values){
			unset($values['action'],$values['PHPSESSID'],$values['id_parentesco'],$values['date_created'],$values['date_updated']);
            $values['date_created'] = new NotORM_Literal("NOW()");
            $values['date_updated'] = new NotORM_Literal("NOW()");
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->parentescos()->insert($values);
			$values['id_parentesco'] = $ConnectionORM->getConn()->lastInsertId('parentescos_id_parentesco_seq');
			//echo $values['id_parentesco'];
			return $values;	
			
		}
		function updateParentescos($values){
			unset($values['action'],$values['PHPSESSID'],$values['date_created']);
			$values['date_updated'] = new NotORM_Literal("NOW()");
			$id_parentesco = $values['id_parentesco'];
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->parentescos("id_parentesco", $id_parentesco)->update($values);
			//return $q;
			
		}
		public function getParentescosListSelect($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->parentescos
			->select("*")
			->where("status=?",1);
			return $q; 				
			
		}

	}

