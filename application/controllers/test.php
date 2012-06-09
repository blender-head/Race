<?php

class Test extends CI_Controller 
{
 
    public function index() 
    {
        $query = $this->db->get('racer');
        //echo count($query);
        
        foreach ($query->result() as $row)
        {
            echo $row->racer_number;
            echo '<br>';
        }
    }
 
} 