
	<div class="col-sm-12 col-md-12" >
		<div class="col-sm-3 col-md-4">
			<pre><label>Funcionario:</label> <?php echo $data['first_name'];?> <?php echo $data['first_last_name'];?></pre>
		</div>
		<div class="col-sm-3 col-md-4">
			<pre><label>Ubicación administrativa:</label> <?php echo $data['nom_ubicacion'];?></pre>
		</div>
		<div class="col-sm-3 col-md-2">
			<pre><label>Fecha de solicitud:</label> <?php echo $data['fec_solicitud'];?></pre>
		</div>
		<div class="col-sm-3 col-md-2">
			<pre><label>Fecha de reservación:</label> <?php echo $data['fec_reservacion'];?></pre>
		</div>
	</div>
	<div class="col-sm-12 col-md-12" >
		<div class="col-sm-3 col-md-4">
			<pre><label>Motivo:</label> <?php echo $data['motivo'];?></pre>
		</div>
	</div>
<?php //print_r($data);?>