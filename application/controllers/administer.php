<?php

/*
 * Administer Controller
 */

    class Administer extends CI_Controller
    {
        
        //function to save user's entry site's info
        public function site_info()
        {
            
            //Get the data from admin_site_info.php form
            $site_title = $this->input->post('site-title');
            $site_subtitle = $this->input->post('site-sub-title');
            $site_track = mysql_real_escape_string($this->input->post('site-track'));
            
            //Set validation rule for the form
            $this->form_validation->set_rules('site-title', 'site title', 'required');
            $this->form_validation->set_rules('site-sub-title', 'site sub title', 'required');
            $this->form_validation->set_rules('site-track', 'site location', 'required');
            
            
            //If the form fails to validate
            if($this->form_validation->run() == FALSE)
            {
                //Set the $success variable to empty
                $data['success'] = "";
                
                //load the admin_site_info.php view
                $this->load->view('admin_site_info', $data);               
            }
            else //if we succeed
            {
                //query the site_info table
                //check if any data exist
                $check_first = $this->site_info->check_data();
                
                
                //if the site_info table is not empty
                if(count($check_first) > 0)
                {
                    //delete all the data ini it first
                    //we only need one value, and one value only
                    $delete_first = $this->site_info->delete_data();
                    
                    
                    //if the deletion operation succeeded
                    if($delete_first)
                    {
                        
                        //reset the auto_increment for the table
                        $this->site_info->reset_auto_increment();
                        
                        //then, save the data to the table
                        $save_data = $this->site_info->save_data($site_title, $site_subtitle, $site_track);
                        
                        //if the save operation succeeded
                        if(sizeof($save_data) > 0)
                        {
                            //set the $success variable
                            $data['success'] = "Data saved successfully";
                            
                            //load the admin_site_info.php view
                            $this->load->view('admin_site_info', $data);
                        }
                        else //if the save operation was failed
                        {   
                            //simply output a string to the browser
                            echo "Failed";
                        }
                    }
                }
                else //if the table is empty
                { 
                    
                    //reset the auto_increment for the table
                    $this->site_info->reset_auto_increment();
                    
                      //then, save the data to the table
                    $save_data = $this->site_info->save_data($site_title, $site_subtitle, $site_track);
                    
                     //if the save operation succeeded
                    if(sizeof($save_data) > 0)
                    {
                        //set the $success variable
                        $data['success'] = "Data saved successfully";
                            
                        //load the admin_site_info.php view
                        $this->load->view('admin_site_info', $data);
                    }
                    else //if the save operation was failed
                    {   
                        //simply output a string to the browser
                        echo "Failed";
                    }
                }
         
            }
            
        }
        //end site_info function
        
        
        public function schedule()
        {
            $class = $this->class_model->get_all_class();
            $qtt = $this->qtt_model->get_all_qtt();
            
            $data['class'] = $class;
            $data['qtt'] = $qtt;
            
            $this->load->view('schedule', $data);
        }
        
    }