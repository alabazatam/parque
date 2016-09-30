    <table class="table table-responsive table-bordered table-striped bg-success" id="solicitudes_invitados_list_<?php echo $values['id_solinvi']?>">
        <tr>
            <th>Nacionalidad</th>
            <th>Cédula</th>
            <th>Parentesco</th>
            <th>Acciones</th>
        </tr>


        <tr>
            <td>
                <select class="form-control input-sm" name="nacion[<?php echo $values['id_solinvi']?>]" id="nacion_<?php echo $values['id_solinvi']?>" onchange="updateSolicitudesInvitados(<?php echo $values['id_solinvi'];?>,'nacion_<?php echo $values['id_solinvi'];?>','nacion')">
                    <option value="V">V</option>
                    <option value="E">E</option>
                </select>
				<div id="mensaje_nacion_<?php echo $values['id_solinvi']?>" class="mess text-right"></div>
            </td>
            <td>
                <input class="form-control input-sm" placeholder="Cédula" type="text" maxlength="9"  name="cedula[<?php echo $values['id_solinvi']?>]" id="cedula_<?php echo $values['id_solinvi']?>" size="" onchange="updateSolicitudesInvitados(<?php echo $values['id_solinvi'];?>,'cedula_<?php echo $values['id_solinvi'];?>','cedula')">
				<div id="mensaje_cedula_<?php echo $values['id_solinvi']?>" class="mess text-right"></div>
			</td>
            <td>
                <select class="form-control input-sm" name="id_parentesco[<?php echo $values['id_solinvi']?>]" id="id_parentesco_<?php echo $values['id_solinvi']?>" onchange="updateSolicitudesInvitados(<?php echo $values['id_solinvi'];?>,'id_parentesco_<?php echo $values['id_solinvi'];?>','id_parentesco')">
					<?php if(isset($parentescos_list)):?>
						<?php foreach($parentescos_list as $list):?>
								<option value="<?php echo $list['id_parentesco']?>"><?php echo $list['nom_parentesco']?></option>
						<?php endforeach;?>
					<?php endif;?>
				</select>
				<div id="mensaje_id_parentesco_<?php echo $values['id_solinvi']?>" class="mess text-right"></div>
            </td>
            <td><a onclick="deleteSolicitudesInvitados(<?php echo $values['id_solinvi']?>)"  class="btn btn-danger desactivar">Eliminar</a></td>
        </tr>
        <tr>
            <th>Primer nombre</th>
            <th>Segundo nombre</th>
            <th>Primer apellido</th>
            <th>Segundo apellido</th>
            
        </tr>
        <tr>
            <td>
                <input class="form-control input-sm" placeholder="Primer nombre" type="text"  name="nombre1[<?php echo $values['id_solinvi']?>]" id="nombre1_<?php echo $values['id_solinvi']?>" size="" onchange="updateSolicitudesInvitados(<?php echo $values['id_solinvi'];?>,'nombre1_<?php echo $values['id_solinvi'];?>','nombre1')">
				<div id="mensaje_nombre1_<?php echo $values['id_solinvi']?>" class="mess text-right"></div>
			</td>
            <td>
                <input class="form-control input-sm" placeholder="Segundo nombre" type="text"  name="nombre2[<?php echo $values['id_solinvi']?>]" id="nombre2_<?php echo $values['id_solinvi']?>" size="" onchange="updateSolicitudesInvitados(<?php echo $values['id_solinvi'];?>,'nombre2_<?php echo $values['id_solinvi'];?>','nombre2')">
				<div id="mensaje_nombre2_<?php echo $values['id_solinvi']?>" class="mess text-right"></div>
			</td>
            <td>
                <input class="form-control input-sm" placeholder="Primer apellido" type="text"  name="apellido1[<?php echo $values['id_solinvi']?>]" id="apellido1_<?php echo $values['id_solinvi']?>" size="" onchange="updateSolicitudesInvitados(<?php echo $values['id_solinvi'];?>,'apellido1_<?php echo $values['id_solinvi'];?>','apellido1')">
				<div id="mensaje_apellido1_<?php echo $values['id_solinvi']?>" class="mess text-right"></div>
			</td>
            <td>
                <input class="form-control input-sm" placeholder="Segundo apellido" type="text"  name="apellido2[<?php echo $values['id_solinvi']?>]" id="apellido2_<?php echo $values['id_solinvi']?>" size="" onchange="updateSolicitudesInvitados(<?php echo $values['id_solinvi'];?>,'apellido2_<?php echo $values['id_solinvi'];?>','apellido2')">
				<div id="mensaje_apellido2_<?php echo $values['id_solinvi']?>" class="mess text-right"></div>
			</td>
            
            
        </tr>
        
        
    </table>