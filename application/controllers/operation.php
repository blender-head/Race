<?php

    class Operation extends CI_Controller
    {
        
        public function update($racer_id)
        {
            $racer_id = $this->input->post('racer-number');
            $racer_name = $this->input->post('racer-name');
            $racer_pengda = $this->input->post('racer-pengda');
            $racer_team = mysql_escape_string($this->input->post('racer-team'));
            $racer_vehicle = $this->input->post('racer-vehicle');
            $racer_class = $this->input->post('racer-class');
            
            $this->form_validation->set_rules('racer-number', 'Racer Number', 'required|numeric');
            $this->form_validation->set_rules('racer-name', 'Racer Name', 'required');
            $this->form_validation->set_rules('racer-team', 'Racer Team', 'required');
            $this->form_validation->set_rules('racer-vehicle', 'Racer Vehicle', 'required');
            
            $query = $this->class_model->get_all_class();
            $query_pengda = $this->pengda_model->get_all_pengda();
            $query_racer = $this->racers_model->list_racer_by_id($racer_id);
            
            if(($query > 0) && ($query_pengda > 0))
            {
                $data['option'] = $query;
                $data['pengda'] = $query_pengda;
                $data['records'] = $query_racer;
            }
            
            
            
            if($query_racer > 0)
            {
                foreach($query_racer as $row)
                {
                    $data['racer_number'] = $row->racer_number;
                    $data['racer_name'] = $row->racer_name;
                    $data['racer_team'] = $row->racer_team;
                    $data['racer_vehicle'] = $row->racer_vehicle;
                }
                
               
            }
            
            if ($this->form_validation->run() == FALSE)
            {
                $data['errors'] = validation_errors();
                $this->load->view('racer-edit', $data);
            }
            else
            {

                $query = $this->racers_model->update_racer_model($racer_id, $racer_name, $racer_pengda, $racer_team, $racer_vehicle, $racer_class);
                
                if($query)
                {
                    header( 'Location: http://localhost/race' ) ;
                }
            }
            
        }
        
    }
