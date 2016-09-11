<?php

	/*
	 * To change this license header, choose License Headers in Project Properties.
	 * To change this template file, choose Tools | Templates
	 * and open the template in the editor.
	 */

	/**
	 * Description of ShippingLines
	 *
	 * @author marcos
	 */
	class ShippingLines{
		
		public function __construct() 
		{
			
		}
		public function getShippingLinesList($values)
		{	
			$columns = array();
			$columns[0] = 'id_shipping_lines';
			$columns[1] = 'shipping_lines.name';
			$columns[2] = 'abr';
			$columns[3] = 'status.name';
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
				$where = ""
                                        . "upper(status.name) like upper('%$str%') "
										. "or upper(shipping_lines.abr) like upper('%$str%') "
                                        . "or upper(shipping_lines.name) like upper('%$str%')"
                                        . "or cast(id_shipping_lines as char(100)) =  '$str' ";
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
			$q = $ConnectionORM->getConnect()->shipping_lines()
			->select("shipping_lines.*,shipping_lines.name as shipping_line,status.name,DATE_FORMAT(shipping_lines.date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(shipping_lines.date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->join("status","LEFT JOIN status on status.id_status = shipping_lines.status")
                        ->where("$where")
                        ->order("$column_order $order")
			->limit($limit,$offset);
			return $q; 			
		}
		public function getCountShippingLinesList($values)
		{	
			$where = '1 = 1';
			if(isset($values['search']['value']) and $values['search']['value'] !='')
			{	
				$str = $values['search']['value'];
				$where = ""
                                        . "upper(status.name) like upper('%$str%') "
										. "or upper(shipping_lines.abr) like upper('%$str%') "
                                        . "or upper(shipping_lines.name) like upper('%$str%')"
                                        . "or cast(id_shipping_lines as char(100)) =  '$str' ";
			}
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->shipping_lines
			->select("count(*) as cuenta")
				->where("$where")
				->join("status","LEFT JOIN status on status.id_status = shipping_lines.status")
				->fetch();
			return $q['cuenta']; 			
		}
		public function getShippingLinesById($values){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->shipping_lines
			->select("*, DATE_FORMAT(date_created, '%d/%m/%Y %H:%i:%s') as date_created,DATE_FORMAT(date_updated, '%d/%m/%Y %H:%i:%s') as date_updated")
			->where("id_shipping_lines=?",$values['id_shipping_lines'])->fetch();
			return $q; 				
			
		}
		function deleteShippingLines($id){
			unset($values['action']);
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->shipping_lines("id", $id)->delete();
			
			
		}		
		function saveShippingLines($values){
			unset($values['action'],$values['PHPSESSID'],$values['id_shipping_lines']);
			$values['date_created'] = new NotORM_Literal("NOW()");
			$values['date_updated'] = new NotORM_Literal("NOW()");
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->shipping_lines()->insert($values);
			$values['id_shipping_lines'] = $ConnectionORM->getConnect()->ShippingLines()->insert_id();
			return $values;	
			
		}
		function updateShippingLines($values){
			unset($values['action'],$values['date_created'],$values['PHPSESSID']);
			$values['date_updated'] = new NotORM_Literal("NOW()");
			$id_shipping_lines = $values['id_shipping_lines'];
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->shipping_lines("id_shipping_lines", $id_shipping_lines)->update($values);
			return $q;
			
		}
		public function getListShippingLines($values = null){
			$ConnectionORM = new ConnectionORM();
			$q = $ConnectionORM->getConnect()->shipping_lines
			->select("*")
			->where("status=?",1)
			->order('name');
			return $q; 				
			
		}
	}
	