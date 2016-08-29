<<<<<<< HEAD
	<div class="container">
		<div class="row">
			<div class="col md-12" id="categorias">
				<h1>Visualização de Categorias</h1>

				<div class="row">
				<?php 
					if($categorias)
					{
						foreach ($categorias as $categoria) 
						{	?>
							
							<div class="col-md-3">
								<img src="<?php echo base_url("assets/uploads/categorias/".$categoria["nome_arquivo"] ); ?>" alt="" class="img-responsive">
								<div class="text-center"> <?php echo $categoria["nome"]; ?> </div>
								<div>  
								<a class="btn btn-danger btn-block" onclick="return confirm('Você deseja apagar esta categoria?')" href="<?php echo base_url("categoria/deletar/". $categoria["id"]); ?>">DELETAR</a>
								</div>
							</div>

						<?php
						}
					}
					else
					{
						echo '<div class="alert alert-danger">Nenhuma categoria cadastrada no momento</div>';
					}
				 ?>

				</div>	
			</div>
		</div>
	</div>
    

=======
	<div class="container">
		<div class="row">
			<div class="col md-12" id="categorias">
				<h1>Visualização de Categorias</h1>

				<div class="row">
				<?php 
					if($categorias)
					{
						foreach ($categorias as $categoria) 
						{	?>
							
							<div class="col-md-3">
								<img src="<?php echo base_url("assets/uploads/categorias/".$categoria["nome_arquivo"] ); ?>" alt="" class="img-responsive">
								<div class="text-center"> <?php echo $categoria["nome"]; ?> </div>
								<div>  
								<a class="btn btn-danger btn-block" onclick="return confirm('Você deseja apagar esta categoria?')" href="<?php echo base_url("categoria/deletar/". $categoria["id"]); ?>">DELETAR</a>
								</div>
							</div>

						<?php
						}
					}
					else
					{
						echo '<div class="alert alert-danger">Nenhuma categoria cadastrada no momento</div>';
					}
				 ?>

				</div>	
			</div>
		</div>
	</div>
    

>>>>>>> 1c647d67ef0a3315d7bdb9e63db9b0c0778bfeda
