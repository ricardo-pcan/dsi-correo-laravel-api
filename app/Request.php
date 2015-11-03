<?php

namespace dsiCorreo;

use Illuminate\Database\Eloquent\Model;
use DB;
class Request extends Model
{
    public static $Roles = array(
        'Administrativo' => 0,
        'Docente' => 1,
        'Funcionario' => 2,
        'Honorarios' => 3,
        'list' => array(
            array(
                'name' => 'Administrativo'
            ),
            array(
                'name' => 'Docente'
            ),
            array(
                'name' => 'Funcionario'
            ),
            array(
                'name' => 'Honorarios'
            )
        )
    );

    public static $Status = array(
        'Solicitado a DSI' => 0,
        'Solicitado a DCyC' => 1,
        'Concluido' => 2,
        'list' => array(
            array(
                'name' => 'Solicitado a DSI',
            ),
            array(
                'name' => 'Solicitado a DCyC'
            ),
            array(
                'name' => 'Concluido'
            )
        )
    );
    protected $table = 'requests';

    protected $fillable = ['first_name', 'first_last_name', 'second_last_name', 'employee_id', 'role', 'extension_number', 'department_id', 'alternative_mail', 'status'];

    protected $hidden = ['id', 'created_at', 'updated_at'];

    public function users()
    {
        return $this->belongsToMany('dsiCorreo\User', 'user_requests', 'request_id', 'user_id');
    }

    public function requestCode()
    {
        return $this->hasOne( 'dsiCorreo\RequestCode' );
    }

    // Custom methods

    public static function per_user( $user_id )
    {
        $collection = collect();
        $request_per_user = DB::table('requests')
            ->join('user_requests', function( $join ) use( $user_id ) {
                $join->on( 'requests.id', '=', 'user_requests.request_id' )
                    ->where( 'user_requests.user_id', '=', $user_id );
            })
                ->get();
        foreach( $request_per_user as $request )
        {
            $collection->push( $request->id );
        }
        return $collection;
        //return $request_per_user;
    }

}
