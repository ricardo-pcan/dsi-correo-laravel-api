<?php

namespace dsiCorreo\Http\Controllers\User;
use Illuminate\Http\Request;
use dsiCorreo\Http\Requests;
use dsiCorreo\Http\Controllers\Controller;
use dsiCorreo\Http\Controllers\AppController;
use Auth;

class DashboardController extends AppController{

    public function index()
    {
        //get the current user
        $user = Auth::user();

        //prepare the vars for template
        $this->template_data[ 'menu_items' ] = array(
            array(
                'type' => 'item',
                'text' => 'Prueba',
                'url'  => 'http://github.com'
            ),
            array(
                'type'  => 'menu',
                'text'  => $user->name,
                'items' => array(
                    array(
                        'text' => 'Cerrar Sesión',
                        'url' => route( 'Logout' )
                    )
                )
            ),
        );
        return View( 'user/dashboard', $this->template_data );
    }
}
?>
