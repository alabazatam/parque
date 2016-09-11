<?php

	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */

	/**
	 * Description of ProductsType
	 *
	 * @author marcos
	 */
	class ProductsType {
		
		public function __construct() 
		{
			
		}
		public function getProductsTypeList($values)
		{	
			$columns = array();
			$columns[0] = 'id_product_type';
			$columns[1] = 'products.name';
			$columns[2] = 'products_type.name';
			$columns[3] = 'products_type.status';
			$columns[4] = 'date_created';
			$columns[5] = 'date_updated';
			$column_order = $columns[0];
			$where = '1 = 1';
			$order = 'asc';
			$limit = $values['length'];
			$offset = $values['start'];
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = "upper(products_type.name) like upper('%$str%')"
					. "or upper(status.name) like upper('%$str%')"
					. "or upper(products_type.abr) like upper('%$str%')" 
					. "or upper(products.name) like upper('%$str%')"
					. "or cast(id_product_type as char(100)) =  '$str' ";
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
			$q = $ConnectionORM->getConnect()->products_type
			->select("*,products_type.name as name,products.name as product_name,products_type.status as status, DATE_FORMAT(products_type.date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(products_type.date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->join("status","LEFT JOIN status on status.id_status = products_type.status")
			->join("products","LEFT JOIN products on products.id_product = products_type.id_product")
	
			->order("$column_order $order")
			->where("$where")
			->limit($limit,$offset);
			return $q; 			
		}
		public function getCountProductsTypeList($values)
		{	
			$where = '1 = 1';
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = "upper(products_type.name) like upper('%$str%')"
					. "or upper(status.name) like upper('%$str%')"
					. "or upper(products_type.abr) like upper('%$str%')"
					. "or upper(products.name) like upper('%$str%')"
					. "or cast(id_product_type as char(100)) =  '$str' ";
			}
            $ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->products_type
			->select("count(*) as cuenta")
			->join("status","LEFT JOIN status on status.id_status = products_type.status")	
			->join("products","LEFT JOIN products on products.id_product = products_type.id_product")

			->where("$where")
			->fetch();
			return $q['cuenta']; 			
		}
		public function getProductsTypeById($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->products_type
			->select("*, DATE_FORMAT(date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->where("id_product_type=?",$values['id_product_type'])->fetch();
                        return $q; 				
			
		}
		function deleteProductsType($id_product_type){
			unset($values['action']);
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->products_type("id_product_type", $id_product_type)->delete();
			
			
		}		
		function saveProductsType($values){
			unset($values['action'],$values['PHPSESSID'],$values['id_product_type']);
                        $values['date_created'] = new NotORM_Literal("NOW()");
                        $values['date_updated'] = new NotORM_Literal("NOW()");
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->products_type()->insert($values);
			$values['id_product_type'] = $ConnectionORM->getConnect()->products_type()->insert_id();
			return $values;	
			
		}
		function updateProductsType($values){
			unset($values['action'],$values['PHPSESSID']);
                        unset($values['date_created']);
			$id_product_type = $values['id_product_type'];
                        $values['date_updated'] = new NotORM_Literal("NOW()");
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->products_type("id_product_type", $id_product_type)->update($values);
			return $q;
			
		}
		public function getListProductsType($values = null){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->products_type
			->select("*")
			->where("status=?",1);
			return $q; 				
			
		}
		public function getListProductsTypeByIdProduct($id_product){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->products_type
			->select("*")
			->where("status=?",1)
			->and('id_product =?',$id_product);
			return $q; 				
			
		}		
	}
	