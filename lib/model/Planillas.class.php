<?php
	
	class Planillas {
			
	    function reservacion($values)
        {
			$Solicitudes = new Solicitudes();
			$data = $Solicitudes->getSolicitudById($values);
			setlocale(LC_NUMERIC,"es_ES.UTF8");
            ob_start();
			//echo $company_billing;die;
            //ob_clean();
            // create new PDF document
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            // set document information
            $pdf->SetCreator("CGR");
            $pdf->SetAuthor('CGR');
            $pdf->SetTitle('RESERVACIÓN DE ÁREAS E INSTALACIONES DEL PARQUE “JESÚS DAVID GARMENDIA LEÁÑEZ”');
            $pdf->SetSubject('RESERVACIÓN DE ÁREAS E INSTALACIONES DEL PARQUE “JESÚS DAVID GARMENDIA LEÁÑEZ”');
            $pdf->SetKeywords('RESERVACIÓN DE ÁREAS E INSTALACIONES DEL PARQUE “JESÚS DAVID GARMENDIA LEÁÑEZ”,');
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
            $pdf->SetFont('freeserif', '', 10);

            // add a page
            $pdf->AddPage();
			$html = '
<p style="font-size: 8px;">CGR</p>
<p style="font-size: 8px;">SERSACON</p>				
<table width="100%">
	<tr>
		<td width="80%" colspan="2" style="border-style: solid; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px"><p align="center" style="font-size: 14px;"><strong>RESERVACIÓN DE ÁREAS E INSTALACIONES DEL PARQUE “JESÚS DAVID GARMENDIA LEÁÑEZ”</strong></p></td>
		<td width="20%" style="border-style: solid; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px"><strong>Fecha: </strong><br> '.$data['fec_solicitud'].'</td>
		
	</tr>
	<tr>
		<td colspan="3" style="border-style: solid; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px"><p align="center" style="font-size: 11px;"><strong>DATOS DEL SOLICITANTE</strong></p></td>
		
	</tr>	
	<tr>
		<td colspan="3" style="border-style: solid; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px">Tipo de personal:</td>
		
	</tr>
	<tr>
		<td width="60%" colspan="" style="border-style: solid; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px">Apellidos y nombres: '.strtoupper($data['first_last_name']." ".$data['second_last_name']." ".$data['first_name']." ".$data['second_name']).'</td>
		<td width="40%" colspan="2" style="border-style: solid; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px">Cédula de identidad: '.$data['nationality']."-".$data['document'].'</td>
		
	</tr>
	<tr>
		<td colspan="" style="border-style: solid; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px">Correo electrónico:</td>
		<td colspan="" style="border-style: solid; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px">Extensión:</td>
		<td colspan="" style="border-style: solid; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px">Teléfono:</td>
		
	</tr>
	<tr>
		<td colspan="3" style="border-style: solid; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px">Dependencia de adscripción: '.strtoupper($data['nom_ubi']).'</td>
		
	</tr>
	<tr>
		<td colspan="3" style="border-style: solid; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px"><p align="center" style="font-size: 11px;"><strong>DATOS DEL ÁREA Y KIOSCO</strong></p></td>
		
	</tr>
	<tr>
		<td colspan="" style="border-style: solid; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px">Zona: '.strtoupper($data['des_zona_ubicacion']).'</td>
		<td colspan="2" style="border-style: solid; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px">Espacio: '.strtoupper($data['nom_espacio']).'</td>
	</tr>
	<tr>
		<td colspan="3" style="border-style: solid; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px">Fecha del evento: '.$data['fec_reservacion'].'</td>
		
	</tr>
	<tr>
		<td colspan="3" style="border-style: solid; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px">Motivo a celebrar:</td>
		
	</tr>	
</table>';
			
			$pdf->ln();
			$pdf->writeHTML($html, true, false, true, false, '');			

$html = '
<table width="750">
	<tr>
		<td width="35%" valign="top">
			<table width="100%">
				<tr>
					<td colspan="2" style=" border-top-width: 0px; border-right-width: 0px; border-left-width: 0px">Solicitado por</td>
				</tr>
				<tr>
					<td colspan="2" style=" border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px"></td>
				</tr>
				<tr>
					<td colspan="2" style=" border-right-width: 0px; border-left-width: 0px">Apellidos y nombres:</td>
				</tr>
				<tr>
					<td colspan="2" style=" border-right-width: 0px;  border-left-width: 0px"></td>
				</tr>
				<tr>
					<td colspan="2" style=" border-right-width: 0px;  border-left-width: 0px"></td>
				</tr>
				<tr>
					<td colspan="2" style=" border-right-width: 0px;  border-left-width: 0px"></td>
				</tr>
				<tr>
					<td colspan="2" style=" border-right-width: 0px;  border-left-width: 0px"></td>
				</tr>
				<tr>
					<td colspan="2" style=" border-right-width: 0px;  border-left-width: 0px"></td>
				</tr>
				<tr>
					<td colspan="2" style=" border-right-width: 0px;  border-left-width: 0px"></td>
				</tr>
				<tr>
					<td colspan="2" style=" border-right-width: 0px;  border-left-width: 0px"></td>
				</tr>
				<tr>
					<td colspan="2" style=" border-right-width: 0px;  border-left-width: 0px"></td>
				</tr>
				<tr>
					<td colspan="2" style=" border-right-width: 0px;  border-left-width: 0px"></td>
				</tr>
				<tr>
					<td style=" border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px">Firma:</td>
					<td style=" border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px">Fecha: </td>
				</tr>

			</table>
		</td>
		<td>
			<table width="100%">
				<tr>
					<td colspan="2" style="border-style: solid; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px">Sersacon</td>
				</tr>
				<tr>
					<td width="50%" style="border-style: solid; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px">Recibido por</td>
					<td style="border-style: solid; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px">Autorizado por</td>
				</tr>
				<tr>
					<td style="border-style: solid; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px">
						<table width="100%">
							<tr>
								<td colspan="2" style=" border-right-width: 0px; border-left-width: 0px">Apellidos y nombres:</td>
							</tr>
							<tr>
								<td colspan="2" style=" border-right-width: 0px; border-left-width: 0px"></td>
							</tr>
							<tr>
								<td colspan="2" style=" border-right-width: 0px; border-left-width: 0px"></td>
							</tr>
							<tr>
								<td colspan="2" style=" border-right-width: 0px; border-left-width: 0px"></td>
							</tr>
							<tr>
								<td colspan="2" style=" border-right-width: 0px; border-left-width: 0px"></td>
							</tr>
							<tr>
								<td colspan="2" style=" border-right-width: 0px; border-left-width: 0px"></td>
							</tr>
							<tr>
								<td colspan="2" style=" border-right-width: 0px; border-left-width: 0px"></td>
							</tr>
							<tr>
								<td colspan="2" style=" border-right-width: 0px; border-left-width: 0px"></td>
							</tr>
							<tr>
								<td colspan="2" style=" border-right-width: 0px; border-left-width: 0px"></td>
							</tr>
							<tr>
								<td colspan="2" style=" border-right-width: 0px; border-left-width: 0px"></td>
							</tr>
							<tr>
								<td style="border-style: solid; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px">Firma:</td>
								<td style="border-style: solid; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px">Fecha:</td>
							</tr>
						</table>
					</td>
					<td style="border-style: solid; border-top-width: 0px; border-right-width: 0px; border-bottom-width: 0px; border-left-width: 0px">
						<br><br><br><br><br>
						<p align="center"  style="font-size: 10px;"><strong>MAYRA GALINDO LEÓN</strong><br><strong>PRESIDENTE (A)</strong></p>
						<p align="center" style="font-size: 9px;">Fundación para los Servicios de Salud y Previsión Social de la Contraloría General de la República,   según Gaceta Oficial de la República Bolivariana de Venezuela N°40.763 de fecha: 08/10/2015</p>
					</td>
				</tr>
			</table>	
		</td>
	</tr>


</table>
<p><strong>NOTA:</strong> el presente formulario debe ir acompañado de la “Carta de Compromiso” </p>

';
			$pdf->ln();
			$pdf->writeHTML($html, true, false, true, false, '');			
			//fin otros datos	
            // output the HTML content
            //$pdf->writeHTML($html, true, false, true, false, '');
            // reset pointer to the last page
            $pdf->lastPage();
            
            // ---------------------------------------------------------
			$pdf->AddPage();
			$pdf->ln();
			
			$html = '<p align="center" class="font-size:16px;text-decoration: underline;"><strong>CARTA COMPROMISO</strong></p>'
				. '<p align="justify" class="font-size:14px;">Yo,  cédula de identidad número, en mi condición de beneficiario del uso y disfrute de las instalaciones 
					del Parque “Jesús David Garmendia Leáñez” de la Contraloría General de la República, por medio de la presente me comprometo a 
					cumplir y hacer cumplir por parte de mis familiares y amigos, la normativa legal y mantener el orden en el uso de su instalaciones 
										y garantizar la observancia de la moral y las buenas costumbres.  
					De igual manera, reportaré ante el personal de seguridad, cualquier eventualidad que se me presente, 
					a fin de que se tomen las acciones pertinentes. </p>';
			
			$pdf->writeHTML($html, true, false, true, false, '');			
			//fin otros datos	
            // output the HTML content
            //$pdf->writeHTML($html, true, false, true, false, '');
            // reset pointer to the last page
            $pdf->lastPage();			
            //Close and output PDF document
            $pdf->Output('reservacion.pdf', 'I');

            
            return $pdf;
        }
			
			
}
	
