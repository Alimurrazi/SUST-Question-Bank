<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class question extends Model
{
    public function user()
    {
        return $this->belongsTo('app\User');
    }
    public function tag_relation()
    {
    	return $this->belongsTo('app\tag_relation'); 
    }

}
