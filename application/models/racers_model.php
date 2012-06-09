<?php

/*
    This is the model for operating
    over the racer table
*/

    class Racers_model extends CI_Model
    {
        
        //Get all racer from racers table
        public function list_all()
        {
            $query = $this->db->query("SELECT racer.id, racer.racer_number, racer.racer_name, racer.racer_pengda, racer.racer_team, racer.racer_vehicle, pengda.pengda_name, 
                                       class.class_name FROM racer 
                                       JOIN class ON racer.racer_class = class.class_id 
                                       JOIN pengda ON racer.racer_pengda = pengda.pengda_id
                                       ORDER BY racer_number");
            return $query->result();
        }
        
        
        //Add data to the racer table
        public function add_racer($racer_number, $racer_name, $racer_pengda, $racer_team, $racer_vehicle, $racer_class)
        {
            $query = $this->db->query("INSERT INTO racer 
                                      (racer_number, racer_name, racer_pengda, racer_team, racer_vehicle, racer_class)
                                      VALUES ('$racer_number', '$racer_name', '$racer_pengda', '$racer_team', '$racer_vehicle', '$racer_class')
                                      ");
            return $query;
        }
        
        
        //Query the racer and racer_add_class table
        //Select the racer by their class
        public function list_racer_by_class($id)
        {
            $query = $this->db->query("(SELECT racer.id, racer.racer_number, racer.racer_name, racer.racer_pengda, 
                                       racer.racer_team, racer.racer_vehicle, pengda.pengda_id, 
                                       pengda.pengda_name, class.class_name, class.class_id
                                       FROM racer JOIN class ON racer.racer_class = class.class_id 
                                       JOIN pengda ON racer.racer_pengda = pengda.pengda_id
                                       WHERE racer.racer_class = '$id')
                                       UNION
                                       (SELECT racer_add_class.id, racer_add_class.racer_number, racer_add_class.racer_name, racer_add_class.racer_pengda, 
                                       racer_add_class.racer_team, racer_add_class.racer_vehicle, pengda.pengda_id, 
                                       pengda.pengda_name, class.class_name, class.class_id
                                       FROM racer_add_class JOIN class ON racer_add_class.racer_class = class.class_id 
                                       JOIN pengda ON racer_add_class.racer_pengda = pengda.pengda_id
                                       WHERE racer_add_class.racer_class = '$id')
                                       ORDER BY racer_number ASC");
            return $query->result();
            
        }
        
        
        //Update the racer table
        //Set the qtt id for the racer id specified
        public function input_qtt($qtt_id, $racer_id)
        {
            $query = $this->db->query("UPDATE racer SET qtt_id = '$qtt_id' WHERE racer_id ='$racer_id'");
            return $query;
        }
        
        
        //Update the racer table
        //Set the racer's race type
        public function input_race_type($id, $racer_id)
        {
            $query = $this->db->query("UPDATE racer SET race_type = '$id' WHERE racer_id ='$racer_id'");
            return $query;
        }
        
        
        //Query the racer table
        //Display the racer based on their qtt
        public function list_racer_by_qtt($qtt_id, $class_id)
        {
            $query = $this->db->query("SELECT race_summary.id, race_summary.racer_id, race_summary.racer_name,
                                       race_summary.racer_pengda, race_summary.racer_team, race_summary.racer_vehicle,
                                       qtt.qtt_name, class.class_name, pengda.pengda_name, race_type.race_type_name, 
                                       class.class_id, qtt.qtt_id, race_type.race_type_id,
                                       race_summary.point_one, race_summary.point_two, race_summary.total_point
                                       FROM race_summary
                                       JOIN pengda ON race_summary.racer_pengda = pengda.pengda_id
                                       JOIN qtt ON race_summary.qtt_id = qtt.qtt_id
                                       JOIN class ON race_summary.class_id = class.class_id
                                       JOIN race_type ON race_summary.race_type = race_type.race_type_id
                                       WHERE race_summary.qtt_id = '$qtt_id'
                                       AND race_summary.class_id = '$class_id'
                                       ORDER BY race_summary.racer_id ASC");
            return $query->result();
        }
        
        
        //Select the racer's data
        //based on their id, use to display racer's data on the edit and update form
        public function list_racer_by_id ($id)
        {
            $query = $this->db->query("SELECT racer_number, racer_name, racer_team, racer_vehicle FROM racer WHERE racer_number = '$id'");
            return $query->result();
        }
        
        
        //Update the racer table
        public function update_racer_model($id, $racer_name, $racer_pengda, $racer_team, $racer_vehicle, $racer_class)
        {
            $query = $this->db->query("UPDATE racer SET racer_number = '$id', racer_name = '$racer_name', 
                                       racer_pengda = '$racer_pengda', racer_team = '$racer_team', racer_vehicle = '$racer_vehicle',
                                       racer_class = '$racer_class'
                                       WHERE racer_number = '$id'
                                       
                                        ");
            return $query;
        }
        
        
        //Get the racer pengda id from the racer table
        public function get_racer_pengda($racer_number)
        {
            $query = $this->db->query("SELECT racer_pengda, pengda_name FROM racer 
                                       JOIN pengda ON racer_pengda = pengda_id
                                       WHERE racer_number = '$racer_number'");
            return $query->row(1);
        }
        
        
        //Get the racer's class
        public function get_racer_class($racer_number)
        {
            $query = $this->db->query("SELECT racer_class, class_name FROM racer JOIN class ON racer_class = class_id
                                       WHERE racer_number = '$racer_number'");
            return $query->row(1);
        }
        
        //Get the racer's name, bases on their id
        public function get_racer($id)
        {
            $query = $this->db->query("SELECT racer_name FROM racer WHERE racer_number = '$id'");
            return $query->result();
        }
        
        
        //Delete racer by their id
        public function delete_racer($racer_number)
        {
            $query = $this->db->query("DELETE FROM racer WHERE racer_number = '$racer_number'");
            return $query;
        }
        
    }
