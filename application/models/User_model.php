<? 

class User_model extends CI_Model {


    public function inserts($data){
      
        $this->db->set($data);
        $this->db->insert('users');

    }

    public function selects($params, $key, $value){
      
        $this->db->select($params);
        $this->db->where($key, $value);
        $query = $this->db->get('users');
        return $query;
    }

    public function updates($data, $key, $value){
      
        $this->db->set($data);
        $this->db->where($key, $value);
        $this->db->update('users');

    }

    
}
?>