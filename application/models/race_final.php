<?php

    class Race_final extends CI_Model
    {
        
        public function query_final_result()
        {
            $query = $this->db->query('SELECT race_final.class_id, race_final.race_type, class.class_name FROM race_final
                                       JOIN class ON race_final.class_id = class.class_id');
            return $query->result();
        }
        
        public function insert_final_report_best($racer_id, $class_id, $racer_name, $racer_pengda, $racer_team, $racer_vehicle, $qtt_id, $race_type, $time, $ranking, $laps, $race_num)
        {
            $query = $this->db->query("INSERT INTO race_final(racer_id, class_id, racer_name, racer_pengda, racer_team, racer_vehicle, qtt_id, race_type, time, ranking, laps, race_num) 
                                       VALUES 
                                       ('$racer_id', '$class_id', '$racer_name', '$racer_pengda', '$racer_team', '$racer_vehicle', '$qtt_id', '$race_type', '$time', '$ranking', '$laps', '$race_num')
                                       ");
            return $query;
        }
        
        public function insert_final_report_point($racer_id, $class_id, $racer_name, $racer_pengda, $racer_team, $racer_vehicle, $qtt_id, $race_type, $time, $point_one, $point_two, $total, $laps, $race_num)
        {
            $query = $this->db->query("INSERT INTO race_final(racer_id, class_id, racer_name, racer_pengda, racer_team, racer_vehicle, qtt_id, race_type, time, point_one, point_two, total_point, laps, race_num) 
                                       VALUES 
                                       ('$racer_id', '$class_id', '$racer_name', '$racer_pengda', '$racer_team', '$racer_vehicle', '$qtt_id', '$race_type', '$time', '$point_one', '$point_two', '$total', '$laps', '$race_num')
                                       ");
            return $query;
        }
        
        public function insert_final_report_grid($racer_id, $class_id, $racer_name, $racer_pengda, $racer_team, $racer_vehicle, $qtt_id, $race_type, $time, $grid, $laps, $race_num)
        {
            $query = $this->db->query("INSERT INTO race_final(racer_id, class_id, racer_name, racer_pengda, racer_team, racer_vehicle, qtt_id, race_type, time, grid, laps, race_num) 
                                       VALUES 
                                       ('$racer_id', '$class_id', '$racer_name', '$racer_pengda', '$racer_team', '$racer_vehicle', '$qtt_id', '$race_type', '$time', '$grid', '$laps', '$race_num')
                                       ");
            return $query;
        }
        
                
        public function get_final_result($class_id, $race_type)
        {
            $query = $this->db->query("SELECT race_final.racer_id, race_final.class_id, race_final.racer_name, race_final.racer_pengda,
                                      race_final.racer_team, race_final.racer_vehicle, race_final.time, race_final.ranking, race_final.race_type,
                                      race_final.grid, race_final.point_one, race_final.point_two, race_final.total_point, race_final.qtt_id,
                                      race_final.laps, race_final.race_num, pengda.pengda_name, class.class_name, race_type.race_type_name
                                      FROM race_final
                                      JOIN race_type ON race_final.race_type = race_type.race_type_id
                                      JOIN pengda ON race_final.racer_pengda = pengda.pengda_id
                                      JOIN class ON race_final.class_id = class.class_id
                                      WHERE race_final.class_id = '$class_id' AND race_final.race_type = '$race_type'
                                      ORDER BY race_final.ranking, race_final.total_point ASC");
            return $query->result();
        }
        
    }