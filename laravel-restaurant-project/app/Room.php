<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    # table name
    protected $table = 'rooms';
    # primary Key
    protected $primaryKey = 'id';
    # timestamps
    public $timestamps = true;
}
