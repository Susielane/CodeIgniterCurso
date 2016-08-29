<meta charset="utf-8">
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {
 
 

	public function __construct()
  {
      parent::__construct();

      //Verifica se o usuário NÃO está logado e redireciona para a autenticação.
      if(!$this->session->userdata('logado'))
      {
        redirect('conta/entrar');
        
      }
      
  }
  // Exibir informações sobre o nosso sistema

  public function visualizar_todos(){
	
    $alerta = null;

    $this->load->model('usuarios_model');

    $usuarios = $this->usuarios_model->get_usuarios();

     
    $dados = array(
      "alerta" => $alerta,
      "usuarios" => $usuarios,
      "view"    => 'usuario/visualizar_todos'

	  );
	 
    $this->load->view('template', $dados);
  }
	
  public function cadastrar(){
  
    $alerta = null;

    if($this->input->post('cadastrar') && $this-> input-> post('cadastrar') === 'cadastrar')
    {
      if($this->input->post('captcha')) redirect('conta/entrar');

      //Definir regras de validação
      $this->form_validation->set_rules('email', 'EMAIL', 'required|valid_email|is_unique[usuarios.email]');
      $this->form_validation->set_rules('senha', 'SENHA', 'required|min_length[3]|max_length[20]');
      $this->form_validation->set_rules('confirmar_senha', 'CONFIRMAR_SENHA', 'required|min_length[3]|max_length[20]|matches[senha]');

      if($this->form_validation-> run() === TRUE)
      {
          $dados_usuario = array(
            "email" => $this->input->post('email'),
            "senha" => $this->input->post('senha')
          );

          $this->load->model('usuarios_model');
          $cadastrou = $this->usuarios_model->create_usuario($dados_usuario);

          if($cadastrou)
          {
              //Usuário cadastrado
              $alerta = array(
                "class" => "success",
                "mensagem" => "Atenção! O usuário FOI cadastrado com sucesso!"
              );
          }
          else
          {
            //Usuário não cadastrado
            $alerta = array(
                "class" => "danger",
                "mensagem" => "Atenção! O usuário NÃO foi cadastrado..."
              );
          }

      }
      else
      {
        //Formulário inválido
        $alerta = array(
            "class" => "danger",
            "mensagem" => "Atenção! O formulário não foi validado.</br>".validation_errors()
          );
      }
    }

    $dados = array(
      "alerta" => $alerta,
      "view"    => 'usuario/cadastrar'
    );
   
    $this->load->view('template', $dados);
  }

  public function editar($id_usuario)
  {

     $alerta = null;
     $usuario = null;
     
     //Converte o id do usuario para int
     $id_usuario = (int) $id_usuario;

      if($id_usuario) 
      {
        //Carrega o model
        $this->load->model('usuarios_model');

        //Verifica se o usuário está cadastrado no banco
        $existe = $this->usuarios_model->get_usuario($id_usuario);
        if ($existe) 
        {
          //Armazena em uma variável legível
          $usuario = $existe;

          if($this->input->post('editar') === "editar")
          {

              //Converte TAMBÉM o id do usuário, que vem do post, para int
              $id_usuario_form = (int) $this ->input-> post('id_usuario');

              if($this->input->post('captcha')) redirect('conta/entrar');
              if($id_usuario !== $id_usuario_form) redirect('conta/entrar');

              //Definir regras de validação
              $this->form_validation->set_rules('email', 'EMAIL', 'required|valid_email');
              $this->form_validation->set_rules('senha', 'SENHA', 'required|min_length[3]|max_length[20]');
              $this->form_validation->set_rules('confirmar_senha', 'CONFIRMAR_SENHA', 'required|min_length[3]|max_length[20]|matches[senha]');

              //Verficar se as regras são atentidas
              if ($this->form_validation->run() === TRUE)
              {
                $usuario_atualizado = array(
                  "email"=> $this->input->post('email'),
                  "senha"=> $this->input->post('senha')
                  );
                
                $atualizou = $this->usuarios_model->update_usuario($id_usuario, $usuario_atualizado);

                if($atualizou)
                {

                  //Formulário Inválido
                  $alerta = array(
                    "class" => "success",
                    "mensagem" => "Atenção! O usuário foi atualizado com sucesso!</br>"
                  );

                }
                else
                {
                  //Formulário Inválido
                  $alerta = array(
                    "class" => "danger",
                    "mensagem" => "Atenção! O usuário foi não atualizado. :(</br>"
                  );

                }


              } 
              else 
              {
                //Formulário Inválido
                $alerta = array(
                  "class" => "danger",
                  "mensagem" => "Atenção! O formulário não foi validado.</br>".validation_errors()
                );

              }


          }

        }
        else
        {
          // Define um valor vazio para o usuário
          $usuario=FALSE;
          
          //Usuário não existe
          $alerta = array(
            "class" => "danger",
            "mensagem" => "Atenção! O usuário informado não está cadastrado.</br>"
          );
        }

      }
      else
      {
        //Usuário inválido
         $alerta = array(
            "class" => "danger",
            "mensagem" => "Atenção! O usuário informado está incorreto.</br>"
          );
      }

      $dados = array(
            "alerta" => $alerta,
            "usuario" => $usuario,
            "view"    => 'usuario/editar'
          );
         
          $this->load->view('template', $dados);

  }

  public function deletar($id_usuario)
  {
     $alerta = null;
     $usuario = null;
     
     //Converte o id do usuario para int
     $id_usuario = (int) $id_usuario;

     if($id_usuario)
     {
      //Carrega o model
        $this->load->model('usuarios_model');

        //Verifica se o usuário está cadastrado no banco
        $existe = $this->usuarios_model->get_usuario($id_usuario);
        if ($existe) 
        {
          $deletou = $this->usuarios_model->delete_usuario($id_usuario);

          if($deletou)
          {
            //Usuário deletado com sucesso.
            $alerta = array(
              "class" => "danger",
              "mensagem" => "Atenção! O usuário foi escluído.</br>"
            );
          }
          else
          {
            //Usuário não foi excluído.
            $alerta = array(
              "class" => "danger",
              "mensagem" => "Atenção! O usuário ñão foi escluído.</br>"
            );
          }

        }
        else
        {
          //Usuário não existe
          $alerta = array(
            "class" => "danger",
            "mensagem" => "Atenção! O usuário não foi excluído.</br>"
          );
        }

     }
     else
     {
        //Usuário inválido
         $alerta = array(
            "class" => "danger",
            "mensagem" => "Atenção! O usuário informado está incorreto.</br>"
         );


     }


      
      $dados = array(
        "alerta" => $alerta,
         "view" => 'usuario/deletar'
      );
     
      $this->load->view('template', $dados);

  }


}
