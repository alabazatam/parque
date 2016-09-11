<?php

	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */

	/**
	 * Description of Products
	 *
	 * @author marcos
	 */
	class Products {
		
		public function __construct() 
		{
			
		}
		public function getProductsList($values)
		{	
			$columns = array();
			$columns[0] = 'id_product';
			$columns[1] = 'products.name';
			$columns[2] = 'status';
			$columns[3] = 'date_created';
			$columns[4] = 'date_updated';
			$column_order = $columns[0];
			$where = '1 = 1';
			$order = 'asc';
			$limit = $values['length'];
			$offset = $values['start'];
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = "upper(products.name) like upper('%$str%')"
					. "or upper(status.name) like upper('%$str%')"
					. "or cast(id_product as char(100)) =  '$str' ";
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
			$q = $ConnectionORM->getConnect()->products
			->select("*,products.name as name, DATE_FORMAT(products.date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(products.date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->join("status","LEFT JOIN status on status.id_status = products.status")
			->order("$column_order $order")
			->where("$where")
			->limit($limit,$offset);
			return $q; 			
		}
		public function getCountProductsList($values)
		{	
			$where = '1 = 1';
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = "upper(products.name) like upper('%$str%')"
					. "or upper(status.name) like upper('%$str%')"
					. "or cast(id_product as char(100)) =  '$str' ";
			}
            $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->products
			->select("count(*) as cuenta")
			->join("status","LEFT JOIN status on status.id_status = products.status")
			->where("$where")->fetch();
			return $q['cuenta']; 			
		}
		public function getProductsById($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->products
			->select("*, DATE_FORMAT(date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			
			->where("id_product=?",$values['id_product'])->fetch();
                        return $q; 				
			
		}
		function deleteProducts($id_product){
			unset($values['action']);
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->products("id_product", $id_product)->delete();
			
			
		}		
		function saveProducts($values){
			unset($values['action'],$values['PHPSESSID'],$values['id_product']);
                        $values['date_created'] = new NotORM_Literal("NOW()");
                        $values['date_updated'] = new NotORM_Literal("NOW()");
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->products()->insert($values);
			$values['id_product'] = $ConnectionORM->getConnect()->products()->insert_id();
			return $values;	
			
		}
		function updateProducts($values){
			unset($values['action'],$values['PHPSESSID']);
                        unset($values['date_created']);
			$id_product = $values['id_product'];
                        $values['date_updated'] = new NotORM_Literal("NOW()");
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->products("id_product", $id_product)->update($values);
			return $q;
			
		}
		public function getProductsListSelect($values = null){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->products
			->select("*, DATE_FORMAT(date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->where("status=?",1);
            return $q; 				
			
		}
	}
	