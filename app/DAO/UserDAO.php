<?php
namespace dsiCorreo\DAO;

use Illuminate\Database\Eloquent\Model;
use dsiCorreo\User;
use dsiCorreo\Role;
use dsiCorreo\Comment;

class UserDAO extends Model
{
    public static function getDSIUsers()
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
        return $dsi_users;
    }

    public static function getAdminUsers()
    {
        $users = User::all();
        $dsi_users = collect();

        foreach ( $users as $user )
        {
            if( $user->hasRole('admin', true) )
            {
                $dsi_users->push( $user );
            }
        }
        return $dsi_users;
    }

    public static function getAllComments( $user_id )
    {
       $user = User::find( $user_id );
       return $user->comments;
    }
}
?>
