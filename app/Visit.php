<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'visit';
    public $timestamps = false;
}
