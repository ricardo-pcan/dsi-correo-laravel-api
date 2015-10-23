<?php

    namespace dsiCorreo;

    use Illuminate\Database\Eloquent\Model;

    class RequestCode extends Model
    {
        protected $table = "request_codes";
        protected $fillable = ['request_id', 'code'];

        public function request()
        {
            return $this->belongsTo('dsiCorreo\Request');
        }
    }
