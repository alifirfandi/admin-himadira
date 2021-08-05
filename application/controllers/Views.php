<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Views extends CI_Controller
{
    // Public Variable
    public $session;
    public $sideBar, $navBar;

    public function __construct()
    {
        parent::__construct();

        // Load Model
        $this->load->model("SideBar");

        // Load Helper
        $this->session = new Session_helper();

        // Get Side Bar
        $this->sideBar = $this->SideBar->getSideBar();

        // Check Auth
        $this->checkAuth();
    }

    // Check Auth
    private function checkAuth()
    {
        if (!$this->session->check_session(HIMADIRA_ADMIN_AUTH)) {
            redirect(base_url("authcheck/login"));
        }
    }

    // Index
    public function index()
    {
        header('Location: ' . base_url("views/dashboard"));
    }

    // ============================================================================= Dashboard

    public function dashboard()
    {
        $this->load->view("dashboard", array(
            'title' => "Dashboard",
            'sideBar' => $this->sideBar
        ));
    }

    public function contentInstagram()
    {
        $this->load->view("content-instagram", array(
            'title' => "Instagram Content",
            "sideBar" => $this->sideBar
        ));
    }

    public function createContentInstagram()
    {
        $this->load->view("create-content", array(
            'title' => "Instagram Content",
            "sideBar" => $this->sideBar
        ));
    }

    public function editContentInstagram($id)
    {
        $this->load->view("edit-content", array(
            'title' => "Instagram Content",
            "sideBar" => $this->sideBar,
            'idContent' => $id
        ));
    }

    public function contentMedium()
    {
        $this->load->view("content-medium", array(
            "title" => "Medium Content",
            "sideBar" => $this->sideBar
        ));
    }

    public function createContentMedium()
    {
        $this->load->view("create-content-medium", array(
            "title" => "Medium Content",
            "sideBar" => $this->sideBar
        ));
    }

    public function editContentMedium()
    {
        $this->load->view("edit-content-medium", array(
            "title" => "Medium Content",
            "sideBar" => $this->sideBar
        ));
    }

    public function categories()
    {
        $this->load->view("categories", array(
            "title" => "Categories",
            "sideBar" => $this->sideBar
        ));
    }

    public function tags()
    {
        $this->load->view("tags", array(
            "title" => "Tags",
            "sideBar" => $this->sideBar
        ));
    }

    public function about()
    {
        $this->load->view("about", array(
            "title" => "About Page",
            "sideBar" => $this->sideBar
        ));
    }
}
