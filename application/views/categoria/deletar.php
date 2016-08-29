

  	<div class="container">
  		<div class="row">
  			<div class="col-md-12">
  				<h1>Deletar Usuários</h1>

  				<?php if($alerta) {?>
  					<div class="alert alert-<?php echo $alerta["class"]; ?>"> 
  						<?php echo $alerta["mensagem"]; ?>
  					</div>
  					<?php } ?>

  				</div>
  				<div class="col-sm-4">
  					<a href="<?php echo base_url('categoria/visualizar_todos'); ?>" type="submit" class="btn btn-default" >Voltar</a>
  				</div>
  			</div>
  	</div>

