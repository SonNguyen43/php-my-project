<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $table = 'friends';
    protected $primaryKey = 'id';
    protected $timestamp = true;

    public function user(){
        return $this->belongsTo(User::class);
    }
}
