
    <div class="container">
      <div class="row">
        <div class="page-header">
          <h1>Área de Login <small>Faça seu login</small></h1>
        </div>
        <div class="col-md-4 col-md-offset-4">
          <?php if($alerta != null){?>
          <div class="alert alert-<?php echo $alerta['class']; ?>">
            <?php echo $alerta["mensagem"];?>
          </div>
          <?php }?>
          <form action="<?php echo base_url('conta/entrar'); ?>" method="post">
            <input type="hidden"  name="captcha">
            <div class="form-group">
              <label for="email">Email </label>
              <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="<?php echo set_value('email'); ?>" required>
            </div>
            <div class="form-group">
              <label for="senha">Senha</label>
              <input type="password" name="senha" class="form-control" id="senha" placeholder="Senha" value="<?php echo set_value('senha'); ?>"required>
            </div>
            
            
            <button type="submit" name="entrar" value="entrar" class="btn btn-success pull-right">Entrar</button>
            
          </form>
        </div>
      </div>
    </div>
    
    