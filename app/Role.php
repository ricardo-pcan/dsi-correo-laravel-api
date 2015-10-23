<?php namespace dsiCorreo;

use Parsidev\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $fillable = ['name', 'display_name', 'description'];
}
