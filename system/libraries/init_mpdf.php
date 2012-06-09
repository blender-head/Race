<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
if ( ! class_exists('mpdf')){
 require_once(BASEPATH.'libraries/mpdf53'.EXT);
}
$obj =& get_instance();
$obj->mpdf = new mpdf();
$obj->ci_is_loaded[] = 'mpdf';
?>  