<?php

/*
 * Model for querying the class table
 */

    class Class_model extends CI_Model
    {
        
        //Get all data from the class table
        public function get_all_class()
        {
            $query = $this->db->query('SELECT * FROM class');
            return $query->result();
        }
        
        
        //Get class name field from the table
        //based on their id
        public function get_class_name($id)
        {
            $query = $this->db->query("SELECT class_name FROM class WHERE class_id = '$id'");
            
            if($query->num_rows() > 0)
            {
                $row = $query->row(1);
                return $row->class_name;
            }
        }
        
    }
