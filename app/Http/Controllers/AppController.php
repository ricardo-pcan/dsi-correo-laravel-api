<?php

namespace dsiCorreo\Http\Controllers;
use Illuminate\Http\Request;
use dsiCorreo\Http\Requests;
use dsiCorreo\Http\Controllers\Controller;
use dsiCorreo\Role;

class AppController extends Controller
{
    protected $ROLE_USER = Role::where('name', '=', 'user_dsi')->get()->first();
    protected $ROLE_ADMIN = Role::where( 'name', '=', 'admin')->get()->first();
}
