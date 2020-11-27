<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Book extends Parent_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->session->set_userdata('top_menu', 'Library');
        $this->session->set_userdata('sub_menu', 'book/index');
        $data['title'] = 'Add Book';
        $data['title_list'] = 'Book Details';
        $listbook = $this->book_model->listbook();
        $data['listbook'] = $listbook;
        $this->load->view('layout/parent/header');
        $this->load->view('parent/book/createbook', $data);
        $this->load->view('layout/parent/footer');
    }

    function create() {
        $data['title'] = 'Add Book';
        $data['title_list'] = 'Book Details';
        $this->form_validation->set_rules('book_title', 'Book Title', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $listbook = $this->book_model->listbook();
            $data['listbook'] = $listbook;
            $this->load->view('layout/header');
            $this->load->view('admin/book/createbook', $data);
            $this->load->view('layout/footer');
        } else {
            $data = array(
                'book_title' => $this->input->post('book_title'),
                'subject' => $this->input->post('subject'),
                'rack_no' => $this->input->post('rack_no'),
                'publish' => $this->input->post('publish'),
                'author' => $this->input->post('author'),
                'qty' => $this->input->post('qty'),
                'perunitcost' => $this->input->post('perunitcost'),
                'postdate' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('postdate'))),
                'description' => $this->input->post('description')
            );
            $this->book_model->addbooks($data);
            redirect('admin/book/index');
        }
    }

    function edit($id) {
        $data['title'] = 'Edit Book';
        $data['title_list'] = 'Book Details';
        $data['id'] = $id;
        $editbook = $this->book_model->get($id);
        $data['editbook'] = $editbook;
        $this->form_validation->set_rules('book_title', 'Book Title', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $listbook = $this->book_model->listbook();
            $data['listbook'] = $listbook;
            $this->load->view('layout/header');
            $this->load->view('admin/book/editbook', $data);
            $this->load->view('layout/footer');
        } else {
            $data = array(
                'id' => $this->input->post('id'),
                'book_title' => $this->input->post('book_title'),
                'subject' => $this->input->post('subject'),
                'rack_no' => $this->input->post('rack_no'),
                'publish' => $this->input->post('publish'),
                'author' => $this->input->post('author'),
                'qty' => $this->input->post('qty'),
                'perunitcost' => $this->input->post('perunitcost'),
                'postdate' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('postdate'))),
                'description' => $this->input->post('description')
            );
            $this->book_model->addbooks($data);
            $this->session->set_flashdata('msg', '<div feemaster="alert alert-success text-center">book details added to Database!!!</div>');
            redirect('admin/book/index');
        }
    }

    function delete($id) {
        $data['title'] = 'Fees Master List';
        $this->book_model->remove($id);
        redirect('admin/book/index');
    }

}

?>