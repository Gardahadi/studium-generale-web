<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

	
	public function index()
	{
		$this->load->view('partials/header');
		$this->load->view('home');
		$this->load->view('partials/footer');
	}
	public function form()
	{
		$this->load->view('partials/header');
		$this->load->view('form');
		$this->load->view('partials/footer');
	}
}
