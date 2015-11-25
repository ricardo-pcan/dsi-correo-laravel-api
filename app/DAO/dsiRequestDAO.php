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
}
?>
