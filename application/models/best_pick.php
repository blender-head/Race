<?php

/*
 * Model for querying the best_pick table
 */

    class Best_pick extends CI_Model
    {
        
        //Insert the racer's pick number
        //Exclusively used fot Best race type
        public function insert_best_pick($class_id, $qtt_id, $pick = 0)
        {
            $query = $this->db->query("INSERT INTO best_pick(class_id,qtt_id,pick) VALUES ('$class_id','$qtt_id','$pick')");
            return $query;
        }
        
        
        //Get the pick value from the table
        public function get_pick($qtt_id,$class_id)
        {
            $query = $this->db->query("SELECT pick FROM best_pick WHERE qtt_id = '$qtt_id' AND class_id = '$class_id'");
            return $query->result();
        }
        
        
        
        
    }