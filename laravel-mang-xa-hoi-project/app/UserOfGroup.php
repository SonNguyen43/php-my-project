<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserOfGroup extends Model
{
    protected $table = 'user_of_groups';
    protected $primaKey = 'id';
    protected $timestamp = true;

    public function user(){
        return $this->belongsTo(User::class);
    }
}
