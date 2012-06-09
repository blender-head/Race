<?php

    class Racer_add_class extends CI_Model
    {
        
        public function insert_additional_class($racer_number, $racer_name, $racer_pengda, $racer_team, $racer_vehicle, $racer_class)
        {
            $query = $this->db->query("INSERT INTO racer_add_class
                                       (racer_number, racer_name, racer_pengda, racer_team, racer_vehicle, racer_class)
                                       VALUES ('$racer_number', '$racer_name', '$racer_pengda', '$racer_team', '$racer_vehicle', '$racer_class')
                                       ");
            return $query;
        }
        
        public function list_racer_by_class($id)
        {
            $query = $this->db->query("SELECT racer_add_class.racer_number, racer_add_class.racer_name, racer_add_class.racer_pengda, 
                                       racer_add_class.racer_team, racer_add_class.racer_vehicle, pengda.pengda_id, 
                                       pengda.pengda_name, class.class_name, class.class_id
                                       FROM racer_add_class JOIN class ON racer_add_class.racer_class = class.class_id 
                                       JOIN pengda ON racer_add_class.racer_pengda = pengda.pengda_id
                                       WHERE class.class_id = '$id' ORDER BY racer_number ASC");
            return $query->result();
            
        }
        
        public function query_the_table()
        {
            $query = $this->db->query('SELECT * FROM racer_add_class');
            return $query->result();
        }
        
        public function select_racer($id)
        {
            $query = $this->db->query("SELECT * FROM racer_add_class WHERE racer_number = '$id'");
            return $query->result();
        }
        
         public function delete_racer($racer_number)
        {
            $query = $this->db->query("DELETE FROM racer_add_class WHERE racer_number = '$racer_number'");
            return $query;
        }
        
        public function select_class_id($racer_number)
        {
            $query = $this->db->query("SELECT racer_class FROM racer_add_class WHERE racer_number = '$racer_number'");
            return $query->result();
        }
        
        public function update_data($racer_number, $racer_name, $racer_pengda, $racer_team, $racer_vehicle, $racer_class)
        {
            $query = $this->db->query("UPDATE racer_add_class
                                       SET racer_number = '$racer_number', racer_name = '$racer_name', racer_pengda = '$racer_pengda', 
                                       racer_team = '$racer_team', racer_vehicle = '$racer_vehicle', racer_class = '$racer_class'
                                       WHERE racer_number = '$racer_number'");
            return $query;
        }
        
        public function select_racer_class($id)
        {
            $query = $this->db->query("SELECT racer_class FROM racer_add_class WHERE racer_number = '$id'");
            return $query->result();
        }
        
        public function delete_class($racer_number,$racer_class)
        {
            $query = $this->db->query("DELETE FROM racer_add_class WHERE racer_number = '$racer_number'
                                       AND racer_class = '$racer_class'");
            return $query;
        }
        
    }
