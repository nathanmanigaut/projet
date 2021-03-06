<? 

class Match_model extends CI_Model {


    public function inserts($data){
      
        $this->db->set($data);
        $this->db->insert('matchs');

    }

    public function selects($params, $key, $value){
      
        $this->db->select($params);
        $this->db->where($key, $value);
        $query = $this->db->get('matchs');
        return $query;
    }

    public function selects2($params, $key, $value, $key2, $value2 ){
      
        $this->db->select($params);
        $this->db->where($key, $value);
        $this->db->where($key2, $value2);
        $query = $this->db->get('matchs');
        return $query;
    }

    public function selectsOr($params, $key, $value, $key2, $value2 ){
      
        $this->db->select($params);
        $this->db->where($key, $value);
        $this->db->or_where($key2, $value2);
        $query = $this->db->get('matchs');
        return $query;
    }
    
    public function updates($data, $key, $value){
      
        $this->db->set($data);
        $this->db->where($key, $value);
        $this->db->update('matchs');

    }

    public function gets(){

        $query = $this->db->get('matchs');    
        return $query;
    }
    
    public function orderbys($params,$ordre){
        
        $this->db->order_by($params,$ordre);
        $query = $this->db->get('matchs');
        
        return $query;
    }
}
?>