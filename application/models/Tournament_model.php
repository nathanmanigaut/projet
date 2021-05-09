<? 

class Tournament_model extends CI_Model {

    

    public function inserts($data){
      
        $this->db->set($data);
        $this->db->insert('tournament');

    }

    public function selects($params, $key, $value){
      
        $this->db->select($params);
        $this->db->where($key, $value);
        $query = $this->db->get('tournament');
        return $query;
    }

    public function updates($data, $key, $value){
      
        $this->db->set($data);
        $this->db->where($key, $value);
        $this->db->update('tournament');

    }

    public function orderbys($params,$ordre){
        
        $this->db->order_by($params,$ordre);
        $query = $this->db->get('tournament');
        
        return $query;
    }
    
}
?>