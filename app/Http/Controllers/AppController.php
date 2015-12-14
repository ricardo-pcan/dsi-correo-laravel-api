<?php
namespace dsiCorreo\Http\Controllers;

use Illuminate\Http\Request;
use dsiCorreo\Http\Requests;
use dsiCorreo\Http\Controllers\Controller;
use Validator;

class AppController extends Controller
{

	protected $template_data = array(

			'title' => 'DSI Correos',
			'menu_items' => array(
				array(
					'text' => 'Test',
					'url' => 'http://www.google.com.mx'
				),
				array(
					'text' => "IPN",
					'url' => 'http://148.204.73.200:10080'
				)
			)
		);
    // Custom rules for some requests
    protected $rules_user = array(
        'user-mail' => 'required|email',
        'user-password' => 'required|min:6'
    );

    // Custom messages for validator

    protected $messages_user = array(
        'required' => 'El campo :attribute es requerido',
        'between' => 'El campo debe estar entre :min y :max',
        'min' => 'El campo debe tener mínimo :min caracteres',
        'email' => 'El campó debe :attribute debe ser una dirección de correo elctrónico válida'
    );


    //Custom validators for requests

    protected function UserValidator( Request $request )
    {
         return Validator::make( $request->all(), $this->rules_user, $this->messages_user );
    }
}
