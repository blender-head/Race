<?php

/*
 * Model for querying the qtt table
 */

    class Qtt_model extends CI_Model
    {
        
        //Get all data from the table
        public function get_all_qtt()
        {
            $query = $this->db->query('SELECT * FROM qtt ORDER BY qtt_id ASC');
            return $query->result();
        }
        
        
        //Get the name of the qtt
        //based on their qtt id
        public function get_qtt_by_name($id) 
        {
            $query = $this->db->query("SELECT qtt_name FROM qtt WHERE qtt_id = '$id'");
            if($query->num_rows() > 0)
            {
                $row = $query->row(1);
                return $row->qtt_name;
            }
        }
    }
