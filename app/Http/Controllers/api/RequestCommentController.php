<?php

namespace dsiCorreo\Http\Controllers\api;

use Illuminate\Http\Request;
use dsiCorreo\Http\Requests;
use dsiCorreo\Http\Controllers\Controller;
use dsiCorreo\Request as dsiRequest;
use dsiCorreo\DAO\dsiRequestDAO;

class RequestCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( $request_id )
    {
        $request_find = dsiRequest::find( $request_id  );
        if( !$request_find )
        {
            return response()->json(
                array(
                    'message' => 'No se encuentra la petición',
                    'code' => 404,
                    'errors' => array(),
                    'data' => array()
                ), 404
            );
        }
        else
        {
            return response()->json( array(
                'message' => 'Comentarios encontrados',
                'data' => dsiRequestDAO::getAllComments( $request_id ),
                'errors' => array(),
                'code' => 200
            ), 200 );
        }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $request_id, $comment_id )
    {
        $request_find = dsiRequest::find( $request_id );
        if( !$request_find  )
        {
            return response()->json( array(
                'message' => 'No se encontró la petición',
                'data' => array(),
                'errors' => array(),
                'code' => 404
            ), 404 );
        }

        $comment = $request_find->comments()->find( $comment_id );
        if( !$comment )
        {
            return response()->json( array(
                'message' => 'No se encontró el comentario',
                'data' => array(),
                'errors' => array(),
                'code' => 404
            ), 404 );
        }

        if( $comment->delete() )
        {
            return response()->json( array(
                'message' => 'El comentario se ha eliminado con exito',
                'data' => array(),
                'errors' => array(),
                'code' => 200
            ), 200 );
        }
        else
        {
            return response()->json( array(
                'message' => 'Ha ocurrido un error en el servidor',
                'data' => array(),
                'errors' => array(),
                'code' => 500
            ), 500 );
        }

    }
}
