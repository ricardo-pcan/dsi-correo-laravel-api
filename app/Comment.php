<?php

namespace dsiCorreo;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';
    protected $fillable = [ 'content', 'user_id', 'request_id' ];
    protected $hidden = [ 'updated_at', 'created_at' ];

    public function user()
    {
        return $this->belongsTo('dsiCorreo\User');
    }

    public function request()
    {
        return $this->belongsTo('dsiCorreo\Request');
    }
}
