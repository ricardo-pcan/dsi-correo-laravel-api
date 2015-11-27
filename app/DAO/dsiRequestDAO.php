<?php

namespace dsiCorreo\DAO;

use Illuminate\Database\Eloquent\Model;
use dsiCorreo\Request as dsiRequest;
use dsiCorreo\User;

class dsiRequestDAO extends Model
{
    public static function perUser( $user_id )
    {
        $user = User::find( $user_id );
        return $user->requests;
    }

    public static function userPerRequest( $request_id )
    {
        $request = dsiRequest::find( $request_id );
        return $request->users;
    }

    public static function getAllComments( $request_id )
    {
        $request = dsiRequest::find( $request_id );
        return $request->comments;
    }

    public static function getAllDelivered()
    {
        $requests = dsiRequest::all();
        $delivered_request = collect();
        foreach( $requests as $request )
        {
            if( !empty( $request->request_code ) )
            {
                $delivered_request->push( $request );
            }
        }
        return $delivered_request;

    }
}
?>
