<?php

namespace dsiCorreo;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $table = 'requests';

    protected $fillable = ['first_name', 'first_last_name', 'second_last_name', 'employee_id', 'role', 'extension_number', 'department_id', 'alternative_mail'];
    
}
