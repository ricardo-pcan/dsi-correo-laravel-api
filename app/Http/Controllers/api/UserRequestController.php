<?php

namespace dsiCorreo\Http\Controllers\api;

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

    public function store(Request $request, $user_id)
    {

        $user = User::find( $user_id );
        if( !$user )
        {
            return response()->json( "No se encuentra el usuario", 404 );
        }
        $first_role = 0;
        $last_role = dsiRequest::$Roles[ dsiRequest::$Roles['list'][ count( dsiRequest::$Roles['list'] ) - 1 ]['name']];
        $validation = Validator::make( $request->all(), [
            'first_name' => 'required|max:100',
            'first_last_name' => 'required|max:100',
            'second_last_name' => 'max:100',
            'department_id' => 'required|integer|exists:departments,id',
            'role' => 'required|integer|between:0,3',
            'employee_id' => 'required|integer|unique:requests,employee_id',
            'extension_number' => 'required|integer',
            'alternative_mail' => 'required|email|max:100',
            'request_code' => 'max:50|unique:requests,request_code'
        ]);
        if( $validation->fails() )
        {
            return response()->json( $validation->errors()->all(), 422  );
        }
        else
        {
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
                    'status' => dsiRequest::$Status['Solicitado a DSI'],
                    'request_code' => $request->request_code
                )
            );
            if( $request = $user->requests()->save( $request ) )
            {
                return response()->json( "El registro se ha guardado con exito", 200 );
            }
            else
            {
                return response()->json("Ha ocurrido un error, no se pudo guardar el registro", 404);
            }
        }
    }

    public function show($user_id, $request_id)
    {
        $user = User::find( $user_id );
        if( !$user )
        {
            return response()->json( "No se ha encontrado el usuario", 404 );
        }
        else
        {
            $request_find = $user->requests()->find( $request_id );
            if( !$request_find )
            {
                return response()->json("No se encontro la petición", 404 );
            }
            else
            {
                return response()->json( $request_find, 200 );
            }
        }
    }


    public function update(Request $request, $user_id, $request_id )
    {
        $user = User::find( $user_id );
        if( !$user )
        {
            return response()->json( array(
                'message' => 'No se ha encontrado el usuario',
                'code' => 404
            ), 404 );
        }

        $request_find = $user->requests()->find( $request_id );
        if( !$request_find )
        {
            return response()->json( array(
                'message' => 'No se ha encontrado la petición con este usuario',
                'code' => 404
            ), 404 );
        }

        if( $request->method() == 'PATCH'  )
        {
            if( isset( $request->first_name  )  ){ $request_find->first_name = $request->first_name; }
            if( isset( $request->first_last_name )  ){ $request_find->first_last_name = $request; }
            if( isset( $request->second_last_name )  ){ $request_find->second_last_name = $request->second_last_name; }
            if( isset( $request->department_id ) )
            {
                $validation = Validator::make( $request->all(), [
                    'department_id' => 'required|integer|exists:departments,id'
                ]);
                if( $validation->fails()  )
                {
                    return response()->json( array(
                        'code' => 422,
                        'errors' => $validation->errors()->all()
                    ), 422  );
                }
                else
                {
                    $request_find->department_id = $request->department_id;
                }
            }
            if( isset( $request->role )  )
            {
                $validation = Validator::make( $request->all(), [
                    'role' => 'required|integer|between:0,3'
                ]);
                if( $validation->fails()  )
                {
                    return response()->json( array(
                        'code' => 422,
                        'errors' => $validation->errors()->all()
                    ), 422  );
                }
                else{
                    $request_find->role = $request->role;
                }

            }
            if( isset( $request->employee_id )  )
            {
                $validation = Validator::make( $request->all(), [
                    'employee_id' => 'required|integer|unique:requests,employee_id'
                ]);
                if( $validation->fails()  )
                {
                    return response()->json( array(
                        'code' => 422,
                        'errors' => $validation->errors()->all()
                    ), 422  );
                }
                else{
                    $request_find->employee_id = $request->employee_id;
                }

            }

            if( isset( $request->alternative_mail )  )
            {
                $validation = Validator::make( $request->all(), [
                    'alternative_mail' => 'email|max:100'
                ]);
                if( $validation->fails()  )
                {
                    return response()->json( array(
                        'code' => 422,
                        'errors' => $validation->errors()->all()
                    ), 422  );
                }
                else{
                    $request_find->alternative_mail = $request->alternative_mail;
                }

            }
            if( isset( $request->extension_number )  )
            {
                $validation = Validator::make( $request->all(), [
                    'extension_number' => 'integer'
                ]);
                if( $validation->fails()  )
                {
                    return response()->json( array(
                        'code' => 422,
                        'errors' => $validation->errors()->all()
                    ), 422  );
                }
                else{
                    $request_find->extension_number = $request->extension_number;
                }

            }
            if( isset( $request->request_code )  )
            {
                $validation = Validator::make( $request->all(), [
                    'request_code' => 'max:50|unique:requests,request_code'
                ]);
                if( $validation->fails()  )
                {
                    return response()->json( array(
                        'code' => 422,
                        'errors' => $validation->errors()->all()
                    ), 422  );
                }
                else{
                    $request_find->request_code = $request->request_code;
                }

            }
            if( $request_find->save() )
            {
                return response()->json( array(
                    'message' => 'El usuario se ha actualizado con exito',
                    'code' => 200
                ), 200);
            }
            else
            {
                return response()->json( array(
                    'message' => 'Ha ocurrido un error',
                    'code' => 500
                ), 500);
            }


        }
        if ( $request->method() == 'PUT' )
        {
            $validation = Validator::make( $request->all(), [
                'first_name' => 'required|max:100',
                'first_last_name' => 'required|max:100',
                'second_last_name' => 'max:100',
                'department_id' => 'required|integer|exists:departments,id',
                'role' => 'required|integer|between:0,3',
                'employee_id' => 'required|integer|unique:requests,employee_id',
                'extension_number' => 'required|integer',
                'alternative_mail' => 'required|email|max:100',
                'request_code' => 'max:50|unique:requests,request_code'
            ]);

            if ( $validation->fails() )
            {
                return response()->json( $validation->errors()->all(), 422 );
            }
            else
            {
                if( $request_find->fill( $request->all() )->save() )
                {
                    return response()->json( array(
                        'message' => 'La petición se ha actualizado con exito',
                        'code' => 200
                    ), 200 );
                }
                else
                {
                    return response()->json( array(
                        'message' => 'Ha ocurrido un error',
                        'code' => 500
                    ), 500 );
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $user_id
     * @param  int  $request_id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $user_id, $request_id )
    {
        $user = User::find( $user_id );
        if( !$user )
        {
            return response()->json( "No se encuentra el usuario", 404 );
        }
        $request_find = $user->requests()->find( $request_id );
        if( !$request_find )
        {
            return response()->json( "No se ha encontrado la petición", 404 );
        }
        $request_find->users()->detach();
        if( $request_find->delete() )
        {
            return response()->json( "La petición se ha eliminado con exito", 200 );
        }
        else
        {
            return response()->json( "Ha ocurrido un error", 500 );
        }


    }
}
