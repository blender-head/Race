<?php

/*
 * Racers Controller
 * 
 * Method list and their corresponding view : 
 *  
 *  01 - index() => racers_index.php
 *  02 - add() => racer-add.php
 *  03 - edit() => racer-edit.php
 *  04 - update() => racer-update.php
 */

    class Racers extends CI_Controller
    {
        private $test = array();
        public $site_title;
        public $site_title_sub;
        public $site_track;
        public $exist = FALSE;
        public $exist_message;
        
        //Default controller, homepage, load all racers
        public function index()
        {
            // query the race_final table
            // we need to know whether we have final results or not
            $query_final = $this->race_final->query_final_result();
            
            //if table race.race_final has some data
            if(count($query_final) > 0)
            {
                //set $has_final to true, and send it to racers_index.php
                // make the menu Final Result active
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
                $data['race_types'] = $race_type_uniq;
            }
            else
            {
                //set $has_final to false, and send it to racers_index.php
                // make the Final Result menu inactive
                $data['has_final'] = FALSE;
            }
            
            //load the pagination library            
            $this->load->library('pagination');
            
            //set the pagination configuration
            $url = base_url();
            $base_page = $url . 'index.php/racers/index';
            $config['base_url'] = $base_page;
            $config['total_rows'] = $this->db->get('racer')->num_rows();
            $config['per_page'] = 10;
            $config['num_links'] = 20;
            $config['full_tag_open'] = '<div class="pagination"><ul class="pagination_links">';
            $config['full_tag_close'] = '</ul></div>';
            $config['cur_tag_open'] = '<span class="page_active">';
            $config['cur_tag_close'] = '</span>';
            
            //initialize pagination
            $this->pagination->initialize($config);
            
            //query the database
            //should have done it in models
            //but for now, we just done it inside the controller
            $this->db->join('class', 'racer.racer_class = class.class_id');
            $this->db->join('pengda', 'racer.racer_pengda = pengda.pengda_id');
            $this->db->order_by('id','asc');
            $query = $this->db->get('racer', $config['per_page'], $this->uri->segment(3)); 
            
            
            //if query returs a result
            if($query) 
            {
                //send $records to racers_index.php
                $data['records'] = $query; 
                
                //send $class to racers_index.php, data for submenu dropdown
                $data['class'] = $this->get_all_class(); 
            }
            
            //load racers_index.php view
            $this->load->view('racers_index', $data); 
        }
        //end index function
        
        
        // function to load all class from class table
        private function get_all_class()
        {
            //load class_model model, run get_all_class method
            $query = $this->class_model->get_all_class(); 
            
            //return the query result to its caller
            return $query; 
        }
        
        //function to load all qtt from qtt table
        private function get_all_qtt()
        {
            //load qtt_model model, run get_all_qtt method from the model
            $query = $this->qtt_model->get_all_qtt(); 
            
            //return the query to the its caller
            return $query;
        }
        
        //function to load class name from class table, filter by its id
        private function get_class_title($id)
        {
            //load class_model model, run get_clas_name, with id as parameter
            $query = $this->class_model->get_class_name($id);
            
            //return the query result to its caller
            return $query;
        }
        
        private function get_race_type()
        {
            $query = $this->race_type->get_all_type();
            return $query;
        }
        
        private function get_qtt_name($qtt_id)
        {
            $query = $this->qtt_model->get_qtt_by_name($qtt_id);
            return $query;
        }
        
        private function get_racer_pengda($racer_number)
        {
            $query = $this->racers_model->get_racer_pengda($racer_number);
            return $query;
        }
        
        private function get_racer_class_name($racer_number)
        {
            $query = $this->racers_model->get_racer_class($racer_number);
            return $query;
        }
        
        //function to add racer data to racer table
        public function add() 
        {
            //query the class [race.class] table, provides us data to select racer's class
            $query = $this->class_model->get_all_class();
            
            //query the pengda [race.pengda] table, provides us data to select racer's pengda
            $query_pengda = $this->pengda_model->get_all_pengda();
            
            //if all the query went well
            if(($query > 0) && ($query_pengda > 0))
            {
                //send $option variable to racer-add.php view
                $data['option'] = $query;
                
                //send $pengda variable to racer-add.php view
                $data['pengda'] = $query_pengda;
            }
            
            //get the racer-add.php form's data
            $racer_number = $this->input->post('racer-number');
            $racer_name = $this->input->post('racer-name');
            $racer_pengda = $this->input->post('racer-pengda'); //array
            $racer_team = mysql_escape_string($this->input->post('racer-team'));
            $racer_vehicle = $this->input->post('racer-vehicle');
            $racer_class = $this->input->post('racer-class'); //array
            $racer_add_class = $this->input->post('class-additional'); //array
            
            //set the rules to validate form's data
            $this->form_validation->set_rules('racer-number', 'Racer Number', 'required|numeric|is_unique[racer.racer_number]');
            $this->form_validation->set_rules('racer-name', 'Racer Name', 'required');
            $this->form_validation->set_rules('racer-team', 'Racer Team', 'required');
            $this->form_validation->set_rules('racer-vehicle', 'Racer Vehicle', 'required');
            
            //if the validation failed
            if ($this->form_validation->run() == FALSE)
            {
                //send $errors to racer-add.php, and load the racer-add.php view
                $data['errors'] = validation_errors();
                $this->load->view('racer-add', $data);
            }
            //if the validation succeed
            else
            {
                //check if $racer_add_class array is empty or not
                if(!empty($racer_add_class)) //if not empty
                {
                    //racer's additional class could be more than one value
                    //loop thru whatever value that $racer_add_class has
                    for($i=0;$i<count($racer_add_class);$i++)
                    {
                        //insert the data to racer_add_class [race.racer_add_class] table
                        $query_add_class = $this->racer_add_class->insert_additional_class($racer_number, $racer_name, $racer_pengda, $racer_team, $racer_vehicle, $racer_add_class[$i]);
                    }
                }
                //if $racer_add_class array is empty, then the racer has no additional class to add
                //proceed to the next process
                
                //next, insert the data to main racer [race.racer] table
                $query = $this->racers_model->add_racer($racer_number, $racer_name, $racer_pengda, $racer_team, $racer_vehicle, $racer_class);
                
                //if the insertion process succeed, take us back to the main page
                //the process of racer's data insertion is done!!!
                if($query)
                {
                    //header('Location: http://localhost/race') ;
                    redirect('/racers', 'refresh');
                }
            }
        }
        //end add method
        
        
        //function to edit racer's data
        //this function is just providing us with automatically filled form datas
        //the actual update process is handled by the UPDATE method
        public function edit($id)
        {
            //query the class [race.class] table, provides us data to select racer's class
            //returns array
            $query = $this->class_model->get_all_class();
            
            //query the pengda [race.pengda] table, provides us data to select racer's pengda
            //returns array
            $query_pengda = $this->pengda_model->get_all_pengda();
            
            //query the racer [race.racer] table, provides us data
            //to automatically fill the form with the racer's data
            //returns array
            $query_racer = $this->racers_model->list_racer_by_id($id);
            
            //if the racer has any additional class
            //we want to select the class id from racer_add_class table
            $query_add_class = $this->racer_add_class->select_class_id($id);
            
            //call the get_racer_pengda method
            //pengda value in race.racer database is in integer
            //we need the name
            $query_pengda_selected = $this->get_racer_pengda($id);
            
            //call the get_racer_class_name method
            //class value in race.racer database is in integer
            //we need the name
            $query_class_name = $this->get_racer_class_name($id);
            
            //if the above query returns results
            if((sizeof($query_pengda_selected) > 0) && (sizeof($query_class_name) > 0))
            {
                //send $pengda_selected to racer-edit.php view 
                //provides us data with automatically selected racer's pengda
                //based on the racer's data
                $data['pengda_selected'] = $query_pengda_selected;
                
                //send $class_name to racer-edit.php view
                //provides us data with automatically selected racer's class
                $data['class_name'] = $query_class_name;
            }
            
            //if querying race.class and race.pengda table returns results
            if(($query > 0) && ($query_pengda > 0))
            {
                //send $option to racer-edit.php view
                //provides us with all class data in the table
                //filling the select class form
                $data['option'] = $query;
                
                //send $pengda to racer-edit.php view
                //provides us with all class data in the table
                //filling the select pengda form
                $data['pengda'] = $query_pengda;
                
                //query the racer_number, racer_name, racer_team, racer_vehicle
                //from race.racer table
                $data['records'] = $query_racer;
            }
            
            //if the query from the racer table return results
            if($query_racer > 0)
            {
                //loop thru the array, and fetch
                //racer_number, racer_name, racer_team, racer_vehicle
                foreach($query_racer as $row)
                {
                    //sends them to racer-edit.php form
                    $data['racer_number'] = $row->racer_number;
                    $data['racer_name'] = $row->racer_name;
                    $data['racer_team'] = $row->racer_team;
                    $data['racer_vehicle'] = $row->racer_vehicle;
                }
                
               
            }
            
            
            //if the racer_add is not empty
            if($query_add_class > 0)
            {
                for($i=0;$i<count($query_add_class);$i++)
                {
                    $racer_add_class[] = $query_add_class[$i]->racer_class;
                    $data['add_class'] = $racer_add_class;
                }
            }
            
            //load racer-edit.php view
            $this->load->view('racer-edit', $data);
        }
        //end edit method
        
        
        //start update method
        //function to perform update data against the racer table
        public function update()
        {
            //get form datas from racer-update.php view
            $racer_number = $this->input->post('racer-number');
            $racer_name = $this->input->post('racer-name');
            $racer_pengda = $this->input->post('racer-pengda');
            $racer_team = $this->input->post('racer-team');
            $racer_vehicle = $this->input->post('racer-vehicle');
            $racer_class = $this->input->post('racer-class');
            $id = $this->input->post('racer-number');
            $racer_add = $this->input->post('racer-class-add');
            //end get data
            
            //query the tables
            $query = $this->class_model->get_all_class();
            $query_pengda = $this->pengda_model->get_all_pengda();
            $query_racer = $this->racers_model->list_racer_by_id($id);
            $query_pengda_selected = $this->get_racer_pengda($id);
            $query_class_name = $this->get_racer_class_name($id);
            
            $data['pengda_selected'] = $query_pengda_selected;
            $data['class_name'] = $query_class_name;
            
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
            
            $data['pengda_selected'] = $query_pengda_selected;
            $data['class_name'] = $query_class_name;
            $data['racer_vehicle'] = $racer_vehicle;
            $data['racer_team'] = $racer_team;
            $data['pengda'] = $query_pengda;
            
            $data['option'] = $this->get_all_class();
            
            $this->form_validation->set_rules('racer-number', 'Racer Number', 'required|is_unique[racer.racer_number.racer_number.'.$racer_number.']');
            $this->form_validation->set_rules('racer-name', 'Racer Name', 'required');
            $this->form_validation->set_rules('racer-team', 'Racer Team', 'required');
            $this->form_validation->set_rules('racer-vehicle', 'Racer Vehicle', 'required');
            
            //if update button is clicked
            if($this->input->post('update'))
            {
                //validate the form, if don't pass, load the racer-update.php view
                if($this->form_validation->run() == FALSE)
                {
                    $this->load->view('racer-update', $data);
                }
                //if the form is valid
                else
                {
                    //query the racer_add_class table
                    $select_racer = $this->racer_add_class->select_racer($racer_number);
                    
                    //if there's data in it 
                    if(count($select_racer) > 0)
                    {
                        //check if the racer additional option is checked
                        if(!empty($racer_add))
                        {  
                            /*
                             if one of the additional class is checked
                             assign the values of racer_class from racer_add_class
                             to class_add array
                            */ 
                            
                            foreach($select_racer as $add)
                            {
                                $class_add[] = $add->racer_class;
                            }
                            
                            /*
                             if we reduce the option count from 
                             racer additional class option
                             then we want to delete the class
                            */
                            
                            if(count($racer_add) < $class_add)
                            {
                                $diff = array_diff($class_add,$racer_add);
                                
                                for($i=0;$i<count($diff);$i++)
                                {
                                    $delete = $this->racer_add_class->delete_class($racer_number, $diff[$i]);
                                }
                            }
                            
                            /*
                             resume normal operation 
                            */
                            $result = array_values(array_diff($racer_add,$class_add));
                            
                            for($i=0;$i<count($result);$i++)
                            {
                                $insert_add_class = $this->racer_add_class->insert_additional_class($racer_number, $racer_name, $racer_pengda, $racer_team, $racer_vehicle, $result[$i]);
                            }
                            
                        }
                        /*
                         if nothing in racer additional class option is checked
                         we don't want any additional class 
                        */
                        else
                        {
                            $delete = $this->racer_add_class->delete_racer($racer_number); 
                        }
                    }
                    /*
                     if the racer_add_class table is empty 
                     insert additional class data to the table
                    */
                    else
                    {
                        if(!empty($racer_add))
                        {
                            for($i=0;$i<count($racer_add);$i++)
                            {
                                $insert_add_class = $this->racer_add_class->insert_additional_class($racer_number, $racer_name, $racer_pengda, $racer_team, $racer_vehicle, $racer_add[$i]);
                            }
                        }
            
                    }  
                    
                    /*
                     update the racer table 
                    */
                    
                    $update = $this->racers_model->update_racer_model($id, $racer_name, $racer_pengda, $racer_team, $racer_vehicle, $racer_class);
                    
                    //if the opration is success
                    //take us home
                    if($update)
                    {
                        header( 'Location: http://localhost/race' ) ;
                    }
                    //if not
                    //restart the update operation
                    else
                    {
                        $this->load->view('racer-update', $data);
                    }
            
                }
            }
            //if the delete button is clicked
            else if($this->input->post('delete'))
            {
                //setup the data
                $data['racer_number'] = $racer_number;
                $data['racer_name'] = $racer_name;
                
                //load racer-delete.php view
                $this->load->view('racer-delete', $data);
            }

        }//end update method
        
        
        //start delete method
        public function delete($racer_number)
        {
            $query_main = $this->racers_model->delete_racer($racer_number);
            $query_add = $this->racer_add_class->delete_racer($racer_number);
            
            if(($query_main > 0) && ($query_add > 0))
            {
                redirect('racers', 'refresh');
            }
            else
            {
                echo "Failed";
            }
        }
        //end delete method
        
             
        //function to load racers by their class, receive class_id as parameter
        public function racerclass($id)
        {
            // query the race_final table
            // we need to know whether we have final results or not
            $query_final = $this->race_final->query_final_result();
            
            //if table race.race_final has some data
            if(count($query_final) > 0)
            {
                //set $has_final to true, and send it to racers_index.php
                // make the menu Final Result active
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
                $data['race_types'] = $race_type_uniq;
            }
            else
            {
                //set $has_final to false, and send it to racers_index.php
                // make the Final Result menu inactive
                $data['has_final'] = FALSE;
            }
            
            //query the racer and racer_add_class
            $query = $this->racers_model->list_racer_by_class($id);
            $query_add_class = $this->racer_add_class->list_racer_by_class($id);
            
            if($query > 0)
            {
                $data['records'] = $query;
                
                foreach($query as $row)
                {
                    $data['title'] = $row->class_name; 
                }
                
                $data['class'] = $this->get_all_class();
                $data['race_type'] = $this->get_race_type();
                $data['division'] = $this->get_all_qtt();
                $data['exist'] = $this->exist_message;
                
             }
            
             $this->load->view('racers_class', $data);
                    
        }    
        
        
        //function to save race summary and qtt links
        public function qtt()
        {
            //get data from racers_class.php view
            $racer_number = $this->input->post('racer_number');
            $racer_name = $this->input->post('racer_name');
            $racer_pengda = $this->input->post('racer_pengda');
            $racer_team = $this->input->post('racer_team');
            $racer_vehicle = $this->input->post('racer_vehicle');
            $qtt = $this->input->post('qtt');
            $race_type = $this->input->post('race_type');
            $class_id = $this->input->post('class_id');
            
            //$qtt_uniq = array_values(array_unique($qtt_id));
            
            //initialize fields data that we don't have yet
            //but necessary to make the insertion to race.race_summary table
            $ranking = 0;
            $grid = 0;
            $point_one = 0;
            $point_two = 0;
            $total_point = 0;
            $laps = 0;
            $race_num = 0;
            $time = 0;
            
            //check the race_summary table first
            $test_summary_table = $this->race_summary->query_summary();
            
            //if race_summary table is not empty                      
            if(count($test_summary_table) > 0 )
            {
                for($i=0;$i<count($test_summary_table);$i++)
                {
                    for($j=0;$j<count($racer_number);$j++)
                    {
                        //check first, if the racers are already in the table
                        $check_racers_in_summary = $this->race_summary->compare_racers_in_summary($racer_number[$j], $qtt[$j]);
                    }
                }
                
                //if the query returns a result              
                if(sizeof($check_racers_in_summary) > 0) 
                {
                    for($i=0;$i<count($test_summary_table);$i++)
                    {
                        for($j=0;$j<count($racer_number);$j++)
                        {
                            $check_racers_in_summary = $this->race_summary->compare_racers_in_summary($racer_number[$j], $qtt[$j]);
                            
                            if(($racer_number[$j] == $check_racers_in_summary[0]->racer_id) && ($qtt[$j] == $check_racers_in_summary[0]->qtt_id))
                            {
                                $this->exist = TRUE;
                                $racer_exist[] = $racer_number[$j];
                            }
                        }
                        
                    }
                    
                    $racer_exist_uniq = array_values(array_unique($racer_exist));
                    
                    //print_r($racer_exist_uniq);
                                        
                    if($this->exist == TRUE)
                    {
                        //$this->exist_message = "Data already exist";
                        foreach($racer_exist_uniq as $double)
                        {
                            $this->exist_message[] = 'Data for racer number ' . $double . ' already exist in the database';
                        }
                        
                        $this->racerclass($class_id);
                    }
                }
                else
                {
                    for($i = 0; $i < sizeof($racer_name); $i++)
                    {
                        $query = $this->race_summary->insert_summary($racer_number[$i], $class_id, $racer_name[$i], $racer_pengda[$i], $racer_team[$i], $racer_vehicle[$i], $qtt[$i], $race_type[$i], $time, $ranking, $grid, $point_one, $point_two, $total_point, $laps, $race_num);
                        $insert_qtt = $this->qtt_links->insert_qtt_links($qtt[$i], $class_id);
                    }
            
                    if($query > 0)
                    {
                        header( "Location: http://localhost/race/index.php/racers/division_links/");
                    }
                    else
                    {
                        echo "Query Failed";
                    }
                }
                
            }
            else
            {
                for($i = 0; $i < sizeof($racer_name); $i++)
                {
                    $query = $this->race_summary->insert_summary($racer_number[$i], $class_id, $racer_name[$i], $racer_pengda[$i], $racer_team[$i], $racer_vehicle[$i], $qtt[$i], $race_type[$i], $time, $ranking, $grid, $point_one, $point_two, $total_point, $laps, $race_num);
                    $insert_qtt = $this->qtt_links->insert_qtt_links($qtt[$i], $class_id);
                }
            
                if($query > 0)
                {
                    header( "Location: http://localhost/race/index.php/racers/division_links/");
                }
                else
                {
                    echo "Query Failed";
                }
            }
            
        }
        
        //function to display qtt links
        public function division_links()
        {
            // query the race_final table
            // we need to know whether we have final results or not
            $query_final = $this->race_final->query_final_result();
            
            //if table race.race_final has some data
            if(count($query_final) > 0)
            {
                //set $has_final to true, and send it to racers_index.php
                // make the menu Final Result active
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
                $data['race_types'] = $race_type_uniq;
            }
            else
            {
                //set $has_final to false, and send it to racers_index.php
                // make the Final Result menu inactive
                $data['has_final'] = FALSE;
            }
            
            //check the qtt_links table first
            $query = $this->qtt_links->get_qtt_links();
            $class = $this->get_all_class();
            
                                   
            $data['class'] = $class;
            $data['links'] = $query;
            
            $this->load->view('division_links', $data);
            
        }
       
       //function to list racers by their qtt division
       //accept two parameters, qtt_id and class_id
       public function qttlist($qtt_id, $class_id)
       {
                      
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
            
            //load racers_model model, run list_racer_by_qtt method inside the model
           $query = $this->racers_model->list_racer_by_qtt($qtt_id, $class_id);
           
           if($query > 0)
           {
               $data['records'] = $query;
               $data['class'] = $this->get_all_class();
               $this->load->view('racers_class_qtt_list', $data);
           }
           
       }
       //end qttlist function
       
       
       //function to save race summary     
       public function save_qtt()
       {
           
           //get datas from racers_class_qtt_list.php view
           $racer_id = $this->input->post('racer_number');
           $racer_name = $this->input->post('racer_name');
           $racer_pengda = $this->input->post('racer_pengda');
           $racer_team = $this->input->post('racer_team');
           $racer_vehicle = $this->input->post('racer_vehicle');
           $qtt_id = $this->input->post('qtt');
           $point_one = $this->input->post('racer-point-one');
           $point_two = $this->input->post('racer-point-two');
           $total = $this->input->post('total');
           $grid = $this->input->post('racer-grid');
           $ranking = $this->input->post('racer-best');
           $race_type = $this->input->post('race_type');
           $class_id = $this->input->post('class_id');
           $laps = $this->input->post('laps');
           $race_count = $this->input->post('race_count');
           $class_name = $this->input->post('class_name');
           $time = $this->input->post('racer-time');
           $best = $this->input->post('race_pick');
           
           
           //set form validation based on race type
           switch ($race_type)
           {
               case "Best":
                   $this->form_validation->set_rules('racer-best[]', 'Ranking', 'required|numeric'); 
                   break;
               
               case "Grid":
                   $this->form_validation->set_rules('racer-grid[]', 'Grid', 'required|numeric');
                   break;
           }
           
           $this->form_validation->set_rules('laps', 'Laps', 'required');
           $this->form_validation->set_rules('race_count', 'Race Count', 'required');
           
           //display racers by their qtt
           $query = $this->racers_model->list_racer_by_qtt($qtt_id, $class_id);
            
           //send variables to racers_save_qtt.php
           $data['class_name'] = $this->get_class_title($class_id);
           $data['qtt_name'] = $this->get_qtt_name($qtt_id);
           $data['babak'] = $qtt_id;
           $data['starter'] = count($query);
           $data['race_type'] = $race_type;
           $data['class'] = $this->get_all_class();
           
           //if the query returns a result
           if($query > 0)
           {
               $data['records'] = $query;
           }
           
           
           //if form validation fails
           if($this->form_validation->run() == FALSE)
           {
               $this->load->view('racers_save_qtt', $data);
           }
           //if form validation succeeded
           else
           {
               
               //count the racers
               $count = count($racer_name);
               
               
               //select race type
               switch($race_type)
               {
                   
                   //case Best, update race_summary table with Best race type datas
                   //we also need the pick values for later computation, so we also gonna populate the best_pick table
                   case "Best":
                        for($i = 0; $i < $count; $i++) 
                        {
                            $query = $this->race_summary->update_summary_best($racer_id[$i], $time[$i], $ranking[$i], $laps, $race_count, $best);
                            $insert_best_pick = $this->best_pick->insert_best_pick($class_id, $qtt_id, $best);
                        }
                        
                        //if both of operation is succeeded
                        if(($query) && ($insert_best_pick))
                        {
                            //set the status field in qtt_links table to done
                            //we need this to display check mark next to qtt name in division_links.php
                            $status = 'done';
                            $update_status = $this->qtt_links->update_status($qtt_id,$status);
                        }
                        
                        break;
                   //end Best case
                        
                        
                    //case Grid, update race_summary table with Grid race type datas    
                    case "Grid":
                        for($i = 0; $i < $count; $i++) 
                        {
                            $query = $this->race_summary->update_summary_grid($racer_id[$i], $time[$i], $grid[$i], $laps, $race_count);
                        }
                        
                        //if the update operation is succeeded
                        if($query)
                        {
                            //set the status field in qtt_links table to done
                            //we need this to display check mark next to qtt name in division_links.php
                            $status = 'done';
                            $update_status = $this->qtt_links->update_status($qtt_id,$status);
                        }
                        
                        break;
                    //end Grid case
                        
                    //case Point System, update race_summary table with Point System race type datas    
                    case "Point System":
                        for($i = 0; $i < $count; $i++) 
                        {
                            $query = $this->race_summary->update_summary_point($racer_id[$i], $time[$i], $point_one[$i], $point_two[$i], $total[$i], $laps, $race_count);
                        }
                        
                        //if the update operation is succeeded
                        if($query)
                        {
                            //set the status field in qtt_links table to done
                            //we need this to display check mark next to qtt name in division_links.php
                            $status = 'done';
                            $update_status = $this->qtt_links->update_status($qtt_id,$status);
                        }
                        
                        break;
                    //end Point System case    
               }
               //end switch
               
               //if all the query succeeded
               if($query)
               {
                    //redirect to division_links.php
                    header( "Location: http://localhost/race/index.php/racers/division_links/");
               }
               else
               {
                    echo "Failed";
               }


               //$this->load->view('racers_class_summary', $data);
           }
           
       }
       //end save_qtt function

       
       //start race_summary_by_class method
       //function to display race summary
       public function race_summary_by_class($class_id)
       {
           
           // query the race_final table
            // we need to know whether we have final results or not
            $query_final = $this->race_final->query_final_result();
            
            //if table race.race_final has some data
            if(count($query_final) > 0)
            {
                //set $has_final to true, and send it to racers_index.php
                // make the menu Final Result active
                $data['has_final'] = TRUE;
                
                foreach($query_final as $classes)
                {
                    $class[] = $classes;
                    
                }
                
                for($i=0;$i<count($class);$i++)
                {
                    $class_name[] = $class[$i]->class_name;
                    $class_idss[] = $class[$i]->class_id;
                    $race_types[] = $class[$i]->race_type;
                }
                
                $class_uniq = array_values(array_unique($class_name));
                $class_id_uniq = array_values(array_unique($class_idss));
                $race_type_uniq = array_values(array_unique($race_types));
                
                $data['class_name'] = $class_uniq;
                $data['class_ids'] = $class_id_uniq;
                $data['race_types'] = $race_type_uniq;
            }
            else
            {
                //set $has_final to false, and send it to racers_index.php
                // make the Final Result menu inactive
                $data['has_final'] = FALSE;
            }
           
           //query the race.race_summary table
           //select racers by class_id
           $query = $this->race_summary->race_summary_by_class($class_id);
           
           //if the query returns a result
           if((count($query) > 0))
           {
                //extract the query
                //we need qtt_id, qtt_name, class_id, class_name, race_type and race_type_name
                foreach($query as $field)
                {
                    $qtt_id[] = $field->qtt_id;
                    $qtt_name[] = $field->qtt_name;
                    $class_ids[] = $field->class_id;
                    $class_names[] = $field->class_name;
                    $race_type[] = $field->race_type;
                    $race_type_name[] = $field->race_type_name;
                }
                
                //since the array from the result are duplicate entry with the same value
                //we need just one value, so we make it unique
                $unique_name = array_values(array_unique($qtt_name));
                $unique_id = array_values(array_unique($qtt_id));
                $unique_class_id = array_values(array_unique($class_ids));
                $unique_class_name = array_values(array_unique($class_names));
                $unique_race_type = array_values(array_unique($race_type));
                $unique_race_type_name = array_values(array_unique($race_type_name));
                
                //further extraction of qtt_name              
                foreach($unique_name as $name)
                {
                    $names[] = $name;
                }
                
                //further extraction of qtt_id
                foreach($unique_id as $id)
                {
                    $ids[] = $id;
                }
                
                //further extraction of race_type_name
                foreach($unique_race_type_name as $race_name)
                {
                    $race_name_sw = $race_name;
                }
                
                //further extraction of class_id
                foreach($unique_class_id as $classes)
                {
                    $class[] = $classes;
                }
                
                //if race_type = Best
                if($race_name_sw == "Best")
                {
                    
                    //query the race.best_pick table
                    //we need the pick value
                    for($i=0;$i<count($unique_id);$i++)      
                    {
                        $pick[] = $this->best_pick->get_pick($unique_id[$i],$class_id);
                    }
                    
                    //extract the pick array result
                    foreach($pick as $data_picks)
                    {
                        $data_pick[] = $data_picks;
                    }
                    
                    //further extraction of pick value
                    for($i=0;$i<count($data_pick);$i++)
                    {
                        if(!isset($data_pick[$i][$i]->pick))
                        {
                            $data_pick[$i][$i]->pick = 0;
                        }
                        else
                        {
                            $pick_arr[] = $data_pick[$i][$i]->pick;
                        }
                    }
                    
                    //print_r($pick_arr);
                    
                    $data['pick'] = $pick_arr;
                    
                    //print_r($pick_arr);
                }
                
                //prepping variables for the racers_summary.php view
                $race_type_pop = array_pop($unique_race_type);
                $data['qtt_name'] = $names;
                $data['qtt_id'] = $ids;
                $data['titles'] = $unique_class_name;
                $data['class'] = $this->get_all_class();
                $data['race_type'] = $race_type_pop;
                $data['race_name'] = $race_name;
                $data['class_id'] = $class_id;
                
                $this->load->view('racers_summary', $data);
           }
           //if race.race_summary is empty
           else
           {    
                $data['class'] = $this->get_all_class();
                $this->load->view('racers_summary_empty', $data);
           }
          
                   
       }//end race_summary_by_class method
       
       
       //function to display race summary result
       public function list_summary($id, $pick, $race_type, $class_id)
       {
           // query the race_final table
            // we need to know whether we have final results or not
            $query_final = $this->race_final->query_final_result();
            
            //if table race.race_final has some data
            if(count($query_final) > 0)
            {
                //set $has_final to true, and send it to racers_index.php
                // make the menu Final Result active
                $data['has_final'] = TRUE;
                
                foreach($query_final as $classes)
                {
                    $class[] = $classes;
                    
                }
                
                for($i=0;$i<count($class);$i++)
                {
                    $class_name[] = $class[$i]->class_name;
                    $class_idss[] = $class[$i]->class_id;
                    $race_types[] = $class[$i]->race_type;
                }
                
                $class_uniq = array_values(array_unique($class_name));
                $class_id_uniq = array_values(array_unique($class_idss));
                $race_type_uniq = array_values(array_unique($race_types));
                
                $data['class_name'] = $class_uniq;
                $data['class_ids'] = $class_id_uniq;
                $data['race_types'] = $race_type_uniq;
            }
            else
            {
                //set $has_final to false, and send it to racers_index.php
                // make the Final Result menu inactive
                $data['has_final'] = FALSE;
            }
           
            //we want to display race summary based on race types
            //becuase each race type has different values
            switch($race_type)
            {
               //Best race type
               case 1: 
                   
                    //get $qtt variable that was sent from racers_summary.php
                    $qtt = $this->input->post('qtt');
                    
                    //set edit status to FALSE / 0
                    //that means, nobody is clicking the edit button yet
                    $edit = 0;
                    
                    //query the race.race_summary table
                    //we need the racer's data to display
                    $query = $this->race_summary->race_summary_by_qtt_best($id, $pick, $class_id);
                    
                    //if the query return the result
                    if($query > 0)
                    {
                        $class_name = $this->class_model->get_class_name($id);
                        
                        //get datas from racers_summary.php view
                        $qtt_name = $this->qtt_model->get_qtt_by_name($id);
                        $laps = $this->input->post('laps');
                        $race_num = $this->input->post('race_num');
                        $racer_id = $this->input->post('racer_id');
                        $time = $this->input->post('racer_time');
                        $ranking = $this->input->post('racer_best');
                        
                        //prepping the data for final view
                        $data['class'] = $this->get_all_class();
                        $data['records'] = $query;
                        $data['race_type'] = $race_type;
                        $data['class_name'] = $class_name;
                        $data['qtt_name'] = $qtt_name;
                        $data['title'] = "The Master Of Matic Race";
                        $data['champions'] = "CHAMPIONSHIP 2012";
                        $data['date'] = "MINGGU, 22 APRIL 2012";
                        $data['location'] = "INT'L KARTING CIRCUIT SENTUL";
                        $data['edit'] = $edit;
                        
                        
                        //if edit button is clicked
                        if($this->input->post('edit-summary'))
                        {
                            $data['edit'] = TRUE;
                        }
                        
                        
                        //if save button is clicked
                        if($this->input->post('save-summary'))
                        {
                            
                            //update the race_summary table, with Best race type data
                            for($i=0;$i<count($racer_id);$i++)
                            {
                                $update_data = $this->race_summary->update_summary_best_summary($racer_id[$i], $time[$i], $ranking[$i]);
                            }
                            
                            //if the update operation is succeeded
                            if($update_data)
                            {
                                redirect("http://localhost/race/index.php/racers/list_summary/$id/$pick/$race_type/$class_id", 'refresh');
                            }
                            
                          
                        }
                        
                        //load the list_summary.php view
                        $this->load->view('list_summary', $data); 
                   
                   }
                        
                   break;
                   //end Best case
                 
                 
                 //Point System case
                 case 2: 
                    
                     //get $qtt variable that was sent from racers_summary.php
                     $qtt = $this->input->post('qtt');
                     
                     //set edit status to FALSE / 0
                     //that means, nobody is clicking the edit button yet
                     $edit = 0;
                    
                     //query the race.race_summary table
                     //we need the racer's data to display
                     $query = $this->race_summary->race_summary_by_qtt_point($id, $pick, $class_id);
                   
                     //if the query returns a result
                     if($query > 0)
                     {
                        $class_name = $this->class_model->get_class_name($id);
                        
                        //get datas from racers_summary.php view
                        $qtt_name = $this->qtt_model->get_qtt_by_name($id);
                        $laps = $this->input->post('laps');
                        $race_num = $this->input->post('race_num');
                        $racer_id = $this->input->post('racer_id');
                        $time = $this->input->post('racer_time');
                        $point_one = $this->input->post('racer_point_one');
                        $point_two = $this->input->post('racer_point_two');
                        $total_point = $this->input->post('racer_total');
                        $data['class'] = $this->get_all_class();
                        
                        //prepping the data for final view
                        $data['records'] = $query;
                        $data['title'] = "The Master Of Matic Race";
                        $data['champions'] = "CHAMPIONSHIP 2012";
                        $data['date'] = "MINGGU, 22 APRIL 2012";
                        $data['location'] = "INT'L KARTING CIRCUIT SENTUL";
                        
                        $data['edit'] = $edit;
                        
                        //if edit button is clicked
                        if($this->input->post('edit-summary'))
                        {
                            $data['edit'] = TRUE;
                        }
                        
                        //if save button is clicked
                        if($this->input->post('save-summary'))
                        {
                            
                            //update the race_summary table
                            for($i=0;$i<count($racer_id);$i++)
                            {
                                $update_data = $this->race_summary->update_summary_point($racer_id[$i], $time[$i], $point_one[$i], $point_two[$i], $total_point[$i], $laps, $race_num);
                                
                            }
                            
                            //if the update operation succeeded
                            if($update_data)
                            {
                                redirect("http://localhost/race/index.php/racers/list_summary/$id/$pick/$race_type/$class_id", 'refresh');
                            }
                            
                        }
                        
                        ////load the list_summary.php view
                        $this->load->view('list_summary', $data); 
                        
                    }
                    //if the query returns no result
                    else
                    {
                        echo "Empty";
                    }
                    
                    break;
                    //end Point System case
                
                    
                //Grid case
                case 3:
                    
                     //get $qtt variable that was sent from racers_summary.php
                     $qtt = $this->input->post('qtt');
                     
                     //set edit status to FALSE / 0
                     //that means, nobody is clicking the edit button yet
                     $edit = 0;
                    
                     //query the race.race_summary table
                     //we need the racer's data to display
                     $query = $this->race_summary->race_summary_by_qtt_grid($id);
                    
                     
                     //if the query returns a result
                     if($query > 0)
                     {
                        $class_name = $this->class_model->get_class_name($id);
                        $qtt_name = $this->qtt_model->get_qtt_by_name($id);
                        
                        //get datas from racers_summary.php view
                        $racer_id = $this->input->post('racer_id');
                        $racer_grid = $this->input->post('racer_grid');
                        $racer_time = $this->input->post('racer_time');
                        
                        //prepping the data for final view
                        $data['class'] = $this->get_all_class();
                        $data['records'] = $query;
                        $data['race_type'] = $race_type;
                        $data['class_name'] = $class_name;
                        $data['qtt_name'] = $qtt_name;
                        $data['title'] = "The Master Of Matic Race";
                        $data['champions'] = "CHAMPIONSHIP 2012";
                        $data['date'] = "MINGGU, 22 APRIL 2012";
                        $data['location'] = "INT'L KARTING CIRCUIT SENTUL";
                        $data['edit'] = $edit;
                        
                        
                        //if edit button is clicked
                        if($this->input->post('edit-summary'))
                        {
                            $data['edit'] = TRUE;
                        }
                        
                        
                        //if save button is clicked
                        if($this->input->post('save-summary'))
                        {
                            //update race_summary table with Grid race type datas
                            for($i=0;$i<count($racer_id);$i++)
                            {
                                $update_data = $this->race_summary->update_summary_grid_summary($racer_id[$i], $racer_time[$i], $racer_grid[$i]);
                                
                            }
                            
                            
                            //if the update operation succeeded
                            if($update_data)
                            {
                                redirect("http://localhost/race/index.php/racers/list_summary/$id/0/$race_type/$class_id", 'refresh');
                            }
                            
                          
                        }
                        
                        //if all goes well, present the data in list_summary.php view
                        $this->load->view('list_summary', $data);
                    }
                    //if the query returns no result
                    else
                    {
                        echo "Empty";
                    }
                    
                    break;
                    //end Grid case
           }
           //end switch

       }
       //end list_summary function
       
       
       
       /*
        *  Function to export races summary
        */
       public function export_pdf($id, $pick, $race_type, $class_id)
       {
            //call the list_summary function
            $this->list_summary($id, $pick, $race_type, $class_id);
            
            //run a query against the race_summary table
            //based on rac type
            switch($race_type)
            {
                //Best race type
                case 1:
                    $query = $this->race_summary->race_summary_by_qtt_best($id, $pick, $class_id);
                    break;
                
                //Point System race type
                case 2:
                    $query = $this->race_summary->race_summary_by_qtt_point($id);
                    break;
                
                //Grid race type
                case 3:
                    $query = $this->race_summary->race_summary_by_qtt_grid($id);
                    break;
            }
            
            $class_name = $this->class_model->get_class_name($id);
            $qtt_name = $this->qtt_model->get_qtt_by_name($id);
            
            //get datas from list_summary php view
            $laps = $this->input->post('laps');
            $race_num = $this->input->post('race_num');
            $racer_id = $this->input->post('racer_id');
            $time = $this->input->post('racer_time');
            $ranking = $this->input->post('racer_best');
            $data['class'] = $this->get_all_class();
            $data['records'] = $query;
           
            //prepping the data to display
            $data['class_name'] = $class_name;
            $data['qtt_name'] = $qtt_name;
            $data['title'] = "The Master Of Matic Race";
            $data['champions'] = "CHAMPIONSHIP 2012";
            $data['date'] = "MINGGU, 22 APRIL 2012";
            $data['location'] = "INT'L KARTING CIRCUIT SENTUL";
                        
            $html = $this->load->view("export_pdf",$data,TRUE);
            
            //load the mpdf54 library
            $this->load->library('mpdf54/mpdf');
            $this->load->helper('file');
            $stylesheet = read_file('assets/css/pdf.css');
            
            //create the pdf
            $this->mpdf=new mPDF('','A4','','',10,10,10,10,10,10);
            $this->mpdf->WriteHTML($stylesheet,1);
            $this->mpdf->WriteHTML($html,2);
            $this->mpdf->Output("$class_name" . " $qtt_name",'I');
       }
       //end export_pdf function
       
       
       /*
        * Function to export race final result to pdf format 
        */
       public function export_pdf_final($id, $race_type, $qtt_name)
       {
           
           //First, query the race_final table
           $query = $this->race_final->get_final_result($id, $race_type);
           
           //if the query returns a result
           if($query > 0)
           {
               //prepping the data for fianl view
               $class_name = $this->class_model->get_class_name($id);
               $data['records'] = $query;
               $data['date'] = "MINGGU, 22 APRIL 2012";
               $html = $this->load->view("export_pdf_final",$data,TRUE);
               
               //load the mpdf54 library
               $this->load->library('mpdf54/mpdf');
               $this->load->helper('file');
               $stylesheet = read_file('assets/css/pdf.css');
               
               if($qtt_name = "Race II")
               {
                   $qtt_name = "RaceII";
               }
               
               //create the pdf file
               $this->mpdf=new mPDF('','A4','','',10,10,10,10,10,10);
               $this->mpdf->WriteHTML($stylesheet,1);
               $this->mpdf->WriteHTML($html,2);
               $this->mpdf->Output("$class_name" . '-' . "$qtt_name",'I');
           }
       }
       //end export_pdf_final function
      
  
    
    }