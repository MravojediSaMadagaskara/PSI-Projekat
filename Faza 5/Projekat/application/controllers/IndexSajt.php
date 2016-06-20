<?php

//Autor: Sofija Nicic

use Doctrine\Common\Collections\Criteria;

class IndexSajt extends CI_Controller {
	
	public function index() {
		$this->load->helper('form');
		$this->load->helper('url');
		
		$data['poruka']='';
		$this->load->view('indexSajt', $data);
	}
}