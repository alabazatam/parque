<?php 


	class Utilitarios {
		
		public function generaCodigoDependencia($cod_depen){
			
		//$cod_depen = "01030408599";
		
		$cod_depen = str_split($cod_depen, 1);
		$codigo = "";
		$i = 1;
		foreach($cod_depen as $cod):
				
				if($i%2==0 and $i != count($cod_depen)){		
						$codigo.= $cod."-";
					
				}else{
					$codigo.= $cod;
				}			
				
			$i++;
		endforeach;
		return $codigo;
			
			
			
			
		}
		
		
		
		
		public function generaCarpetas($id_depen, $anio){
			
			$anio = 2015;
			$directorio_anio = $anio;
			$directorio_dependencia = $id_depen;
			//echo ("/web/uploads/documentos/".'marcos');
			if(!is_dir('../../../../web/uploads/documentos/'.$anio)){
				mkdir('../../../../web/uploads/documentos/'.$anio, 0775, true);//creo el directorio del anio
				
			}
			
			if(!is_dir('../../../../web/uploads/documentos/'.$anio.'/'.$id_depen)){
			mkdir('../../../../web/uploads/documentos/'.$anio.'/'.$id_depen, 0775, true);
							
			
			}				
			
			$DocumentosTiposDocumentos = new DocumentosTiposDocumentos();
			
			
			$tipos_documentos =  $DocumentosTiposDocumentos->getListTiposDocumentos();
			
				foreach ($tipos_documentos as $tipdoc):
						
						$id_tipdoc = $tipdoc['id_tipdoc'];
						if(!is_dir('../../../../web/uploads/documentos/'.$anio.'/'.$id_depen.'/'.$id_tipdoc)){
								mkdir('../../../../web/uploads/documentos/'.$anio.'/'.$id_depen.'/'.$id_tipdoc, 0775, true);
							
			
						}
				endforeach;
			//echo ($_SERVER["DOCUMENT_ROOT"]."/".main_folder."/web/uploads/".$anio);
			
			
			
		}
		function formateaFecha($fecha, $formato){
			
		$date = date_create($fecha);
		$date =  date_format($date, $formato);	
			
			
		return $date;
		}
		
		
		public function generarPassword($size = 8){
		$str = "ABCDEFGHJKMNPQRSTUVWXYZabcdefghjkmnpqrstuvwxyz23456789";
		$cad = "";
		$cad = str_shuffle($str);
		$cad= substr($cad,0,$size);
		return $cad;
	    }
		public function cutString($string,$size){
				
			if(strlen($string)>$size){
					$string =  substr($string,0,$size)."...";	
			}
			
			return $string;
		}

		public function formatFechaInput($date)
		{
			if(!empty($date))
			{
				$date = preg_split("/[\/]+/", @$date);
				$date = @$date[2]."-".@$date[1]."-".@$date[0];				
			}
                        
                        str_replace('--', '', $date);
			return $date;

		}
        function getRealIP()
        {

           if( isset($_SERVER['HTTP_X_FORWARDED_FOR']) and $_SERVER['HTTP_X_FORWARDED_FOR'] != '' )
           {
              $client_ip = 
                 ( !empty($_SERVER['REMOTE_ADDR']) ) ? 
                    $_SERVER['REMOTE_ADDR'] 
                    : 
                    ( ( !empty($_ENV['REMOTE_ADDR']) ) ? 
                       $_ENV['REMOTE_ADDR'] 
                       : 
                       "unknown" );

              // los proxys van añadiendo al final de esta cabecera
              // las direcciones ip que van "ocultando". Para localizar la ip real
              // del usuario se comienza a mirar por el principio hasta encontrar 
              // una dirección ip que no sea del rango privado. En caso de no 
              // encontrarse ninguna se toma como valor el REMOTE_ADDR

              $entries = preg_split('/[, ]/', $_SERVER['HTTP_X_FORWARDED_FOR']);

              reset($entries);
              while (list(, $entry) = each($entries)) 
              {
                 $entry = trim($entry);
                 if ( preg_match("/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/", $entry, $ip_list) )
                 {
                    // http://www.faqs.org/rfcs/rfc1918.html
                    $private_ip = array(
                          '/^0\./', 
                          '/^127\.0\.0\.1/', 
                          '/^192\.168\..*/', 
                          '/^172\.((1[6-9])|(2[0-9])|(3[0-1]))\..*/', 
                          '/^10\..*/');

                    $found_ip = preg_replace($private_ip, $client_ip, $ip_list[1]);

                    if ($client_ip != $found_ip)
                    {
                       $client_ip = $found_ip;
                       break;
                    }
                 }
              }
           }
           else
           {
              $client_ip = 
                 ( !empty($_SERVER['REMOTE_ADDR']) ) ? 
                    $_SERVER['REMOTE_ADDR'] 
                    : 
                    ( ( !empty($_ENV['REMOTE_ADDR']) ) ? 
                       $_ENV['REMOTE_ADDR'] 
                       : 
                       "unknown" );
           }

           return $client_ip;

        }
	}
