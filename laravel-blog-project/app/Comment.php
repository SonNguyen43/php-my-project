<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // table name
    protected $table = 'comments';
    // primary key
    protected $primaryKey = 'id';
    // timestamps
    public $timestamps = true;

    public function forum(){
        return $this->belongsTo(Forum::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
