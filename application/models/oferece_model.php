<?php
class Oferece_model extends CI_Model{

function __construct() {
parent::__construct();
}
function form_insert($data){
// Inserting in Table(transportesemcurso) of Database(anima)
$this->db->insert('transportesemcurso', $data);
}
}



