<?php

    class Race_summary extends CI_Model
    {
        
        public function insert_summary($racer_id, $class_id, $racer_name, $racer_pengda, $racer_team, $racer_vehicle, $qtt_id, $race_type, $time, $ranking, $grid, $point_one, $point_two, $total_point, $laps, $race_num)
        {
            $query = $this->db->query("INSERT INTO race_summary(racer_id, class_id, racer_name, racer_pengda, racer_team, racer_vehicle, qtt_id, race_type, time, ranking, grid, point_one, point_two, total_point, laps, race_num) 
                                       VALUES 
                                       ('$racer_id', '$class_id', '$racer_name', '$racer_pengda', '$racer_team', '$racer_vehicle', '$qtt_id', '$race_type', '$time', '$ranking', '$grid', '$point_one', '$point_two', '$total_point', '$laps', '$race_num')
                                       ");
            return $query;
        }
        
        public function update_summary_best($racer_id, $time, $ranking, $laps, $race_num, $pick)
        {
            $query = $this->db->query("UPDATE race_summary SET time = '$time', ranking = '$ranking',
                                       laps = '$laps', race_num = '$race_num', pick = '$pick'
                                       WHERE racer_id = '$racer_id'");
            return $query;
        }
        
        public function update_summary_best_summary($racer_id, $time, $ranking)
        {
            $query = $this->db->query("UPDATE race_summary SET time = '$time', ranking = '$ranking'
                                       WHERE racer_id = '$racer_id'");
            return $query;
        }
        
        public function update_summary_grid($racer_id, $time, $grid, $laps, $race_num)
        {
            $query = $this->db->query("UPDATE race_summary SET time = '$time', grid = '$grid',
                                       laps = '$laps', race_num = '$race_num'
                                       WHERE racer_id = '$racer_id'");
            return $query;
        }
        
        public function update_summary_grid_summary($racer_id, $time, $grid)
        {
            $query = $this->db->query("UPDATE race_summary SET time = '$time', grid = '$grid'
                                       WHERE racer_id = '$racer_id'");
            return $query;
        }
        
        public function update_summary_point($racer_id, $time, $point_one, $point_two, $total, $laps, $race_num)
        {
            $query = $this->db->query("UPDATE race_summary SET time = '$time', point_one = '$point_one',
                                       point_two = '$point_two', total_point = '$total',
                                       laps = '$laps', race_num = '$race_num'
                                       WHERE racer_id = '$racer_id'");
            return $query;
        }
        
      
        public function race_summary_by_class($id)
        {
            $query = $this->db->query("SELECT race_summary.racer_name, race_summary.qtt_id, race_summary.class_id, 
                                       race_summary.race_type, race_summary.race_type, race_type.race_type_name,
                                       class.class_name, qtt.qtt_name FROM race_summary
                                       JOIN class ON race_summary.class_id = class.class_id
                                       JOIN qtt ON race_summary.qtt_id = qtt.qtt_id
                                       JOIN race_type ON race_summary.race_type = race_type.race_type_id
                                       WHERE race_summary.class_id = '$id' ORDER BY qtt.qtt_name ASC");
            return $query->result();
        }
        
        public function race_summary_by_qtt_best($qtt_id, $pick, $class_id)
        {
             $query = $this->db->query("SELECT race_summary.racer_name, race_summary.qtt_id, race_summary.class_id, race_summary.racer_id,
                                       race_summary.ranking, class.class_name, qtt.qtt_name, pengda.pengda_name, race_type.race_type_name, race_summary.pick,
                                       race_summary.time, race_summary.grid, race_summary.point_one, race_summary.point_two, race_summary.total_point,
                                       race_summary.laps, race_summary.race_num, race_summary.race_type, race_summary.racer_team, race_summary.racer_vehicle
                                       FROM race_summary
                                       JOIN class ON race_summary.class_id = class.class_id
                                       JOIN qtt ON race_summary.qtt_id = qtt.qtt_id
                                       JOIN pengda ON race_summary.racer_pengda = pengda.pengda_id
                                       JOIN race_type ON race_summary.race_type = race_type.race_type_id
                                       WHERE race_summary.qtt_id = '$qtt_id' AND race_summary.ranking <= '$pick' 
                                       AND race_summary.class_id = '$class_id'
                                       ORDER BY ranking ASC");
            return $query->result();
        }
        
        public function race_summary_by_qtt_point($qtt_id)
        {
             $query = $this->db->query("SELECT race_summary.racer_name, race_summary.qtt_id, race_summary.class_id, race_summary.racer_id,
                                       race_summary.ranking, class.class_name, qtt.qtt_name, pengda.pengda_name, race_type.race_type_name, race_summary.pick,
                                       race_summary.time, race_summary.grid, race_summary.point_one, race_summary.point_two, race_summary.total_point,
                                       race_summary.laps, race_summary.race_num, race_summary.race_type, race_summary.racer_team, race_summary.racer_vehicle
                                       FROM race_summary
                                       JOIN class ON race_summary.class_id = class.class_id
                                       JOIN qtt ON race_summary.qtt_id = qtt.qtt_id
                                       JOIN pengda ON race_summary.racer_pengda = pengda.pengda_id
                                       JOIN race_type ON race_summary.race_type = race_type.race_type_id
                                       WHERE race_summary.qtt_id = '$qtt_id' ORDER BY point_one,time ASC");
            return $query->result();
        }
        
        public function race_summary_by_qtt_grid($qtt_id)
        {
             $query = $this->db->query("SELECT race_summary.racer_name, race_summary.qtt_id, race_summary.class_id, race_summary.racer_id,
                                       race_summary.ranking, class.class_name, qtt.qtt_name, pengda.pengda_name, race_type.race_type_name, race_summary.pick,
                                       race_summary.time, race_summary.grid, race_summary.point_one, race_summary.point_two, race_summary.total_point,
                                       race_summary.laps, race_summary.race_num, race_summary.race_type, race_summary.racer_team, race_summary.racer_vehicle
                                       FROM race_summary
                                       JOIN class ON race_summary.class_id = class.class_id
                                       JOIN qtt ON race_summary.qtt_id = qtt.qtt_id
                                       JOIN pengda ON race_summary.racer_pengda = pengda.pengda_id
                                       JOIN race_type ON race_summary.race_type = race_type.race_type_id
                                       WHERE race_summary.qtt_id = '$qtt_id' ORDER BY race_summary.grid ASC");
            return $query->result();
        }
        
        public function summary_link($qtt_id, $class_id)
        {
            $query = $this->db->query("SELECT qtt.qtt_name, class.class_name FROM race_summary
                                       JOIN qtt ON race_summary.qtt_id = qtt.qtt_id
                                       JOIN class ON race_summary.class_id = class.class_id
                                       WHERE race_summary.qtt_id = '$qtt_id' AND race_summary.class_id = '$class_id'");
            return $query->result();
        }
        
        public function race_summary_class($class_id)
        {
            $query = $this->db->query("SELECT race_summary.class_id, class.class_name
                                       FROM race_summary
                                       JOIN class ON race_summary.class_id = class.class_id
                                       WHERE race_summary.class_id = '$class_id'");
            return $query->result();
        }
        
        public function query_summary()
        {
            $query = $this->db->query('SELECT * FROM race_summary');
            return $query->result();
        }
        
        public function test_summary($qtt_id, $class_id)
        {
            $query = $this->db->query('SELECT qtt_id, class_id FROM race_summary');
            $rows = $query->num_rows();
            return $rows;
        }
        
        public function compare_racers_in_summary($racer_id, $qtt_id)
        {
            $query = $this->db->query("SELECT racer_id, qtt_id FROM race_summary WHERE racer_id = '$racer_id' AND qtt_id = '$qtt_id'");
            return $query->result();
        }
        
        public function get_racers_by_ranking($qtt_id,$pick,$class_id)
        {
            $query = $this->db->query("SELECT racer_id, racer_name, racer_pengda, racer_team, racer_vehicle, race_summary.class_id, pengda.pengda_name,
                                       race_type, class.class_name, race_type.race_type_name
                                       FROM race_summary
                                       JOIN pengda ON racer_pengda = pengda.pengda_id
                                       JOIN class ON race_summary.class_id = class.class_id
                                       JOIN race_type ON race_summary.race_type = race_type.race_type_id
                                       WHERE qtt_id = '$qtt_id' AND ranking <= '$pick' AND race_summary.class_id = '$class_id' ORDER BY race_summary.racer_id ASC");
            return $query->result();
        }
        
        public function get_racers_by_point($qtt_id,$class_id)
        {
            $query = $this->db->query("SELECT racer_id, racer_name, racer_pengda, racer_team, racer_vehicle, race_summary.class_id, pengda.pengda_name,
                                       race_type, class.class_name, race_type.race_type_name, point_one, point_two, total_point,
                                       qtt.qtt_name, time
                                       FROM race_summary
                                       JOIN pengda ON racer_pengda = pengda.pengda_id
                                       JOIN class ON race_summary.class_id = class.class_id
                                       JOIN race_type ON race_summary.race_type = race_type.race_type_id
                                       JOIN qtt ON race_summary.qtt_id = qtt.qtt_id
                                       WHERE race_summary.qtt_id = '$qtt_id' AND race_summary.class_id = '$class_id' ORDER BY racer_id ASC");
            return $query->result();
        }
        
        public function get_racers_by_grid($qtt_id,$class_id)
        {
            $query = $this->db->query("SELECT racer_id, racer_name, racer_pengda, racer_team, racer_vehicle, race_summary.class_id, pengda.pengda_name,
                                       class.class_name, race_type.race_type_name, point_one, point_two, total_point, race_type,
                                       qtt.qtt_name, time, grid
                                       FROM race_summary
                                       JOIN pengda ON racer_pengda = pengda.pengda_id
                                       JOIN class ON race_summary.class_id = class.class_id
                                       JOIN race_type ON race_summary.race_type = race_type.race_type_id
                                       JOIN qtt ON race_summary.qtt_id = qtt.qtt_id
                                       WHERE race_summary.qtt_id = '$qtt_id' AND race_summary.class_id = '$class_id' ORDER BY racer_id ASC");
            return $query->result();
        }
        
    }
