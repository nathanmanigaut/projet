<? 

class Game_model extends CI_Model {

    private $table = 'games';

    public function inserts($data){
      
        $this->db->set($data);
        $this->db->insert($table);

    }

    public function selects($params, $key, $value){
      
        $this->db->select($params);
        $this->db->where($key, $value);
        $query = $this->db->get($table);
        return $query;
    }

    public function updates($data, $key, $value){
      
        $this->db->set($data);
        $this->db->where($key, $value);
        $this->db->update($table);

    }

    public function gets(){

        $query = $this->db->get($table);
        return $query;
    }
    
}
?>