<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class question extends Model
{
    public function user()
    {
        return $this->belongsTo('User');
    }
}
