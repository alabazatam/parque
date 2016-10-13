<?php 
            $Parentescos = new Parentescos();
            $parentescos_list = $Parentescos->getParentescosList();
	
?>


<div class="col-sm-12 col-md-12">
    <a class="btn btn-success" id="add_invitado" onclick="addInvitado();">Agregar</a>	

	
</div>
<div class="col-sm-12 col-md-12" id="result_invitado">
    
<?php if(isset($solicitudes_invitados_list)):?>
	<?php foreach($solicitudes_invitados_list as $list):?>
	
    <table class="table table-responsive table-bordered table-striped bg-success" id="solicitudes_invitados_list_<?php echo $list['id_solinvi']?>">
        <tr>
            <th>
				Nacionalidad <small class="text-danger">(*)</small>
			</th>
            <th>
				Cédula <small class="text-danger">(*)</small>
			</th>
            <th>
				Parentesco <small class="text-danger">(*)</small>
				
			</th>
            <th>Acciones</th>
        </tr>


        <tr>
            <td>
                <input class="form-control input-sm" placeholder="id_solinvi" type="hidden" maxlength="9"  name="id_solinvi[<?php echo $list['id_solinvi']?>]" id="id_solinvi_<?php echo $list['id_solinvi']?>" size="" onchange="updateSolicitudesInvitados(<?php echo $list['id_solinvi'];?>,'id_solinvi_<?php echo $list['id_solinvi'];?>','id_solinvi')" value="<?php if(isset($list['id_solinvi'])) echo $list['id_solinvi']?>">
                <select class="form-control input-sm" name="nacion[<?php echo $list['id_solinvi']?>]" id="nacion_<?php echo $list['id_solinvi']?>" onchange="updateSolicitudesInvitados(<?php echo $list['id_solinvi'];?>,'nacion_<?php echo $list['id_solinvi'];?>','nacion')">
                    <option value="V" <?php if(isset($list['nacion']) and $list['nacion'] == 'V') echo 'selected =  "selected"'?>>V</option>
                    <option value="E" <?php if(isset($list['nacion']) and $list['nacion'] == 'E') echo 'selected =  "selected"'?>>E</option>
                </select>
				<div id="mensaje_nacion_<?php echo $list['id_solinvi']?>" class="mess text-right"></div>
            </td>
            <td>
                <input class="form-control input-sm" placeholder="Cédula" type="text" maxlength="9"  name="cedula[<?php echo $list['id_solinvi']?>]" id="cedula_<?php echo $list['id_solinvi']?>" size="" onchange="updateSolicitudesInvitados(<?php echo $list['id_solinvi'];?>,'cedula_<?php echo $list['id_solinvi'];?>','cedula')" value="<?php if(isset($list['cedula'])) echo $list['cedula']?>">
				<div id="mensaje_cedula_<?php echo $list['id_solinvi']?>" class="mess text-right"></div>
			</td>
            <td>
                <select class="form-control input-sm" name="id_parentesco[<?php echo $list['id_solinvi']?>]" id="id_parentesco_<?php echo $list['id_solinvi']?>" onchange="updateSolicitudesInvitados(<?php echo $list['id_solinvi'];?>,'id_parentesco_<?php echo $list['id_solinvi'];?>','id_parentesco')">
					<?php if(isset($parentescos_list)):?>
                                                                <option value="">Seleccione...</option>
						<?php foreach($parentescos_list as $list2):?>
								<option value="<?php echo $list2['id_parentesco']?>" <?php if($list2['id_parentesco'] == $list['id_parentesco']) echo "selected ='selected'";?>><?php echo $list2['nom_parentesco']?></option>
						<?php endforeach;?>
					<?php endif;?>
				</select>
				<div id="mensaje_id_parentesco_<?php echo $list['id_solinvi']?>" class="mess text-right"></div>
            </td>
            <td><a onclick="deleteSolicitudesInvitados(<?php echo $list['id_solinvi']?>)"  class="btn btn-danger desactivar">Eliminar</a></td>
        </tr>
        <tr>
            <th>Primer nombre <small class="text-danger">(*)</small></th>
            <th>Segundo nombre</th>
            <th>Primer apellido <small class="text-danger">(*)</small></th>
            <th>Segundo apellido</th>
            
        </tr>
        <tr>
            <td>
                <input class="form-control input-sm"  placeholder="Primer nombre" type="text"  name="nombre1[<?php echo $list['id_solinvi']?>]" id="nombre1_<?php echo $list['id_solinvi']?>" size="" onchange="updateSolicitudesInvitados(<?php echo $list['id_solinvi'];?>,'nombre1_<?php echo $list['id_solinvi'];?>','nombre1')" value="<?php if(isset($list['nombre1'])) echo $list['nombre1']?>">
				<div id="mensaje_nombre1_<?php echo $list['id_solinvi']?>" class="mess text-right"></div>
			</td>
            <td>
                <input class="form-control input-sm"  placeholder="Segundo nombre" type="text"  name="nombre2[<?php echo $list['id_solinvi']?>]" id="nombre2_<?php echo $list['id_solinvi']?>" size="" onchange="updateSolicitudesInvitados(<?php echo $list['id_solinvi'];?>,'nombre2_<?php echo $list['id_solinvi'];?>','nombre2')" value="<?php if(isset($list['nombre2'])) echo $list['nombre2']?>">
				<div id="mensaje_nombre2_<?php echo $list['id_solinvi']?>" class="mess text-right"></div>
			</td>
            <td>
                <input class="form-control input-sm"  placeholder="Primer apellido" type="text"  name="apellido1[<?php echo $list['id_solinvi']?>]" id="apellido1_<?php echo $list['id_solinvi']?>" size="" onchange="updateSolicitudesInvitados(<?php echo $list['id_solinvi'];?>,'apellido1_<?php echo $list['id_solinvi'];?>','apellido1')" value="<?php if(isset($list['apellido1'])) echo $list['apellido1']?>">
				<div id="mensaje_apellido1_<?php echo $list['id_solinvi']?>" class="mess text-right"></div>
			</td>
            <td>
                <input class="form-control input-sm"  placeholder="Segundo apellido" type="text"  name="apellido2[<?php echo $list['id_solinvi']?>]" id="apellido2_<?php echo $list['id_solinvi']?>" size="" onchange="updateSolicitudesInvitados(<?php echo $list['id_solinvi'];?>,'apellido2_<?php echo $list['id_solinvi'];?>','apellido2')" value="<?php if(isset($list['apellido2'])) echo $list['apellido2']?>">
				<div id="mensaje_apellido2_<?php echo $list['id_solinvi']?>" class="mess text-right"></div>
			</td>
            
            
        </tr>
        
        
    </table>	
	
	<?php endforeach;?>
	
	
<?php endif;?>
    
</div>