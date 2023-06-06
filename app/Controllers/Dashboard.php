<?php

namespace App\Controllers;

class Dashboard extends BaseController
{

    public function __construct()
    {
    }

    public function index()
    {
        $data = [
            'tittle' => 'Dashboard | Home'
        ];
        return view('Dashboard/index', $data);
    }
}
