<?php
namespace dsiCorreo\Http\Controllers;

use Illuminate\Http\Request;
use dsiCorreo\Http\Requests;
use dsiCorreo\Http\Controllers\Controller;

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
}
