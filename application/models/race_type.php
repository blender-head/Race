<?php

    class Race_type extends CI_Model
    {
        
        public function get_all_type()
        {
            $query = $this->db->query("SELECT * FROM race_type");
            return $query->result();
        }
        
        public function get_type_name($id)
        {
            $query = $this->db->query("SELECT race_type_name FROM race_type WHERE race_type_id = '$id'");
            
            if($query->num_rows() > 0)
            {
                $row = $query->row(1);
                return $row->race_type_name;
            }
        }
    }
