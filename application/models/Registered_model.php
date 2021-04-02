<? 

class Registered_model extends CI_Model {


    public function inserts($data){
      
        $this->db->set($data);
        $this->db->insert('registered');

    }

    public function selects($params, $key, $value){
      
        $this->db->select($params);
        $this->db->where($key, $value);
        $query = $this->db->get('registered');
        return $query;
    }

    public function updates($data, $key, $value){
      
        $this->db->set($data);
        $this->db->where($key, $value);
        $this->db->update('registered');

    }

    public function gets(){

        $query = $this->db->get('registered');
        return $query;
    }
    
}
?>