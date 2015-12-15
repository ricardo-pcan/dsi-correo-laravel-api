<?php

namespace dsiCorreo\Http\Controllers;

use Illuminate\Http\Request;

use dsiCorreo\Http\Requests;
use dsiCorreo\Http\Controllers\Controller;

class DashboardController extends AppController
{
    public function __construct()
    {
        $this->middleware( 'c_guest' );
    }

    public function index()
    {
        return View( 'login', $this->template_data );
    }
}
