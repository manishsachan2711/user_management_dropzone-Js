<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Bus\DispatchesJobs;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests, DispatchesJobs;


    protected $page_vars = [];
    protected $page_title = 'User Management';

    protected function setPageTitle($title) {
        if (!empty($title)) {
            if (strpos($title, $this->page_title) === false) {
                $this->page_title = $this->page_title . ' - ' . $title;
            } else {
                $this->page_title = $title;
            }
        }
    }

    protected function getPageTitle() {
        return $this->page_title;
    }

    protected function renderView($view_name = 'page_not_found', $end) {
        return view($end . '.' . $view_name, $this->page_vars);
    }
}
