<?php

namespace dsiCorreo\Http\Controllers\api;

use Illuminate\Http\Request;
use dsiCorreo\Http\Requests;
use dsiCorreo\Http\Controllers\Controller;
use dsiCorreo\Request as dsiRequest;
use dsiCorreo\DAO\dsiRequestDAO;

class RequestController extends Controller
{
    public function __construct()
    {
        //$this->middleware( 'c_permission:request_show', [ 'only' => [ 'index' ] ] );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        if( $request->has('with')  )
        {
            switch( $request->with )
            {
            case 'codes':
                return response()->json( array(
                    'message' => 'Peticiones con código',
                    'data' => dsiRequestDAO::getAllDelivered(),
                    'errors' => array(),
                    'code' => 200
                ), 200 );
                break;
            default:
                return response()->json( array(
                    'message' => 'No se encuentra ninguna petición con esos parámetros',
                    'data' => array(),
                    'errors' => array(),
                    'code' => 404
                ), 404 );
                break;
            }
        }
        return response()->json( array(
            'message' => 'Todas las peticiones encontradas',
            'data' => dsiRequest::all(),
            'errors' => array(),
            'code' => 200
        ), 200 );
    }

}
