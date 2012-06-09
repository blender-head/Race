<?php

    class Site_info extends CI_Model
    {
        
        public function check_data()
        {
            $query = $this->db->query('SELECT * FROM site_info');
            return $query->result();
        }
        
        public function delete_data()
        {
            $query = $this->db->query('DELETE FROM site_info');
            return $query;
        }
        
        public function save_data($site_title, $site_title_sub, $site_track)
        {
            $query = $this->db->query("INSERT INTO site_info (site_title, site_title_sub, site_track) VALUES ('$site_title', '$site_title_sub', '$site_track')");
            return $query;
        }
        
        public function reset_auto_increment()
        {
            $query = $this->db->query('ALTER TABLE site_info AUTO_INCREMENT = 1');
        }
        
        public function get_site_info()
        {
            $query = $this->db->query('SELECT site_title, site_title_sub, site_track FROM site_info');
            return $query->result();
        }
        
    }
