<?php
    namespace dsiCorreo;

    use Illuminate\Database\Eloquent\Model;

    class UserRequest extends Model
    {
        protected $table = 'user_requests';

        protected $fillable = ['user_id', 'request_id', 'created_at', 'updated_at' ];
        protected $hidden = ['created_at', 'updated_at'];
    }

