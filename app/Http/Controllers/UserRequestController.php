<?php

namespace dsiCorreo\Http\Controllers;

use Illuminate\Http\Request;
use dsiCorreo\Http\Requests;
use dsiCorreo\Http\Controllers\Controller;
use dsiCorreo\Request as dsiRequest;
use dsiCorreo\DAO\dsiRequestDAO;
use dsiCorreo\User;
use \Validator;

class UserRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( $user_id )
    {
        $user_request = dsiRequestDAO::perUser( $user_id );
        return response()->json( $user_request, 200 );
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
        $first_role = 0;
        $last_role = dsiRequest::$Roles[ dsiRequest::$Roles['list'][ count( dsiRequest::$Roles['list'] ) - 1 ]['name']];
        $validation = Validator::make( $request->all(), [
            'user_id' => 'required|integer|exists:users,id',
            'first_name' => 'required|max:100',
            'first_last_name' => 'required|max:100',
            'second_last_name' => 'max:100',
            'department_id' => 'required|integer|exists:departments,id',
            'role' => 'required|integer|between:0,3',
            'employee_id' => 'required|integer|unique:requests,employee_id',
            'extension_number' => 'required|integer',
            'alternative_mail' => 'required|email|max:100'
        ]);
        if( $validation->fails() )
        {
            return response()->json( $validation->errors()->all(), 422  );
        }
        else
        {
            $user = User::find( $request->user_id );
            $request = new dsiRequest(
                array(
                    'first_name' => $request->first_name,
                    'first_last_name' => $request->first_last_name,
                    'second_last_name' => $request->second_last_name,
                    'department_id' => $request->department_id,
                    'role' => $request->role,
                    'employee_id' => $request->employee_id,
                    'extension_number' => $request->extension_number,
                    'alternative_mail' => $request->alternative_mail,
                    'status' => dsiRequest::$Status['Solicitado a DSI']
                )
            );
            if( $request = $user->requests()->save( $request ) )
            {
                return response()->json( "El registro se ha guardado con exito", 200 );
            }
            else
            {
                return resppnse()->json("Ha ocurrido un error, no se pudo guardar el registro", 404);
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
