	<div class="container">
		<div class="row">
			<div class="col md-12"><h1>Visualização de Usuários</h1></div>
			<div class="table-responsive">
			  <table class="table">
			    <thead>
			    	<tr>
			    		<th>ID</th>
			    		<th>E-MAIL</th>
			    		<th>DATA DE CRIAÇÃO</th>
			    		<th>AÇÕES</th>
			    	</tr>
			    </thead>
			    <tbody>
			    	<?php 
			    		if($usuarios){
			    			foreach ($usuarios as $usuario) { 
			    	?>
			    		
						<tr>
							<td> <?php echo $usuario["id"]; ?> </td>
							<td> <?php echo $usuario["email"]; ?> </td>
							<td> <?php echo $usuario["created"]; ?> </td>
							<td><a class="btn btn-default" href=" <?php echo base_url('usuario/editar/'.$usuario["id"]); ?>"><i class="glyphicon glyphicon-pencil"></i></a> 
								<a class="btn btn-danger" href="<?php echo base_url('usuario/deletar/'. $usuario["id"]); ?>" onclick="return confirm('Deseja deletar este usuário?'); "><i class="glyphicon glyphicon-trash"></i></a></td>

						</tr>

			    	<?php 
			    		  } //end foreach
			    		} else {
			    	 ?> 

			    	 <tr>
			    	 	<td colspan="3" class="text-center">Não há usuários cadastrados.</td>
			    	 </tr>

			    	 <?php 
			    	 	} //end if
			    	 ?>
			    </tbody>
			  </table>
			</div>
		</div>
	</div>
    

