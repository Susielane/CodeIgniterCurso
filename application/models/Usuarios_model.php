<meta charset="utf-8">
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

    public function get_usuario($id_usuario)
    {
        $this->db->where("id", $id_usuario); // WHERE  'id' = $id_usuario

        $usuario = $this->db->get('usuarios'); //SELECT * FROM usuario WHERE  id = $id_usuario

        if($usuario->num_rows())
        {
          return $usuario->row_array();
        }
        else
        {
          return FALSE;
        }

    }

    public function get_usuarios()
    {
        $query = $this->db->get('usuarios'); //SELECT * FROM usuarios

        if($query->num_rows())
        {
            return $query->result_array();

        }
        else
        {
            return FALSE;
        }

    }

    public function update_usuario($id_usuario, $usuario_atualizado)
    {
        $this->db->where("id", $id_usuario); //WHERE id = $id_usuario
        $this->db->update("usuarios", $usuario_atualizado); //UPTADE 'usuarios' SET {{indice}} = {{valor}}

        if($this->db->affected_rows())
        {
         return TRUE;   
        }
        else
        {
            return FALSE;
        }

    }

    public function delete_usuario($id_usuario)
    {
        $this->db->where('id', $id_usuario); // WHERE  'id' = $id_usuario
        $this->db->delete('usuarios'); //DELETE FROM 'usuarios'  WHERE  'id' = $id_usuario

        if($this->db->affected_rows())
        {
         return TRUE;   
        }
        else
        {
         return FALSE;
        }

    }

    public function create_usuario($dados_usuario)
    {
        $this->db->insert('usuarios', $dados_usuario);
        return $this->db->affected_rows() ? TRUE : FALSE;

    }

    public function check_login($email, $senha)
    {
        // Definindo o parâmetro FROM
        $this->db->from('usuarios');
        // Definindo o parâmetro WHERE
        $this->db->where('email', $email);
        $this->db->where('senha', $senha);
        $usuarios = $this->db->get();
        
        //Executando a QUERY no banco de dados
        if($usuarios->num_rows())
        {
          $usuario = $usuarios-> result_array();
          return $usuario[0];
        }
        else
        {
          return FALSE;
        }
    
    }
}
