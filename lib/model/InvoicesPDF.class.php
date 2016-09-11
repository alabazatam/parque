<?php

    class InvoicesPDF 
    {
        
        function generate1($values)
        {
			setlocale(LC_NUMERIC,"es_ES.UTF8");
            ob_start();
            $id_sale = $values['id_sale'];
            $Sales = new Sales();
			$Utilitarios = new Utilitarios();
			$Clients = new Clients();
			$ClientsAddressDetail = new ClientsAddressDetail();
            $sale_data = $Sales ->getSalesInvoiceById($values);
			$containers_data = $Sales ->getSalesContainers($values);
			
            $sale_date =  $sale_data['date_sale'];
            $id_country_out = $sale_data['id_country_out'];
            $id_port_out = $sale_data['id_port_out'];
            $date_out = $sale_data['date_out'];
            $id_country_in = $sale_data['id_country_in'];
            $id_port_in = $sale_data['id_port_in'];
            $date_estimate_in = $sale_data['date_estimate_in'];
			$date_out = $sale_data['date_out'];
			$company_name = $sale_data['company_name'];
                        $company_billing = $sale_data['company_billing'];
            $client_name = strtoupper($sale_data['client_name']);
			$client_address = $sale_data['client_address'];
			$plant_name =  $sale_data['plant_name'];
			$plant_rif =  $sale_data['plant_rif'];
			$terms = $sale_data['terms'];
			$farm_name =  $sale_data['farm_name'];
			$plant_address =  $sale_data['plant_address'];
			$plant_country =  $sale_data['plant_country'];
                        $freight = $sale_data['freight'];
			$shipping_line_name = $sale_data['shipping_line_name'];
			$precinto_number = "";
			$container_number = "";
			$products_detail = $Sales->getSalesProductsDetail($values);
			$bank_name = $sale_data['bank_name'];
			$aba = $sale_data['aba'];
			$swit = $sale_data['swit'];
			$account = $sale_data['account'];
			$address1 = $ClientsAddressDetail->getAddressBySale($sale_data['id_client_address2']);
			$notify_address1 = $address1['address'];
			$country_address1 = $address1['country_name'];
			$state_address1 = $address1['state'];
			$code_address1 = $address1['code'];
			$tel_address1 = $address1['tel'];
			$email_address1 = $address1['email'];
			$fax_address1 = $address1['fax'];

            $address2 = $ClientsAddressDetail->getAddressBySale($sale_data['id_client_address2']);
			$notify_address2 = $address2['address'];
			$country_address2 = $address2['country_name'];
			$state_address2 = $address2['state'];
			$code_address2 = $address2['code'];
			$tel_address2 = $address2['tel'];
			$email_address2 = $address2['email'];
			$fax_address2 = $address2['fax'];
			//echo $company_billing;die;
            //ob_clean();
            // create new PDF document
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            // set document information
            $pdf->SetCreator("Marcos De Andrade");
            $pdf->SetAuthor('Marcos De Andrade');
            $pdf->SetTitle('Factura');
            $pdf->SetSubject('Factura');
            $pdf->SetKeywords('Factura, invoice, Coseinca');
            // set default header data
            $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
            // set header and footer fonts
            $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

            // set default monospaced font
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            // set margins
            $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

            // set auto page breaks
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

            // set image scale factor
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

            // ---------------------------------------------------------

            // set font
            $pdf->SetFont('freeserif', '', 8);

            // add a page
            $pdf->AddPage();

            // writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
            // writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

            // create some HTML content
            $class_td = "border-bottom: 0px #ffffff !important;border-top: 0px !important; border-right: 0px; border-left: 0px";
            $html ='
            <table border="0" width="100%">
                <tr>
                    <td style="width:50%"></td>
                    <td>
                        <table border="1">
                            <tr>
                                <td style="background-color: #cccccc; font-size: 12px; text-align:center;font-weight: bolder;">Invoice Date</td>
                                <td style="background-color: #cccccc; font-size: 12px; text-align:center;font-weight: bolder;">Proforma Invoice #</td>
                            </tr>
                            <tr>
                                <td style="text-align:center;">'.$sale_date.'</td>
                                <td style="text-align:center;">'.$id_sale.'</td>
                            </tr>
                        </table>

                    </td>
                </tr>
            </table>
            <div></div>
            <table width="100%" border="0">
                <tr>
                    <td style="width:40%">
                        <table border="1" width="100%">
                            <tr>
                                <td style="background-color: #cccccc; font-size: 12px; text-align:center;font-weight: bolder;">Bill To</td>
                            </tr>
                            <tr>
                                <td>
									<strong>'.strtoupper($client_name).'</strong><br>
									<strong>'.strtoupper($client_address).'</strong>
								
								</td>
                            </tr>
                        </table>
                    </td>
                    <td style="width:20%"></td>
                    <td style="width:40%">
                        <table  width="100%" border="0" cellspacing="0" cellpadding="0" style="border-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px">
                            <tr>
                                <td style="background-color: #cccccc; font-size: 12px; text-align:center;font-weight: bolder;">Processing Plant</td>
                            </tr>';
            
                $html.='
                            <tr>
                                <td><strong>'.strtoupper($plant_name).'</strong></td>
                            </tr>';
                $html.='
                            <tr>
                                <td>'.strtoupper($plant_rif).'</td>
                            </tr>'; 
                $html.='
                            <tr>
                                <td>'.strtoupper($plant_address).'</td>
                            </tr>'; 
                $html.='
                            <tr>
                                <td>'.strtoupper($plant_country).'</td>
                            </tr>';
        $html.='
                        </table>
                    </td>
                </tr>
            </table>
			<br>
            ';
		//lista de productos
		$pdf->writeHTML($html, true, false, true, false, '');
		$pdf->ln();
		$total_amount = 0;
		$total_quantity = 0;
		$total_cases = 0;
		$html ='<table width="100%" style="border-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px">'
			. '<tr style="background-color: #CCC;">'
				. '<th style="text-align: center;" width="14%" style="border-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px"><strong>Container #</strong></th>'
				. '<th style="text-align: center;" width="30%" style="border-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px"><strong>Item</strong></th>'
				. '<th style="text-align: center;" width="8%" style="border-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px"><strong>Cases</strong></th>'
				. '<th style="text-align: center;" width="8%" style="border-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px"><strong>Packing</strong></th>'
				. '<th style="text-align: center;" width="14%" style="border-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px"><strong>Qty Kgs</strong></th>'
				. '<th style="text-align: center;" width="14%" style="border-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px"><strong>Rate ($)</strong></th>'
				. '<th style="text-align: center;" width="14%" style="border-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px"><strong>Amount ($)</strong></th>'
			. '</tr>';
		
                
		foreach($products_detail as $products)
		{
                
                
		$total_amount+= $products['amount'];
		$total_cases+= $products['cases'];
		$total_quantity+= $products['quantity'];
		$html.='<tr>'
				. '<td style="border-right-width: 1px;">'.$products['number'].'</td>'
				. '<td style="border-right-width: 1px;">'.$products['product_name']." ".$products['product_type_name'].'</td>'
				. '<td style="text-align: right;border-right-width: 1px;">'.$products['cases'].'</td>'
				. '<td style="text-align: center;border-right-width: 1px;">'.$products['packing'].' x '.$products['pack'].'</td>'
				. '<td style="text-align: center;border-right-width: 1px;">'.$products['quantity'].' Kg</td>'
				. '<td style="text-align: right;border-right-width: 1px;">$&nbsp;&nbsp;&nbsp;'.number_format($products['rate'],2,",",".").'</td>'
				. '<td style="text-align: right;border-right-width: 1px;">$&nbsp;&nbsp;&nbsp;'.number_format($products['amount'],2,",",".").'</td>'
			. '</tr>';
               
		}
		$html.='<tr>'
				. '<td style="border-right-width: 1px;">&nbsp;</td>'
				. '<td style="border-right-width: 1px;"><strong>'.$farm_name.'</strong></td>'
				. '<td style="text-align: right;border-right-width: 1px;"><strong>'.$total_cases.'</strong></td>'
				. '<td style="border-right-width: 1px;">&nbsp;</td>'
				. '<td style="text-align: center;border-right-width: 1px;"><strong>Kgr. <br>'.$total_quantity.'</strong></td>'
				. '<td style="text-align: center;border-right-width: 1px;"><strong>INCOMTERMS <br> CFR</strong></td>'
				. '<td style="text-align: right;"border-right-width: 1px;><strong>$&nbsp;&nbsp;&nbsp;'.number_format($total_amount,2,",",".").'</strong></td>'
			. '</tr>';					
		
		$html.= '</table>';
		$pdf->ln();
		$pdf->writeHTML($html, true, false, true, false, '');
		
		 $i = 0;
		foreach($containers_data as $container)
		{
                if($i == 0)
                {
                    $precinto_number = $precinto_number."".$container['precinto'];
                    $container_number = $container_number."".$container['number'];
                }else
                {
                    $precinto_number = $precinto_number.",".$container['precinto'];
                    $container_number = $container_number.",".$container['number'];
                }
		$i++;
		}
		
		
		//fin lista de productos
		//cuentas bancarios y otros
		$html = '<table border="0" width="100%">'
			. '<tr>'
			. '<td width="20%">&nbsp;</td>'
			. '<td width="40%">&nbsp;</td>'
			. '<td width="40%" colspan="2"><strong>Make All Checks payable to:</strong></td>'
			. '</tr>'
			. '<tr>'
			. '<td width="20%">&nbsp;</td>'
			. '<td width="40%">&nbsp;</td>'
			. '<td width="10%" style="text-align: left;"><strong>Beneficiary:</strong></td>'
			. '<td width="30%" style="text-align: left;"><strong> '.$company_name.'</strong></td>'
			. '</tr>'
			. '<tr>'
			. '<td style="text-align: left;"><strong>Destination:</strong></td>'
			. '<td style="text-align: left;"><strong> '.$state_address1.' '.$country_address1.'</strong></td>'
			. '<td style="text-align: left;"><strong>Address: </strong></td>'
			. '<td style="text-align: left;"> '.$company_billing.'</td>'
			. '</tr>'
			. '<tr>'
			. '<td style="text-align: left;" colspan="2"><strong>Product Packed in Venezuela</strong></td>'
			. '<td style="text-align: left;" colspan="2">&nbsp;</td>'
			. '</tr>'
			. '<tr>'
			. '<td style="text-align: left;" colspan=""><strong>Container No: </strong></td>'
			. '<td style="text-align: left;" colspan="3"><strong>'.$container_number.'</strong></td>'

			. '</tr>'
			. '<tr>'
			. '<td style="text-align: left;" colspan=""><strong>Precinto#: </strong></td>'
			. '<td style="text-align: left;" colspan="3"><strong>'.$precinto_number.'</strong></td>'
			

                        . '</tr>';
			
                        if($freight > 0)
                        {
                            $html.='<tr>'
                            .'<td style="text-align: left;" colspan=""><strong>Freight: </strong></td>'
                            . '<td style="text-align: left;" colspan="">$  '.$freight.'</td>'
                            . '<td style="text-align: left;"><strong>Bank: </strong></td>'
                            . '<td style="text-align: left;"> '.$bank_name.'</td>'
                            . '</tr>'; 
                        }else
                        {
                            $html.='<tr>'
                            .'<td style="text-align: left;" colspan=""></td>'
                            . '<td style="text-align: left;" colspan=""></td>'
                            . '<td style="text-align: left;"><strong>Bank: </strong></td>'
                            . '<td style="text-align: left;"> '.$bank_name.'</td>'
                            . '</tr>';  
                        }

                        
                        
			$html.= '<tr>'
			. '<td style="text-align: left;" colspan=""><strong>Shipping Line: </strong></td>'
			. '<td style="text-align: left;" colspan=""><strong> '.$shipping_line_name.'</strong></td>'
			. '<td style="text-align: left;" colspan="2">&nbsp;</td>'
			. '</tr>'
			. '<tr>'
			. '<td style="text-align: left;"><strong>ETD:</strong></td>'
			. '<td style="text-align: left;"><strong>'.$date_out.'</strong></td>'
			. '<td style="text-align: left;"><strong>ABA#: </strong></td>'
			. '<td style="text-align: left;"> '.$aba.'</td>'
			. '</tr>'
			. '<tr>'
			. '<td style="text-align: left;"><strong>ETA: </strong></td>'
			. '<td style="text-align: left;"><strong>'.$date_estimate_in.'</strong></td>'
			. '<td style="text-align: left;"><strong>Account#: </strong></td>'
			. '<td style="text-align: left;"> '.$account.'</td>'
			. '</tr>'
			. '<tr>'
			. '<td style="text-align: left;" colspan="2"></td>'
			. '<td style="text-align: left;"><strong>Swift#: </strong></td>'
			. '<td style="text-align: left;"> '.$swit.'</td>'
			. '</tr>'
			. '</table>';
			$pdf->ln();
			$pdf->writeHTML($html, true, false, true, false, '');
			
			//terminos de negociacion
			$html = '<table width="50%" border="0" cellspacing="0" cellpadding="0" style="background-color: #ccc;border-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px" >'
				. '<tr>'
				. '<td style="text-align: left;"><strong>Payment:</strong></td>'
				. '<td style="text-align: left;"><strong>'.$terms.'</strong></td>'
				. '</tr>'
				. '</table>';
			
			$pdf->ln();
			$pdf->writeHTML($html, true, false, true, false, '');			
			
			//fin terminos de negociacion
			
			//otros datos
			$html = '<table width="100%" border="0" >'
				. '<tr>'
				. '<th style="text-align: center; background-color: #ccc;border-top-width: 1px;border-bottom-width: 1px;border-left-width: 1px;border-right-width: 1px;"><strong>Phone#</strong></th>'
				. '<th style="text-align: center; background-color: #ccc;border-top-width: 1px;border-bottom-width: 1px;border-left-width: 1px;border-right-width: 1px; "><strong>Fax#</strong></th>'
				. '<th style="text-align: center; background-color: #ccc;border-top-width: 1px;border-bottom-width: 1px;border-left-width: 1px;border-right-width: 1px;"><strong>E-mail</strong></th>'
				. '<th style="text-align: center;"></th>'
				. '<th style="text-align: center;"></th>'								
				. '</tr>'
				. '<tr>'
				. '<td style="text-align: left;border-top-width: 1px;border-bottom-width: 1px;border-left-width: 1px;border-right-width: 1px;"><strong></strong></td>'
				. '<td style="text-align: left;border-top-width: 1px;border-bottom-width: 1px;border-left-width: 1px;border-right-width: 1px;"><strong></strong></td>'
				. '<td style="text-align: left;border-top-width: 1px;border-bottom-width: 1px;border-left-width: 1px;border-right-width: 1px;"><strong></strong></td>'
				. '<td style="text-align: left;"></td>'
				. '<td style="text-align: right; background-color: #ccc; border-top-width: 1px;border-bottom-width: 1px;border-left-width: 1px;border-right-width: 1px;"><strong>Balance due $ &nbsp;&nbsp;&nbsp;&nbsp;'.number_format($total_amount,2,",",".").'</strong></td>'								
				. '</tr>'
				. '</table>';
			
			$pdf->ln();
			$pdf->ln();
			$pdf->writeHTML($html, true, false, true, false, '');			
			
			//fin otros datos	

			
			//BL data
			$html = '<table width="80%"  border="0" cellspacing="0" cellpadding="0" style="border-style: solid; border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px" >'
				. '<tr>'
				. '<td style="text-align: left;" width="10%"><strong>BL datas:</strong></td>'
				. '<td style="text-align: left;" width="20%"><strong></strong></td>'
				. '<td style="text-align: left;" width="70%"><strong></strong></td>'
				. '</tr>'
				. '<tr>'
				. '<td style="text-align: left;"><strong></strong></td>'
				. '<td style="text-align: left;"><strong>CONSIGNEE:</strong></td>'
				. '<td style="text-align: left;"><strong>'.$client_name."<br>".$notify_address1."<br>".$state_address1."<br>".$country_address1.'<br><label style="color: red;">CODE: '.$code_address1."</label><br>Tel: +".$tel_address1."&nbsp;&nbsp;"."Fax: +".$fax_address1."<br>"."Email: ".$email_address1.'</strong></td>'
				. '</tr>'
				. '<tr>'
				. '<td style="text-align: left;"><strong></strong></td>'
				. '<td style="text-align: left;"><strong>NOTIFY:</strong></td>'
				. '<td style="text-align: left;"><strong>'.$client_name."<br>".$notify_address2."<br>".$state_address2."<br>".$country_address2.'<br><label style="color: red;">CODE: '.$code_address2."</label><br>Tel: +".$tel_address2."&nbsp;&nbsp;"."Fax: +".$fax_address2."<br>"."Email: ".$email_address2.'</strong></td>'
				. '</tr>'
				. '</table>';
			
			$pdf->ln();
			$pdf->writeHTML($html, true, false, true, false, '');			
			
			//fin otros datos	
            // output the HTML content
            //$pdf->writeHTML($html, true, false, true, false, '');
            // reset pointer to the last page
            $pdf->lastPage();
            
            // ---------------------------------------------------------

            //Close and output PDF document
            $pdf->Output('factura.pdf', 'I');

            
            return $pdf;
        }
        
        
        
        
        
        
        
    }