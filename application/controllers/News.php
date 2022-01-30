<?php
defined('BASEPATH') or exit('No direct script access allowed');

class News extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->model('News_model');
    }

    public function index()
    {
        $config['base_url'] = base_url('News/index');
        $config['total_rows'] = $this->News_model->getAllNewsCount();
        $config['per_page'] = 5;
        $config['uri_segment'] = 3;
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $this->pagination->initialize($config);
        $data['results'] = $this->News_model->getAllNews($config['per_page'], $page);
        $data['links'] =  $this->pagination->create_links();

        $this->load->view('common/header');
        $this->load->view('news',$data);
        $this->load->view('common/footer');
        
    }

    public function setNews()
    {
        $data = array(
            'Title' => $this->input->post('Title'),
            'text' => $this->input->post('text')
        );
        $this->News_model->setNews($data);
    }

    public function updateNews()
    {
        $data = array(
            'id' => $this->input->post('id'),
            'title' => $this->input->post('news'),
            'text' => $this->input->post('data')
        );
        $this->News_model->updateNews($data);
    }

    public function deleteNews()
    {
        $id = $this->input->post('id');
        $this->News_model->deleteNews($id);
    }

    public function searchNews()
    {
        $search = $this->input->post('search');
        $config['base_url'] = base_url('News/searchNews');
        $config['per_page'] = 5;
        $config['total_rows'] = $this->News_model->searchNewsCount($search);
        $config['uri_segment'] = 3;
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        //$page = ($page - 1) * $config['per_page'];
        $this->pagination->initialize($config);
        $data['results'] = $this->News_model->searchNews($page,$config['per_page'], $search);
        $data['links'] =  $this->pagination->create_links();
        $this->load->view('news',$data);
    }
}
