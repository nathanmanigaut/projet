<? 

class Team_model extends CI_Model {

    private $table = 'teams';

    public function inserts($data){
      
        $this->db->set($data);
        $this->db->insert('teams');

    }

    public function selects($params, $key, $value){
      
        $this->db->select($params);
        $this->db->where($key, $value);
        $query = $this->db->get('teams');
        return $query;
    }

    public function updates($data, $key, $value){
      
        $this->db->set($data);
        $this->db->where($key, $value);
        $this->db->update('teams');

    }
    public function gets(){

        $query = $this->db->get('teams');
        return $query;
    }
    
}
?>