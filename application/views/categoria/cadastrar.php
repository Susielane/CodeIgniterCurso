
  	 <div class="container">
  		<div class="row">
  			<div class="col md-12"><h1>Cadastrar Usuário</h1></div>

  			<?php if($alerta) {?>

  				<div class="alert alert-<?php echo $alerta["class"]; ?>"> 
  					<?php echo $alerta["mensagem"]; ?>
  				</div>

  				<?php } ?>

          <?php 
            $array = array(
                "class" => "form-horizontal"
            );
            echo form_open_multipart('categoria/cadastrar', $array); 
          ?>
            <input type="hidden" name="captcha" >
  					<div class="form-group">
  						<label for="nome" class="col-sm-2 control-label">Nome da Categoria</label>
  						<div class="col-sm-10">
  							<input type="text" name="nome" class="form-control" id="nome" placeholder="Nome da Categoria" value="<?php echo set_value('nome') ? set_value('nome') : ''; ?>" required>
  						</div>
  					</div>

  					<div class="form-group">
  						<label for="nome_arquivo" class="col-sm-2 control-label">Imagem da Categoria</label>
  						<div class="col-sm-10">
  							<input type="file" name="nome_arquivo" class="form-control" id="nome_arquivo"  required >
  						</div>
  					</div>

  					<div class="form-group">
  						<div class="col-sm-offset-2 col-sm-4">
  							<a href="<?php echo base_url('categoria/visualizar_todos'); ?>" type="submit" class="btn btn-default" >Voltar</a>
  						</div>
  						<div class="col-sm-offset-2 col-sm-4">
  							<button type="submit" name="cadastrar" value="cadastrar" class="btn btn-success pull-right">Cadastrar</button>
  						</div>
  					</div>




  				</form>

  			</div>
  		</div>

