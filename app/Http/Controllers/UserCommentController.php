<?php

namespace dsiCorreo\Http\Controllers;

use Illuminate\Http\Request;
use dsiCorreo\Http\Requests;
use dsiCorreo\Http\Controllers\Controller;
use dsiCorreo\User;
use dsiCorreo\DAO\UserDAO;
use dsiCorreo\Comment;
use \Validator;

class UserCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( $user_id )
    {
        $user = User::find( $user_id );
        if( !$user )
        {
            return response()->json( array(
                'message' => 'No se ha encontrado el usuario',
                'code' => 404
            ), 404 );
        }
        else
        {
            return response()->json( array(
                'data' => UserDAO::getAllComments( $user_id ),
                'code' => 200
            ), 200 );
        }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store( Request $request, $user_id )
    {
        $user = User::find( $user_id );
        if( !$user )
        {
            return response()->json( array(
                'message' => 'No se encontro el usuario',
                'code' => 404
            ), 404 );
        }
        else
        {
            $validation = Validator::make( $request->all(), [
                'content' => 'required|max:200',
                'request_id' => 'required|integer|exists:requests,id'
            ]);

            if( $validation->fails() )
            {
                return response()->json( array(
                    'code' => 500,
                    'errors' => $validation->errors()->all()
                ), 500 );
            }
            else
            {
                $comment = new Comment (
                    array(
                        'content' => $request->content,
                        'user_id' => $user_id,
                        'request_id' => $request->request_id
                    )
                );
                if( $comment->save() )
                {
                    return response()->json( array(
                        'message' => 'El comentario se ha guardado con exito',
                        'code' => 200
                    ), 200);
                }
                else
                {
                    return response()->json( array(
                        'message' => 'No se ha podido guardar el comentario',
                        'code' => 500
                    ), 500 );
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $user_id, $comment_id)
    {
        $user = User::find( $user_id );
        if( !$user )
        {
            return response()->json( array(
                'message' => 'No se encontró el usuario',
                'code' => 404
            ), 404 );
        }

        $comment = $user->comments()->find( $comment_id );
        if( !$comment )
        {
            return response()->json( array(
                'message' => 'No se encontró el comentario',
                'code' => 404
            ), 404);
        }

        return response()->json( array(
            'data' => $comment,
            'code' => 200
        ), 200 );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id, $comment_id )
    {
        $user = User::find( $user_id );
        if( !$user )
        {
            return response()->json( array(
                'message' => 'No se encontró el usuario',
                'code' => 404
            ), 404 );
        }

        $comment = $user->comments()->find( $comment_id );
        if( !$comment )
        {
            return response()->json( array(
                'message' => 'No se encontró el comentario',
                'code' => 404
            ), 404);
        }

        // Check if patch method
        if( $request->method() == 'PATCH' )
        {
            $check_patch = false;
            if( isset(  $request->content  ) )
            {
                $validation = Validator::make( $request->all(), [
                    'content' => 'max:200'
                ] );
                if( $validation->fails() )
                {
                    return response()->json( array(
                        'errors' => $validation->errors()->all(),
                        'code' => 422
                    ), 422 );
                }
                else
                {
                    $comment->content = $request->content;
                    $check_patch = true;
                }
            }

            if( isset( $request->request_id ) )
            {
                $validation = Validator::make( $request->all(), [
                    'request_id' => 'required|integer|exists:requests,id'
                ] );
                if( $validation->fails() )
                {
                    return response()->json( array(
                        'errors' => $validation->errors()->all(),
                        'code' => 422
                    ), 422 );
                }
                else
                {
                    $comment->request_id = $request->request_id;
                    $check_patch = true;
                }
            }

            if( $check_patch )
            {
                if( $comment->save() )
                {
                    return response()->json( array(
                        'message' => 'El comentario se ha actualizado con exito!',
                        'code' => 200
                    ), 200 );
                }
                else
                {
                    return response()->json( array(
                        'message' => "No se ha podido actualizar",
                        'code' => 500
                    ), 500 );
                }
            }
            else
            {
                return response()->json( array(
                    'message' => 'No se enviarón parámetros',
                    'code' => 400
                ), 400);
            }
        }
        if( $request->method() == "PUT" )
        {
            $validation = Validator::make( $request->all(), [
                'content' => 'required|max:200',
                'request_id' => 'required|integer|exists:requests,id'
            ]);

            if( $validation->fails() )
            {
                return response()->json( array(
                    'code' => 422,
                    'errors' => $validation->errors()->all()
                ), 422 );
            }
            else
            {
                $comment->content = $request->content;
                $comment->request_id = $request->request_id;
                if( $comment->save() )
                {
                    return response()->json( array(
                        'message' => 'El comentario se ha guardado con exito',
                        'code' => 200
                    ), 200);
                }
                else
                {
                    return response()->json( array(
                        'message' => 'No se ha podido guardar el comentario',
                        'code' => 500
                    ), 500 );
                }
            }
        }
    }
}
