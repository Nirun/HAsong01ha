<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nirun
 * Date: 1/3/2556
 * Time: 23:27 น.
 * To change this template use File | Settings | File Templates.
 */
class Search extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        mb_internal_encoding('UTF-8');
        $name = $this->input->get('fname') !== false ? $this->input->get('fname') : '';
        $lname = $this->input->get('lname') !== false ? $this->input->get('lname') : '';



        // var_dump($name, $lname);
        $data = array();
        if ($name == '' && $lname == '') {
            $data['data'] = false;
        } else {
            $this->load->model('search_m', 'search_m');
            $this->search_m->context['limit'] = 100;
            $this->search_m->context['filter']['name'] =  $name;
            $this->search_m->context['filter']['lastname'] = $lname;
            $res = $this->search_m->getUserList();
            $data['data'] = $res;
        }
        $this->load->view('search', $data);
    }
}
