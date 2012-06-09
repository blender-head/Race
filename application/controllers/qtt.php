<?php

    class Qtt extends CI_Controller
    {
        
        public function index()
        {
            $qtt_id = $this->input->post('qtt');
            $racer_id = $this->input->post('racer_id');
            
            for($i = 0; $i < sizeof($qtt_id); $i++)
            {
                $query = $this->racers_model->input_qtt($qtt_id[$i],$racer_id[$i]);
                if($query)
                {
                    echo "Success";
                }
            }
                
        }
        
        public function qtt_list()
        {
            
        }
        
    }
