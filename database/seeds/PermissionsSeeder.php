<?php

use Illuminate\Database\Seeder;
use dsiCorreo\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->delete();
        /**
        *    Permissions over requests
        **/
        $request_create = new Permission();
        $request_create->name = "request_create";
        $request_create->display_name = "Crear Peticiones";
        $request_create->save();

        $request_destroy = new Permission();
        $request_destroy->name = "request_destroy";
        $request_destroy->display_name = "Eliminar Peticiones";
        $request_destroy->save();

        $request_update = new Permission();
        $request_update->name = "request_update";
        $request_update->display_name = "Actualizar Peticiones";
        $request_update->save();

        $request_show = new Permission();
        $request_show->name = "request_show";
        $request_show->display_name = "Ver Perticiones";
        $request_show->save();

        /**
        * Permissions over dsi users
        */
        $user_dsi_create = new Permission();
        $user_dsi_create->name = "user_dsi_create";
        $user_dsi_create->display_name = "Crear Usuarios DSI";
        $user_dsi_create->save();

        $user_dsi_destroy = new Permission();
        $user_dsi_destroy->name = "user_dsi_destroy";
        $user_dsi_destroy->display_name = "Eliminar Usuarios DSI";
        $user_dsi_destroy->save();

        $user_dsi_view = new Permission();
        $user_dsi_view->name = "user_dsi_show";
        $user_dsi_view->display_name = "Ver Usuarios DSI";
        $user_dsi_view->save();

        $user_dsi_update = new Permission();
        $user_dsi_update->name = "user_dsi_update";
        $user_dsi_update->display_name = "Actualizar Usuarios DSI";
        $user_dsi_update->save();

        /**
        *    Permission over comments
        **/

        $comments_create = new Permission();
        $comments_create->name = "comments_create";
        $comments_create->display_name = "Crear comentarios";
        $comments_create->save();

        $comments_update = new Permission();
        $comments_update->name = "comments_update";
        $comments_update->display_name = "Actualizar comentarios";
        $comments_update->save();

        $comments_show = new Permission();
        $comments_show->name = "comments_show";
        $comments_show->display_name = "Ver comentarios";
        $comments_show->save();

        $comments_destroy = new Permission();
        $comments_destroy->name = "comments_destroy";
        $comments_destroy->display_name = "Destruir comentarios";
        $comments_destroy->save();

    }
}
