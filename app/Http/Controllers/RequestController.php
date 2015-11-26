<?php

namespace dsiCorreo\Http\Controllers;

use Illuminate\Http\Request;
use dsiCorreo\Http\Requests;
use dsiCorreo\Http\Controllers\Controller;
use dsiCorreo\Request as dsiRequest;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        if( $request->has('with')  )
        {
           //return "hola";
            return dsiRequest::delivery();
        }
        $requests = dsiRequest::all();
        return response()->json($requests, 200);
    }

}
