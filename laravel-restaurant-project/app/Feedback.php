<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    # table name
    protected $table = 'feedback';
    # primary key
    protected $primaryKey = 'id';
    # timestamps
    public $timestamps = true;
}
