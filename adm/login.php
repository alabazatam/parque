<?php include("../view_header.php");?>
        	<div class="col-sm-4 col-md-4 col-lg-4">
        	</div>
        	
            <div class="col-sm-4 col-md-4 col-lg-4">
				 <div class="panel panel-info ">
				  <div class="panel-heading ">
				    <label class="panel-title">
				    <?php echo title; ?> <small> <?php echo version; ?></small>
				    <!--<img width='100' class="img-responsive img-hover img-thumbnail img-rounded" src="<?php echo full_url?>/web/images/fedcom1.png"/>-->
				    
				    </label>
				  </div>
				  <div class="panel-body">
                                      <div align='center' class="visible-lg visible-md">
                                         <img src="<?php echo full_url;?>/web/img/Coseinca.png" class="img-responsive" width="150"> 
                                      </div>
                                      <div align='center' class="visible-sm visible-xs">
                                         <img src="<?php echo full_url;?>/web/img/Coseinca.png" class="img-responsive" width="100"> 
                                      </div>					
                                        <form name="" id="" novalidate action="<?php echo full_url;?>/adm/index.php" method="POST">
			                
                                         <input type="hidden" name="action" value="acceso"/>
			                    <div class="control-group form-group">
			                        <div class="controls">
			                            <label>Usuario:</label>
			                            <input  autocomplete="off" name='login' type="text" class="form-control" id="login" required data-validation-required-message="Please enter your login.">
			                            <p class="help-block"></p>
			                        </div>
			                    </div>
			                    <div class="control-group form-group">
			                        <div class="controls">
			                            <label>Clave:</label>
			                            <input autocomplete="off" name='password' type="password" class="form-control" id="password" required data-validation-required-message="Please enter your password.">
			                        </div>
			                    </div>
			                    <div class="control-group form-group">
			                        <div class="controls">
										<?php
											  // show captcha HTML using Securimage::getCaptchaHtml()

											  $options = array();
											  $options['input_name']             = 'ct_captcha'; // change name of input element for form post
											  $options['disable_flash_fallback'] = false; // allow flash fallback

											  if (!empty($_SESSION['ctform']['captcha_error'])) {
												// error html to show in captcha output
												$options['error_html'] = $_SESSION['ctform']['captcha_error'];
											  }

											  echo "<div id='captcha_container_1' class='text-center'>\n";
											  echo Securimage::getCaptchaHtml($options);
											  echo "\n</div>\n";
										 ?>
			 							
							
								                           
			                           
			                        </div>
			                    </div>
			
								<div class="text-center"><button type="submit" class="btn btn-info btn-lg"><span class="fa fa-sign-in fa-pull-left fa-2x"> Conectar</span></button></div>
			                    <!-- For success/fail messages -->
			                    
			                    <?php if(isset($values['error']) and $values['error']!=''):?>
			                    	
			                    	<div id="" class="alert alert-danger"><?php echo $values['error'];?></div>
			                    <?php endif;?>
			                </form>
				  </div>
				</div>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><!--footer-->
                                        <div class="well well-sm">Desarrollado por: <?php echo development_by;?> - <?php echo version;?></div>
                                </div><!--fin footer-->                
            </div>
        	<div class="col-sm-4 col-md-4 col-lg-4">
        	</div>

<?php include("../view_footer.php");?>		