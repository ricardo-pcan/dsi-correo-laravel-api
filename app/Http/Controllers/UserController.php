<?php

namespace dsiCorreo\Http\Controllers;

use Illuminate\Http\Request;
use dsiCorreo\Http\Requests;
use dsiCorreo\Http\Controllers\Controller;
use dsiCorreo\User;
use \Validator;

class UserController extends AppController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json( User::all(), 200 );

    }

    public function get_dsi_users()
    {
        $users = User::all();
        $dsi_users = collect();

        foreach ( $users as $user )
        {
            if( $user->hasRole('user_dsi', true) )
            {
                $dsi_users->push( $user );
            }
        }
        return response()->json( $dsi_users, 200 );
    }

    public function get_admins()
    {
        $users = User::all();
        $admins = collect();

        foreach ( $users as $user )
        {
            if ( $user->hasRole( 'admin', true ) )
            {
                $admins->push( $user );
            }
        }
        return response()->json( $admins, 200 );
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validation = Validator::make( $request::all, [
            'name' => 'required|max:100',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|integer|between:0,1'

        ]);

        if( $validation->fails() )
        {
            return response()->json( "Ha ocurrido un error", 402 );
        }
        else
        {
            $user = new User(
                array(
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Crypt::encrypt( $request->password )
                )
            );
            if( $user->save )
            {
                if( $request->role == 0 )
                {
                    $user->attachRole( $this->ROLE_USER );
                }
                else
                {
                    $user->attachRole( $this->ROLE_ADMIN );
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
