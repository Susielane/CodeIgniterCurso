<meta charset="utf-8">
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends CI_Controller {
 
 

	public function __construct()
  {
      parent::__construct();

      //Verifica se A categoria NÃO está logado e redireciona para a autenticação.
      if(!$this->session->userdata('logado'))
      {
        redirect('conta/entrar');
        
      }
      
  }

  public function index()
  {
    redirect('categoria/visualizar_todos');
  }

  public function visualizar_todos()
  {
    $this->load->model('categorias_model');
    $categorias = $this->categorias_model->get_categorias();
    $dados = array(
      "view"    => 'categoria/visualizar_todos',
      "categorias" => $categorias

    );

    $this->load->view('template', $dados);

  }

  public function cadastrar(){
  
    $alerta = null;

    if($this->input->post('cadastrar') && $this-> input-> post('cadastrar') === 'cadastrar')
    {
      if($this->input->post('captcha')) redirect('conta/entrar');

      //Definir regras de validação
      $this->form_validation->set_rules('nome', 'NOME', 'required');
      

      if($this->form_validation-> run() === TRUE)
      {
          //Nome da Categoria
          $nome = $this->input->post("nome");

          //Trabalhar o upload do arquivo

          //Configurar a biblioteca
          $config["upload_path"] = FCPATH. "assets/uploads/categorias";//para onde vou enviar este arquivo
          $config["allowed_types"] = "jpg|jpeg|gif|png";
          $config["encrypt_name"] = TRUE;

          $this->load->library("upload", $config);

          if($this->upload->do_upload('nome_arquivo'))
          {
            $info_arquivo = $this->upload->data();
            $nome_arquivo = $info_arquivo["file_name"];

            $this->load->model("categorias_model");

            $categoria = array(
                "nome" => $nome,
                "nome_arquivo" => $nome_arquivo
              );



            $cadastrou = $this->categorias_model->create_categoria($categoria);

            if($cadastrou)
            {
              $alerta = array(
                "class" => "success",
                "mensagem" => "Atenção! A categoria FOI cadastrada.</br>"
              );
            }
            else
            {
              $alerta = array(
                "class" => "danger",
                "mensagem" => "Atenção! A categoria não foi cadastrada.</br>"
              );
            }
          }
          else
          {
            $erros = $this->upload->display_errors();
            $alerta = array(
                "class" => "danger",
                "mensagem" => "Atenção! A categoria não foi cadastrada.</br>". $errors
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
      "view"    => 'categoria/cadastrar'
    );
   
    $this->load->view('template', $dados);
  }

  public function editar($id_categoria)
  {

     $alerta = null;
     $categoria = null;
     
     //Converte o id dA categoria para int
     $id_categoria = (int) $id_categoria;

      if($id_categoria) 
      {
        //Carrega o model
        $this->load->model('categorias_model');

        //Verifica se A categoria está cadastrado no banco
        $existe = $this->categorias_model->get_categoria($id_categoria);
        if ($existe) 
        {
          //Armazena em uma variável legível
          $categoria = $existe;

          if($this->input->post('editar') === "editar")
          {

              //Converte TAMBÉM o id dA categoria, que vem do post, para int
              $id_categoria_form = (int) $this ->input-> post('id_categoria');

              if($this->input->post('captcha')) redirect('conta/entrar');
              if($id_categoria !== $id_categoria_form) redirect('conta/entrar');

              //Definir regras de validação
              $this->form_validation->set_rules('email', 'EMAIL', 'required|valid_email');
              $this->form_validation->set_rules('senha', 'SENHA', 'required|min_length[3]|max_length[20]');
              $this->form_validation->set_rules('confirmar_senha', 'CONFIRMAR_SENHA', 'required|min_length[3]|max_length[20]|matches[senha]');

              //Verficar se as regras são atentidas
              if ($this->form_validation->run() === TRUE)
              {
                $categoria_atualizado = array(
                  "email"=> $this->input->post('email'),
                  "senha"=> $this->input->post('senha')
                  );
                
                $atualizou = $this->categorias_model->update_categoria($id_categoria, $categoria_atualizado);

                if($atualizou)
                {

                  //Formulário Inválido
                  $alerta = array(
                    "class" => "success",
                    "mensagem" => "Atenção! A categoria foi atualizado com sucesso!</br>"
                  );

                }
                else
                {
                  //Formulário Inválido
                  $alerta = array(
                    "class" => "danger",
                    "mensagem" => "Atenção! A categoria foi não atualizado. :(</br>"
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
          // Define um valor vazio para A categoria
          $categoria=FALSE;
          
          //Categoria não existe
          $alerta = array(
            "class" => "danger",
            "mensagem" => "Atenção! A categoria informada não está cadastrado.</br>"
          );
        }

      }
      else
      {
        //Categoria inválido
         $alerta = array(
            "class" => "danger",
            "mensagem" => "Atenção! A categoria informada está incorreta.</br>"
          );
      }

      $dados = array(
            "alerta" => $alerta,
            "categoria" => $categoria,
            "view"    => 'categoria/editar'
          );
         
          $this->load->view('template', $dados);

  }

  public function deletar($id_categoria)
  {
     $alerta = null;
     
     //Converte o id da categoria para int
     $id_categoria = (int) $id_categoria;

     if($id_categoria)
     {
        //Carrega o model
        $this->load->model('categorias_model');

        //Verifica se a categoria está cadastrado no banco
        $existe = $this->categorias_model->get_categoria($id_categoria);
        if ($existe) 
        {
          $deletou = $this->categorias_model->delete_categoria($id_categoria);

          if($deletou)
          {
            $arquivo = FCPATH . "assets/uploads/categorias/". $existe["nome_arquivo"];
            if(file_exists($arquivo))
            {
              unlink($arquivo);
            }
            //Categoria deletado com sucesso.
            $alerta = array(
              "class" => "success",
              "mensagem" => "Atenção! A categoria foi escluída.</br>"
            );



          }
          else
          {
            //Categoria não foi excluída.
            $alerta = array(
              "class" => "danger",
              "mensagem" => "Atenção! A categoria não foi escluída!</br>"
            );
          }

        }
        else
        {
          //Categoria não existe
          $alerta = array(
            "class" => "danger",
            "mensagem" => "Atenção! A categoria não foi excluída.</br>"
          );
        }

     }
     else
     {
        //Categoria inválido
         $alerta = array(
            "class" => "danger",
            "mensagem" => "Atenção! A categoria informada está incorreta.</br>"
         );


     }


      
      $dados = array(
        "alerta" => $alerta,
         "view" => 'categoria/deletar'
      );
     
      $this->load->view('template', $dados);

  }


}