<div class="col-sm-12 col-md-12">

<?php $i = 1;?>
<?php if(isset($solicitudes_invitados_list)):?>
      <table class="table table-responsive table-bordered table-striped" id="solicitudes_invitados_list_<?php echo $list['id_solinvi']?>">
        <tr>
            <th>#</th>
            <th>Nacionalidad</th>
            <th>Cédula</th>
            <th>Parentesco</th>
            <th>Primer nombre</th>
            <th>Segundo nombre</th>
            <th>Primer apellido</th>
            <th>Segundo apellido</th>
        </tr>  
	<?php foreach($solicitudes_invitados_list as $list):?>
        <tr>
            <td><?php echo $i;?></td>
            <td><?php echo $list['nacion']?></td>
            <td><?php echo $list['cedula']?></td>
            <td><?php echo $list['id_parentesco']?></td>
            <td><?php echo $list['nombre1']?></td>
            <td><?php echo $list['nombre2']?></td>
            <td><?php echo $list['apellido1']?></td>
            <td><?php echo $list['apellido2']?></td>
        </tr> 
        <?php $i++;endforeach;?>
        </table>
<?php endif;?>
    <div class="col-sm-4 col-sm-8 col-md-4 col-md-8 alert alert-info">
        Total de invitados: <?php echo $i;?>
    </div>
</div>