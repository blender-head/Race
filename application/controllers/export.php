<?php

    class Export extends CI_Controller
    {
        
        public function pdf()
        {
            public function test($id, $pick, $race_type, $class_id)
        {
        
            $this->list_summary(8,0,3,6);
            
            $query = $this->race_summary->race_summary_by_qtt_point(8);
            
            $class_name = $this->class_model->get_class_name(8);
                        $qtt_name = $this->qtt_model->get_qtt_by_name(8);
                        $laps = $this->input->post('laps');
                        $race_num = $this->input->post('race_num');
                        $racer_id = $this->input->post('racer_id');
                        $time = $this->input->post('racer_time');
                        $ranking = $this->input->post('racer_best');
                        $data['class'] = $this->get_all_class();
                        $data['records'] = $query;
                        
                        $data['class_name'] = $class_name;
                        $data['qtt_name'] = $qtt_name;
                        $data['title'] = "The Master Of Matic Race";
                        $data['champions'] = "CHAMPIONSHIP 2012";
                        $data['date'] = "MINGGU, 22 APRIL 2012";
                        $data['location'] = "INT'L KARTING CIRCUIT SENTUL";
                        


           $html = $this->load->view("test_pdf",$data,TRUE);
  
    $this->load->library('mpdf54/mpdf');
    $this->load->helper('file');
    $stylesheet = read_file('assets/css/pdf.css');
    
  $this->mpdf=new mPDF('','A4','','',10,10,10,10,10,10);
  $this->mpdf->WriteHTML($stylesheet,1);
  $this->mpdf->WriteHTML($html,2);
  $this->mpdf->Output('mpdf.pdf','I');
  
        }
        }
        
    }
