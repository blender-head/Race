<?php

/*
 * Final Race Controller
 */

    class Final_race extends CI_Controller
    {
        
        //function to display final's form
        public function final_form()
        {
            
            //Get the data from racers_summary.php
            $qtt = $this->input->post('qtt');
            $pick = $this->input->post('pick');
            $race_types = $this->input->post('race_type');
            $class_id = $this->input->post('class_id');
            $final = $this->input->post('race_final');
            $race_types = $this->input->post('race_type');
            
            $this->load->library('session');
            $this->session->set_userdata('class_id',$class_id);
            $this->session->set_userdata('race_type', $race_types);
            
            //start switching race types
            switch($race_types)
            {
                
                //Best race type
                case "1": 
                    
                    //Get the data from race_summary table
                    for($i=0;$i<count($qtt);$i++)
                    {
                        $query[] = $this->race_summary->get_racers_by_ranking($qtt[$i],$pick[$i],$class_id);
                    }
                    
                    //if the query returns array that has more than 2 
                    if(count($query) > 2)
                    {
                        //do nothing, for now
                        //echo "test";
                    }
                    else //if it's a two element array
                    {
                        
                        //split the array to two
                        //and assign them to variables, named $records_1 and #records_2
                        $records_1 = array_pop($query);
                        $records_2 = array_pop($query);
                        
                        //Get class name by their id
                        $query_name = $this->class_model->get_class_name($class_id);
                                                
                        $this->load->model('race_type');
                        $query_race_type = $this->race_type->get_type_name($race_types);
                        $query_class = $this->class_model->get_all_class();
                        
                        foreach ($qtt as $qtt_type)
                        {
                            switch ($qtt_type)
                            {
                                case 6:
                                    $data['final'] = "Final";
                                    //$this->session->set_userdata('final',"Final");
                                    break;
                    
                                case 7:
                                    $data['final'] = "Final";
                                    //$this->session->set_userdata('final',"Final");
                                    break;
                                
                                case 13:
                                    $data['final'] = "Final";
                                    //$this->session->set_userdata('final',"Final");
                                    break;
                    
                                case 14:
                                    $data['final'] = "Final";
                                    //$this->session->set_userdata('final',"Final");
                                    break;
                    
                                case 8:
                                    $data['final'] = "Race II";
                                    
                                                                
                                 case 9:
                                    $data['final'] = "Race II";
                
                            }
                        }
                        
                        $query_final = $this->race_final->query_final_result();
                        
                        if(count($query_final) > 0)
                        {
                            //set $has_final to true, and send it to racers_index.php
                            $data['has_final'] = TRUE;
                
                            foreach($query_final as $classes)
                            {
                                $class[] = $classes;
                    
                            }
                
                            for($i=0;$i<count($class);$i++)
                            {
                                $class_name[] = $class[$i]->class_name;
                                $class_id[] = $class[$i]->class_id;
                                $race_types[] = $class[$i]->race_type;
                            }
                
                            $class_uniq = array_values(array_unique($class_name));
                            $class_id_uniq = array_values(array_unique($class_id));
                            $race_type_uniq = array_values(array_unique($race_types));
                
                            $data['class_name'] = $class_uniq;
                            $data['class_id'] = $class_id_uniq;
                            $data['race_type'] = $race_type_uniq;
                        }
                        else
                        {
                            //set $has_final to false, and send it to racers_index.php
                            $data['has_final'] = FALSE;
                        }
                        
                        $data['records_1'] = $records_1;
                        $data['records_2'] = $records_2;
                        $data['race_type'] = $query_race_type;
                        $data['class_name'] = $query_name;
                        $data['class'] = $query_class;
                        
                        $this->load->view('final_best', $data); 
                     }
                    
                    break; //end Best race type
                    
                case "2": //Point System race type
                    
                    //$qtt_pop = $qtt;
                    
                    //$qtt_id = array_pop($qtt_pop);
                    for($i=0;$i<count($qtt);$i++)
                    {
                        $query = $this->race_summary->get_racers_by_point($qtt[$i],$class_id);
                    }
                    
                    if(sizeof($query) > 0)
                    {
                       $query_name = $this->class_model->get_class_name($class_id);
                       $query_race_type = $this->race_type->get_type_name($race_types);
                       $query_class = $this->class_model->get_all_class();
                       $query_class = $this->class_model->get_all_class();
                       
                       foreach ($qtt as $qtt_type)
                        {
                            switch ($qtt_type)
                            {
                                case 6:
                                    $data['final'] = "Final";
                                    //$this->session->set_userdata('final',"Final");
                                    break;
                    
                                case 7:
                                    $data['final'] = "Final";
                                    //$this->session->set_userdata('final',"Final");
                                    break;
                                
                                case 13:
                                    $data['final'] = "Final";
                                    //$this->session->set_userdata('final',"Final");
                                    break;
                    
                                case 14:
                                    $data['final'] = "Final";
                                    //$this->session->set_userdata('final',"Final");
                                    break;
                    
                                case 8:
                                    $data['final'] = "Race II";
                                    
                                                                
                                 case 9:
                                    $data['final'] = "Final";
                
                            }
                        }
                        
                       
                       $data['records'] = $query;
                       $data['class'] = $query_class;
                       
                       $this->load->view('final_point', $data); 
                       
                    }
                    else
                    {
                       
                        
                        
                     }
                     
                     break; //end Point System case
                    
                case "3": //Grid race type
                    
                    //$qtt_pop = $qtt;
                    
                    //$qtt_id = array_pop($qtt_pop);
                    
                    for($i=0;$i<count($qtt);$i++)
                    {
                        $query = $this->race_summary->get_racers_by_grid($qtt[$i],$class_id);
                    }
                    
                    
                    if(sizeof($query) > 0)
                    {
                       $query_name = $this->class_model->get_class_name($class_id);
                       $query_race_type = $this->race_type->get_type_name($race_types);
                       $query_class = $this->class_model->get_all_class();
                       $query_class = $this->class_model->get_all_class();
                       
                       foreach ($qtt as $qtt_type)
                        {
                            switch ($qtt_type)
                            {
                                case 6:
                                    $data['final'] = "Final";
                                    //$this->session->set_userdata('final',"Final");
                                    break;
                    
                                case 7:
                                    $data['final'] = "Final";
                                    //$this->session->set_userdata('final',"Final");
                                    break;
                                
                                case 13:
                                    $data['final'] = "Final";
                                    //$this->session->set_userdata('final',"Final");
                                    break;
                    
                                case 14:
                                    $data['final'] = "Final";
                                    //$this->session->set_userdata('final',"Final");
                                    break;
                    
                                case 8:
                                    $data['final'] = "Race II";
                                    
                                                                
                                 case 9:
                                    $data['final'] = "Final";
                
                            }
                        }
                        
                       
                       $data['records'] = $query;
                       $data['class'] = $query_class;
                       
                       $this->load->view('final_grid', $data); 
                       
                    }
                    else
                    {
                       
                        echo "Failed";
                        
                     }
                    
                    break;//end Grid case
            }
            //end switching process
    
        }
        //end final_form function
        
        
        //start save_final_race
        public function save_final_result()
        {
            $racer_id = $this->input->post('racer_id');
            $racer_name = $this->input->post('racer_name');
            $racer_pengda = $this->input->post('racer_pengda');
            $racer_team = $this->input->post('racer_team');
            $racer_vehicle = $this->input->post('racer_vehicle');
            $racer_time = $this->input->post('racer-time');
            $racer_rank = $this->input->post('racer-best');
            $laps = $this->input->post('laps');
            $race_num = $this->input->post('race_count');
            $point_one = $this->input->post('racer-point-one');
            $point_two = $this->input->post('racer-point-two');
            $total = $this->input->post('total');
            $race_type = $this->input->post('race_type');
            $class_id = $this->input->post('class_id');
            $qtt_id = $this->input->post('qtt_id');
            $grid = $this->input->post('racer-grid');
            
            //$this->load->library('session');
            //$class_id = $this->session->userdata('class_id');
            //$final = $this->session->userdata('final');
            //$race_types = $this->session->userdata('race_type');
            
            foreach($race_type as $race_type_id)
            {
                $race_types[] = $race_type_id;
            }
            
            //print_r($race_types);
            
            $race_type_uniq = array_values(array_unique($race_types));
            
            $race_type_pop = array_pop($race_type_uniq);
            
            //echo $race_type_pop;
            
            //print_r($race_type_uniq);
            
            switch($race_type_pop)
            {
                    case 1:
                    
                        for($i=0;$i<count($racer_name);$i++)
                        {
                            $save_result = $this->race_final->insert_final_report_best($racer_id[$i], $class_id[$i], $racer_name[$i], $racer_pengda[$i], $racer_team[$i], $racer_vehicle[$i], $qtt_id, $race_types[$i], $racer_time[$i], $racer_rank[$i], $laps, $race_num);
                        }
            
                        if($save_result)
                        {
                            redirect('racers', 'refresh');
                        }
                        else
                        {
                            echo "failed";
                        }
                    
                        break;
                    
                    case 2:
                    
                        for($i=0;$i<count($racer_name);$i++)
                        {
                            $save_result = $this->race_final->insert_final_report_point($racer_id[$i], $class_id[$i], $racer_name[$i], $racer_pengda[$i], $racer_team[$i], $racer_vehicle[$i], $qtt_id, $race_types[$i], $racer_time[$i], $point_one[$i], $point_two[$i], $total[$i], $laps, $race_num);
                        }
            
                        if($save_result)
                        {
                             redirect('/racers', 'refresh');
                        }
                        else
                        {
                            echo "failed";
                        }
                    
                        break;
                        
                    case 3:
                    
                        for($i=0;$i<count($racer_name);$i++)
                        {
                            $save_result = $this->race_final->insert_final_report_grid($racer_id[$i], $class_id[$i], $racer_name[$i], $racer_pengda[$i], $racer_team[$i], $racer_vehicle[$i], $qtt_id, $race_types[$i], $racer_time[$i], $grid[$i], $laps, $race_num);
                        }
            
                        if($save_result)
                        {
                             redirect('/racers', 'refresh');
                        }
                        else
                        {
                            echo "failed";
                        }
                    
                        break;
                
            }
            
                                     
       }
       //end save_final_race
       
       public function display_final_result($class_id, $race_type)
       {
           $query = $this->race_final->get_final_result($class_id, $race_type);
           
           if($query > 0)
           {
               $edit = 0;
               $data['records'] = $query;
               $data['edit'] = $edit;
               $data['date'] = "MINGGU, 22 APRIL 2012";
               
               $query_final = $this->race_final->query_final_result();
               
               if(count($query_final) > 0)
               {
               
                    //set $has_final to true, and send it to racers_index.php
                    $data['has_final'] = TRUE;
                
                    foreach($query_final as $classes)
                    {
                        $class[] = $classes;
                    
                    }
                
                    for($i=0;$i<count($class);$i++)
                    {
                        $class_name[] = $class[$i]->class_name;
                        $class_ids[] = $class[$i]->class_id;
                        $race_types[] = $class[$i]->race_type;
                    }
                
               
                    $class_uniq = array_values(array_unique($class_name));
                    $class_id_uniq = array_values(array_unique($class_ids));
                    $race_type_uniq = array_values(array_unique($race_types));
                
                    $data['class_name'] = $class_uniq;
                    $data['class_id'] = $class_id_uniq;
                    $data['race_type'] = $race_type_uniq;
             }
             else
             {
                //set $has_final to false, and send it to racers_index.php
                $data['has_final'] = FALSE;
             }
                        
               if($this->input->post('edit-summary'))
               {
                    $data['edit'] = TRUE;
               }
               
               $this->load->view('final_result', $data);
           }
       }

        
    }//end class
    
