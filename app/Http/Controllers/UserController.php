<?php

namespace dsiCorreo\Http\Controllers;

use Illuminate\Http\Request;
use dsiCorreo\Http\Requests;
use dsiCorreo\Http\Controllers\Controller;
use dsiCorreo\User;

class UserController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
