<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    # table name
    protected $table = 'images';
    # primary key
    protected $primaryKey = 'id';
    # timestamps
    public $timestamps = true;
}
