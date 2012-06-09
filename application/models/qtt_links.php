<?php

/*
 * Model for querying the qtt_links table
 */

    class Qtt_links extends CI_Model
    {
        
        //Insert values to the table
        //INSERT IGNORE is used to prevent duplicate values entered
        public function insert_qtt_links($qtt_id, $class_id)
        {
            $query = $this->db->query("INSERT IGNORE INTO qtt_links (qtt_id,class_id) VALUES ('$qtt_id', '$class_id')");
            return $query;
        }
        
        
        //Get data from the table
        public function get_qtt_links()
        {
            $query = $this->db->query('SELECT qtt_links.qtt_id, qtt_links.class_id, qtt.qtt_name, qtt_links.status, class.class_name
                                       FROM qtt_links
                                       JOIN class ON qtt_links.class_id = class.class_id
                                       JOIN qtt ON qtt_links.qtt_id = qtt.qtt_id
                                       ORDER BY qtt_links.class_id ASC');
            return $query->result();
        }
        
        
        //Query the table
        //SELECT DISTINCT is used to remove duplicate qiery result
        public function query_qtt_links($class_id)
        {
            $query = $this->db->query("SELECT DISTINCT qtt_links.qtt_id, qtt_links.class_id, qtt.qtt_name, class.class_name
                                       FROM qtt_links
                                       JOIN qtt ON qtt_links.qtt_id = qtt.qtt_id
                                       JOIN class ON qtt_links.class_id = class.class_id
                                       WHERE qtt_links.class_id = '$class_id'");
            return $query->result();
        }
        
        
        //Update the table
        //Insert the value for the status field
        public function update_status($qtt_id,$status)
        {
            $query = $this->db->query("UPDATE qtt_links SET status = '$status' WHERE qtt_id = '$qtt_id'");
            return $query;
        }
    }