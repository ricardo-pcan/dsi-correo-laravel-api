<?php

use Illuminate\Database\Seeder;
use dsiCorreo\Role;
use dsiCorreo\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();
        $admin = Role::create(array(
            'name' => 'admin',
            'display_name' => 'Administrador'
        ));

        $admin_permissions = Permission::all();
        foreach ( $admin_permissions as $admin_permission )
        {
            $admin->attachPermission( $admin_permission );
        }

        /**
        *    Permissions for dsi user
        **/
        $user_dsi = Role::create(array(
            'name' => 'user_dsi',
            'display_name' => 'Usuario DSI'
        ));
        
        $user_dsi->attachPermission(Permission::where('name', '=', 'request_create')->get()->first());
        $user_dsi->attachPermission(Permission::where('name', '=', 'request_update')->get()->first());
        $user_dsi->attachPermission(Permission::where('name', '=', 'comments_create')->get()->first());
        $user_dsi->attachPermission(Permission::where('name', '=', 'comments_show')->get()->first());
        $user_dsi->attachPermission(Permission::where('name', '=', 'user_dsi_show')->get()->first());
    }
}
