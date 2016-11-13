<?php

class StatusMail
{
	function notificaStatusMail($values){

			
			$Solicitudes = new Solicitudes();
			$data_solicitud = $Solicitudes->getSolicitudById($values);
			
			$nombre1 = $data_solicitud['first_name'];
			$apellido1 = $data_solicitud['first_last_name'];
			
			$status = $data_solicitud['status'];
			$id_solicitud = $data_solicitud['id_solicitud'];
			$email = $data_solicitud['email'];
			
			try{
			//$smtp = "server-0116a.gconex.net";
			$smtp = "host.caracashosting50.com";
			$port = 465;
			$secure = "ssl";
			$username = "mdandrad@frbcomputersgroup.com.ve";
			$password = "230386";
			$mail_from = 'solicitud_parque@cgr.gob.ve'; 

			$transport = Swift_SmtpTransport::newInstance( $smtp, $port, $secure)
			  ->setUsername($username)
			  ->setPassword($password);
			// Create the Mailer using your created Transport
			$mailer = Swift_Mailer::newInstance($transport);
		   //$email = array('deandrademarcos@gmail.com','deandrademarcos@hotmail.com');
			//$email = "deandrademarcos@gmail.com";
				$message = Swift_Message::newInstance('Estatus de solicitud de reservación de espacios');
				
				$html = '<!DOCTYPE html>
				<html>

					<head>
						<title>TU/GRUERO®</title>
						<meta charset="UTF-8">
						<meta name="viewport" content="width=device-width, initial-scale=1.0">
					</head>
					<body style="font-family: Century Gothic,CenturyGothic,AppleGothic,sans-serif, cursive;font-size: 14px;color:#000;">
						<p>
						<strong>Estimado(a) '.$nombre1." ".$apellido1.',</strong> sirva el presente correo para saludarlo y a su vez notificarle que,

						</p>
						<div align="center">
							<p align="justify">se ha cambiado el estatus de su solicitud <strong>N° '.$id_solicitud.'</strong>, a estatus <strong>"'.$status.'"</strong></p>
						</div>';
				
				if(isset($values['observacion']) and $values['observacion']!='')
				{
					$observacion = $values['observacion'];
					$html.='<div><p align="justify"> <strong>Por el siguiente motivo: </strong> '.$observacion.'</p></div>';
				}
				
				$html.='<p>Recuerde que siempre podrá visualizar el estatus de sus solicitudes ingresando al sistema, en el menú de "Solicitudes", opción "Consultar solicitudes"</p>';
				$html.='<p>Sin más referencias a las que hacer, nos despedimos.</p>';
				
				$html.='							
					</body>
				</html>';
				$message->setBody($html,"text/html");			

			$message->setFrom(array ($mail_from => 'CGR'));
			$message->setTo($email);
			//$message->setBcc('info@tugruero.com');
			// Send the message


			$result = $mailer->send($message);	
			}catch(Exception $e){
				echo $e->getMessage();return;
			}

	}
		

			
}

		
		
		
		