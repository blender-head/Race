<?php

/*
 * Model for querying pengda table
 */

    class Pengda_model extends CI_Model
    {
        
        //Get all data from the table
        public function get_all_pengda()
        {
            $query = $this->db->query('SELECT * FROM pengda');
            return $query->result();
        }
        
    }