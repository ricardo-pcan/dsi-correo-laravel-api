<?php

namespace dsiCorreo\Http\Controllers\api;

use Illuminate\Http\Request;
use dsiCorreo\Http\Requests;
use dsiCorreo\Http\Controllers\Controller;
use dsiCorreo\Http\Controllers\AppController;
use dsiCorreo\User;
use dsiCorreo\DAO\UserDAO;
use \Validator;
use dsiCorreo\Role;
use Crypt;

class UserController extends AppController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json( array(
            'data' => User::all(),
            'code' => 200
        ), 200 );

    }

    public function get_dsi_users()
    {
        return response()->json(array(
            'data' => UserDAO::getDSIUsers(),
            'code' => 200
        ), 200);
    }

    public function get_admins()
    {
        return response()->json(array(
            'data' => UserDAO::getAdminUsers(),
            'code' => 200
        ), 200 );
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_dsi_role = Role::where( 'name', '=', 'user_dsi')->get()->first();
        $admin_role = Role::where( 'name', '=', 'admin')->get()->first();
        $validation = Validator::make( $request->all(), [
            'name' => 'required|max:100',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6',
            'department_id' => 'required|integer|exists:departments,id',
            'role' => 'required|integer|between:0,1'

        ]);

        if( $validation->fails() )
        {
            return response()->json( array(
                'code' => 402,
                'errors' => $validation->errors()->all()
            ), 402 );
        }
        else
        {
            $user = new User(
                array(
                    'name' => $request->name,
                    'email' => $request->email,
                    'department_id' => $request->department_id,
                    'password' => Crypt::encrypt( $request->password )
                )
            );
            if( $user->save() )
            {
                if( $request->role == 0 )
                {
                    $user->attachRole( $user_dsi_role );
                    return response()->json( array(
                        'message' => 'Tu Usuario DSI se ha registrado con exito',
                        'code' => 200
                    ) ,200 );
                }
                else
                {
                    if( $request->role == 1 )
                    {
                        $user->attachRole( $admin_role );
                        return response()->json( array(
                            'message' => 'Tu Usuario DSI se ha registrado con exito',
                            'code' => 200
                        ), 200 );
                    }
                }
            }
            else
            {
                return response()->json( array(
                    'message' => 'No se ha podido guardar el usuario',
                    'code' => 500
                ), 500 );
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $user_id )
    {
        $user = User::find( $user_id );
        if( !$user )
        {
            return response()->json( array(
                'message' => "No se ha encontrado el usuario",
                'code' => 404
            ), 404);
        }
        else
        {
            return response()->json( array(
                'data' => $user,
                'code' => 200
            ), 200 );
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id)
    {
        $user = User::find( $user_id );
        if( !$user )
        {
            return response()->json( array(
                'message' => "No se ha encontrado el usuario",
                'code' => 404
            ), 404);
        }

        $validation = Validator::make( $request->all(), [
            'name' => 'required|max:100',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6',
            'department_id' => 'required|integer|exists:departments,id',
            'role' => 'required|integer|between:0,1'

        ]);
        if( $validation->fails() )
        {
            return response()->json( array(
                'code' => 402,
                'errors' => $validation->errors()->all()
            ), 422 );
        }
        else
        {
            $user->update(
                array(
                    'name' => $request->name,
                    'email' => $request->email,
                    'department_id' => $request->department_id,
                    'password' => Crypt::encrypt( $request->password )
                )
            );
            if( $user->save() )
            {
                if( $request->role == 0 )
                {
                    $user->attachRole( $user_dsi_role );
                    return response()->json( array(
                        'message' => 'Tu Usuario DSI se ha actualizado con exito',
                        'code' => 200
                    ) ,200 );
                }
                else
                {
                    if( $request->role == 1 )
                    {
                        $user->attachRole( $admin_role );
                        return response()->json( array(
                            'message' => 'Tu Usuario DSI se ha actualizado con exito',
                            'code' => 200
                        ), 200 );
                    }
                }
            }
            else
            {
                return response()->json( array(
                    'message' => 'No se ha podido actualizar el usuario',
                    'code' => 500
                ), 500 );
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
