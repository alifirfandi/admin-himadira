<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SideBar extends CI_Model
{
    public function getSideBar()
    {
        return array(
            array(
                "label" => "Dashboard",
                "href" => base_url("views/dashboard"),
                "icon" => "fas fa-fw fa-tachometer-alt",
                "divider" => true,
                "sidebar-heading" => "Manage Content"
            ),
            array(
                "label" => "Landing Page",
                "href" => base_url("views/landing"),
                "icon" => "fas fa-fw fa-home",
                "divider" => false,
            ),
            array(
                "label" => "Instagram Content",
                "href" => base_url("views/contentInstagram"),
                "icon" => "fab fa-fw fa-instagram",
                "divider" => false,
            ),
            array(
                "label" => "Medium Content",
                "href" => base_url("views/contentMedium"),
                "icon" => "fab fa-fw fa-medium",
                "divider" => false,
            ),
            array(
                "label" => "About Page",
                "href" => base_url("views/about"),
                "icon" => "fas fa-fw fa-address-card",
                "divider" => true,
                "sidebar-heading" => "Master Data"
            ),
            array(
                "label" => "Inbox",
                "href" => base_url("views/inbox"),
                "icon" => "fas fa-fw fa-envelope",
                "divider" => false,
            ),
            array(
                "label" => "Tags",
                "href" => base_url("views/tags"),
                "icon" => "fas fa-fw fa-tags",
                "divider" => false,
            ),
            array(
                "label" => "Categories",
                "href" => base_url("views/categories"),
                "icon" => "fas fa-fw fa-th-large",
                "divider" => false,
            ),
        );
    }
}
