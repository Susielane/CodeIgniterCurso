<<<<<<< HEAD
	
	<div class="container">
		<div class="row">
			<div class="col md-12"><h1>Editar Usuário</h1></div>

			<?php if($alerta) {?>

			<div class="alert alert-<?php echo $alerta["class"]; ?>"> 
				<?php echo $alerta["mensagem"]; ?>
			</div>

			<?php } ?>

			<?php if($usuario){ ?>
                <form class="form-horizontal" action="<?php echo base_url("usuario/editar/".$usuario["id"]); ?>" method="post">
                <input type="hidden" name="captcha" >
                <input type="hidden" name="id_usuario" value="<?php echo $usuario["id"]; ?>" >
				<div class="form-group">
			    <label for="email" class="col-sm-2 control-label">Email</label>
			    <div class="col-sm-10">
			      <input type="email" name="email" class="form-control" id="email" placeholder="Email" value=" <?php echo  set_value('email') ? set_value('email') : $usuario["email"]; ?>" required>
			    </div>
			  </div>
              <div class="form-group">
                <label for="senha" class="col-sm-2 control-label">Senha</label>
                <div class="col-sm-10">
                  <input type="password" name="senha" class="form-control" id="senha" placeholder="Senha" required>
                </div>
              </div>
              <div class="form-group">
                <label for="confirmar_senha" class="col-sm-2 control-label">Confirmar Senha</label>
                <div class="col-sm-10">
                  <input type="password" name="confirmar_senha" class="form-control" id="confirmar_senha" placeholder="Confirmar Senha" >
                </div>
              </div>
			 
			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-4">
			      <a href="<?php echo base_url('usuario/visualizar_todos'); ?>" type="submit" class="btn btn-default" >Voltar</a>
			    </div>
                <div class="col-sm-offset-2 col-sm-4">
                  <button type="submit" name="editar" value="editar" class="btn btn-success pull-right">Finalizar Edição</button>
                </div>
			  </div>




			</form>
			<?php } ?>
		</div>
	</div>
    
=======
	
	<div class="container">
		<div class="row">
			<div class="col md-12"><h1>Editar Usuário</h1></div>

			<?php if($alerta) {?>

			<div class="alert alert-<?php echo $alerta["class"]; ?>"> 
				<?php echo $alerta["mensagem"]; ?>
			</div>

			<?php } ?>

			<?php if($usuario){ ?>
                <form class="form-horizontal" action="<?php echo base_url("usuario/editar/".$usuario["id"]); ?>" method="post">
                <input type="hidden" name="captcha" >
                <input type="hidden" name="id_usuario" value="<?php echo $usuario["id"]; ?>" >
				<div class="form-group">
			    <label for="email" class="col-sm-2 control-label">Email</label>
			    <div class="col-sm-10">
			      <input type="email" name="email" class="form-control" id="email" placeholder="Email" value=" <?php echo  set_value('email') ? set_value('email') : $usuario["email"]; ?>" required>
			    </div>
			  </div>
              <div class="form-group">
                <label for="senha" class="col-sm-2 control-label">Senha</label>
                <div class="col-sm-10">
                  <input type="password" name="senha" class="form-control" id="senha" placeholder="Senha" required>
                </div>
              </div>
              <div class="form-group">
                <label for="confirmar_senha" class="col-sm-2 control-label">Confirmar Senha</label>
                <div class="col-sm-10">
                  <input type="password" name="confirmar_senha" class="form-control" id="confirmar_senha" placeholder="Confirmar Senha" >
                </div>
              </div>
			 
			  <div class="form-group">
			    <div class="col-sm-offset-2 col-sm-4">
			      <a href="<?php echo base_url('usuario/visualizar_todos'); ?>" type="submit" class="btn btn-default" >Voltar</a>
			    </div>
                <div class="col-sm-offset-2 col-sm-4">
                  <button type="submit" name="editar" value="editar" class="btn btn-success pull-right">Finalizar Edição</button>
                </div>
			  </div>




			</form>
			<?php } ?>
		</div>
	</div>
    
>>>>>>> 1c647d67ef0a3315d7bdb9e63db9b0c0778bfeda
