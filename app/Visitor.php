<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'visitor';
    public $timestamps = false;
}
