<meta charset="utf-8">
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias_model extends CI_Model {

    public function get_categoria($id_categoria)
    {
        $this->db->where("id", $id_categoria); // WHERE  'id' = $id_categoria

        $categoria = $this->db->get('categorias'); //SELECT * FROM categoria WHERE  id = $id_categoria

        if($categoria->num_rows())
        {
          return $categoria->row_array();
        }
        else
        {
          return FALSE;
        }

    }

    public function get_categorias()
    {
        $query = $this->db->get('categorias'); //SELECT * FROM categorias

        return $query->num_rows() ? $query->result_array() : FALSE;

        
    }

    public function update_categoria($id_categoria, $categoria_atualizado)
    {
        $this->db->where("id", $id_categoria); //WHERE id = $id_categoria
        $this->db->update("categorias", $categoria_atualizado); //UPTADE 'categorias' SET {{indice}} = {{valor}}

        if($this->db->affected_rows())
        {
         return TRUE;   
        }
        else
        {
            return FALSE;
        }

    }

    public function delete_categoria($id_categoria)
    {
        $this->db->where('id', $id_categoria); // WHERE  'id' = $id_categoria
        $this->db->delete('categorias'); //DELETE FROM 'categorias'  WHERE  'id' = $id_categoria

        return $this->db->affected_rows() ? TRUE : FALSE;

    }

    public function create_categoria($dados_categoria)
    {
        $this->db->insert('categorias', $dados_categoria);
        return $this->db->affected_rows() ? TRUE : FALSE;

    }

    public function check_login($email, $senha)
    {
        // Definindo o parâmetro FROM
        $this->db->from('categorias');
        // Definindo o parâmetro WHERE
        $this->db->where('email', $email);
        $this->db->where('senha', $senha);
        $categorias = $this->db->get();
        
        //Executando a QUERY no banco de dados
        if($categorias->num_rows())
        {
          $categoria = $categorias-> result_array();
          return $categoria[0];
        }
        else
        {
          return FALSE;
        }
    
    }
}
