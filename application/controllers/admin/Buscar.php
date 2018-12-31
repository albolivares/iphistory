<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Posts Management class created by CodexWorld
 */
class Buscar extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('admin/panel_model','post');
        $this->perPage = 10;
        $this->load->library(array('ion_auth','form_validation','Ajax_pagination'));
        $this->load->helper(array('url','language'));

        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth', 'refresh');
        }
    }
    
    public function index(){
        $data = array();
        
        //total rows count
        $totalRec = count($this->post->getRows());
        
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'posts/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //get the posts data
        $data['posts'] = $this->post->getRows(array('limit'=>$this->perPage));
        
        //load the view
        $this->load->view('buscar/index', $data);
    }
    
    public function prueba(){
     $this->load->view('buscar/prueba');   
    }

    function ajaxPaginationData(){
        $conditions = array();
        
        //calc offset number
        $page = $this->input->post('page');
        if(!$page){
            $offset = 0;
        }else{
            $offset = $page;
        }
        
        //set conditions for search
        $keywords = $this->input->post('keywords');
        $sortBy = $this->input->post('sortBy');
        if(!empty($keywords)){
            $conditions['search']['keywords'] = $keywords;
        }
        if(!empty($sortBy)){
            $conditions['search']['sortBy'] = $sortBy;
        }
        
        //total rows count
        $totalRec = count($this->post->getRows($conditions));
        
        //pagination configuration
        $config['target']      = '#postList';
        $config['base_url']    = base_url().'posts/ajaxPaginationData';
        $config['total_rows']  = $totalRec;
        $config['per_page']    = $this->perPage;
        $config['link_func']   = 'searchFilter';
        $this->ajax_pagination->initialize($config);
        
        //set start and limit
        $conditions['start'] = $offset;
        $conditions['limit'] = $this->perPage;
        
        //get posts data
        $data['posts'] = $this->post->getRows($conditions);
        
        //load the view
        $this->load->view('admin/ajax_busc_histo', $data, false);
    }



}