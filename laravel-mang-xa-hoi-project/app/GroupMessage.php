<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupMessage extends Model
{
    protected $table = 'group_messages';
    protected $primaryKey = 'id';
    protected $timestamp = true;

    public function group(){
        return $this->belongsTo(Group::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
