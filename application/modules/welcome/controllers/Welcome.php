<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function test()
	{
		$data = array(
			'blog_title' => 'My Blog Title',
			'blog_heading' => 'My Blog Heading',
			'blog_entries'	=> $this->load->view('data'),
		);
		$this->load->view('index', $data);
	}
}
