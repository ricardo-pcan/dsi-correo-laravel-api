<?php

namespace dsiCorreo\Http\Controllers\api;

use Illuminate\Http\Request;
use dsiCorreo\Http\Requests;
use dsiCorreo\Http\Controllers\Controller;
use dsiCorreo\Request as dsiRequest;
use dsiCorreo\DAO\dsiRequestDAO;

class RequestUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( $request_id )
    {
        $request = dsiRequest::find( $request_id );
        if ( !$request )
        {
            return response()->json(
                array(
                    'data' => null,
                    'message' => "No se ha encontrado la petición",
                    'errors' => array()
                ),
                404
            );
        }
        $user_request = dsiRequestDAO::userPerRequest( $request_id );
        return response()->json( array(
            'data' => $user_request,
            'messsage' => "",
            'errors' => array()
        ), 200 );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $request_id, $user_id )
    {
        $request_find = dsiRequest::find( $request_id );
        if( !$request_find )
        {
            return response()->json( array(
                'message' => "No se encontró la petición",
                'code' => 404
            ) ,404);
        }
        $user = User::find( $user_id );
        if( !$user )
        {
            return response()->json( array(
                'message' => "No se encontró el usuario",
                'code' => 404
            ), 404 );
        }

        $users_per_request = dsiRequestDAO::userPerRequest( $request_id );
        if( $users_per_request->count() > 1 )
        {
            if( $request_find->users()->detach( $request_id ) )
            {
                return response()->json( 200 );
            }
        }
    }
}
