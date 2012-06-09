<?php

    class Dev extends CI_Controller
    {
        
        public function test()
        {
            $racer_number = $this->input->post('racer-number');
            $racer_name = $this->input->post('racer-name');
            $racer_pengda = $this->input->post('racer-pengda');
            $racer_class = $this->input->post('class-additional');
            
            print_r($racer_class);
            
                
        }
        
    }
