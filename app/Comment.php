<?php

namespace dsiCorreo;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = ['content'];

    public function user()
    {
        return $this->belongsTo('dsiCorreo\User');
    }

    public function request()
    {
        return $this->belongsTo('dsiCorreo\Request');
    }
}
